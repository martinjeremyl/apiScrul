<?php
/**
 * Created by PhpStorm.
 * Person: jeremy martin
 * Date: 18/07/2018
 * Time: 20:21
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Category is the category assigned to a task
 * @package App\Entity
 * @ApiResource
 * @ORM\Entity
 */
class Category
{
    /**
     * @var int The id of this category.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The name of the category
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 2,
     *     max = 100,
     *     minMessage = "the category name must be at least {{ limit }} characters long",
     *     maxMessage = "the category name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @var int The position of the category in the board
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 1,
     *      max = 99,
     *      minMessage = "A category must not have a position smaller than 1",
     *      maxMessage = "A category must not have a position bigger than 99"
     * )
     * @ORM\Column(type="smallint")
     */
    private $position;

    /**
     * @var string The description of the category
     * @Assert\Length(
     *     max = 500,
     *     maxMessage = "the category description cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var Task[] List of tasks assigned to this category.
     *
     * @ORM\OneToMany(targetEntity="Task", mappedBy="category")
     */
    private $tasks;

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="categories")
     */
    private $projects;

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
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
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
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param mixed $projects
     */
    public function setProjects($projects): void
    {
        $this->projects = $projects;
    }

}