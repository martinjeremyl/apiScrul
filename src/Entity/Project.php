<?php
/**
 * Created by PhpStorm.
 * Person: jeremy martin
 * Date: 18/07/2018
 * Time: 20:20
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Project is a project leaded by a team
 * @package App\Entity
 * @ApiResource
 * @ORM\Entity
 */
class Project
{
    /**
     * @var int The id of this project.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The name of the project
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 2,
     *     max = 100,
     *     minMessage = "the project name must be at least {{ limit }} characters long",
     *     maxMessage = "the project name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @var string The description of the project
     * @Assert\Length(
     *     max = 500,
     *     maxMessage = "the project description cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var Task[] List of tasks.
     *
     * @ORM\OneToMany(targetEntity="Task", mappedBy="project")
     */
    private $tasks;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="projects")
     * @ORM\JoinTable(
     *  name="project_categories",
     *  joinColumns={
     *      @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     *  }
     * )
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="projects")
     * @ORM\JoinTable(
     *  name="project_tags",
     *  joinColumns={
     *      @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     *  }
     * )
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity="Team", inversedBy="projects")
     * @ORM\JoinTable(
     *  name="project_teams",
     *  joinColumns={
     *      @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     *  }
     * )
     */
    private $teams;

    /**
     * @var \DateTimeInterface The publication date of this book.
     *
     * @ORM\Column(type="datetime")
     */
    public $deadline;

    public function __construct() {
        $this->tags = new ArrayCollection();
        $this->teams = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Task[]
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }

    /**
     * @param Task[] $tasks
     */
    public function setTasks(array $tasks): void
    {
        $this->tasks = $tasks;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * @param mixed $teams
     */
    public function setTeams($teams): void
    {
        $this->teams = $teams;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDeadline(): \DateTimeInterface
    {
        return $this->deadline;
    }

    /**
     * @param \DateTimeInterface $deadline
     */
    public function setDeadline(\DateTimeInterface $deadline): void
    {
        $this->deadline = $deadline;
    }

}