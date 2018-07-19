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
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Class Task
 * @package App\Entity
 * @ApiResource
 * @ORM\Entity
 */
class Task
{
    /**
     * @var int The id of this task.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The name of the task
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 2,
     *     max = 500,
     *     minMessage = "the task name must be at least {{ limit }} characters long",
     *     maxMessage = "the task name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @var string The description of the task
     * @Assert\Length(
     *     max = 500,
     *     maxMessage = "the task description cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var category The category of this task.
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="tasks")
     */
    public $category;

    /**
     * @var ComplexityPoint The complexityPoint of this task.
     *
     * @ORM\ManyToOne(targetEntity="ComplexityPoint", inversedBy="tasks")
     */
    public $complexityPoint;

    /**
     * @var Project The project of this task.
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="tasks")
     */
    public $project;

    /**
     * @var Document[] List of documents.
     *
     * @ORM\OneToMany(targetEntity="Document", mappedBy="task")
     */
    private $documents;

    /**
     * @var Imputation[] List of imputations
     *
     * @ORM\OneToMany(targetEntity="Imputation", mappedBy="task")
     */
    public $imputations;

    /**
     * @var Subtask[] List of subtasks
     *
     * @ORM\OneToMany(targetEntity="Subtask", mappedBy="task")
     */
    public $subtasks;

    /**
     * @var \DateTimeInterface The publication date of this book.
     *
     * @ORM\Column(type="datetime")
     */
    public $deadline;

    /**
     * @ORM\ManyToMany(targetEntity="Person", inversedBy="taskAssignees")
     * @ORM\JoinTable(
     *  name="task_assignees",
     *  joinColumns={
     *      @ORM\JoinColumn(name="task_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *  }
     * )
     */
    private $assignees;

    /**
     * @ORM\ManyToMany(targetEntity="Person", inversedBy="taskFollowers")
     * @ORM\JoinTable(
     *  name="task_followers",
     *  joinColumns={
     *      @ORM\JoinColumn(name="task_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *  }
     * )
     */
    private $followers;

    public function __construct() {
        $this->assignees = new ArrayCollection();
        $this->followers = new ArrayCollection();
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
     * @return category
     */
    public function getCategory(): category
    {
        return $this->category;
    }

    /**
     * @param category $category
     */
    public function setCategory(category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return ComplexityPoint
     */
    public function getComplexityPoint(): ComplexityPoint
    {
        return $this->complexityPoint;
    }

    /**
     * @param ComplexityPoint $complexityPoint
     */
    public function setComplexityPoint(ComplexityPoint $complexityPoint): void
    {
        $this->complexityPoint = $complexityPoint;
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     */
    public function setProject(Project $project): void
    {
        $this->project = $project;
    }

    /**
     * @return Document[]
     */
    public function getDocuments(): array
    {
        return $this->documents;
    }

    /**
     * @param Document[] $documents
     */
    public function setDocuments(array $documents): void
    {
        $this->documents = $documents;
    }

    /**
     * @return Imputation[]
     */
    public function getImputations(): array
    {
        return $this->imputations;
    }

    /**
     * @param Imputation[] $imputations
     */
    public function setImputations(array $imputations): void
    {
        $this->imputations = $imputations;
    }

    /**
     * @return Subtask[]
     */
    public function getSubtasks(): array
    {
        return $this->subtasks;
    }

    /**
     * @param Subtask[] $subtasks
     */
    public function setSubtasks(array $subtasks): void
    {
        $this->subtasks = $subtasks;
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

    /**
     * @return mixed
     */
    public function getAssignees()
    {
        return $this->assignees;
    }

    /**
     * @param mixed $assignees
     */
    public function setAssignees($assignees): void
    {
        $this->assignees = $assignees;
    }

    /**
     * @return mixed
     */
    public function getFollowers()
    {
        return $this->followers;
    }

    /**
     * @param mixed $followers
     */
    public function setFollowers($followers): void
    {
        $this->followers = $followers;
    }

}