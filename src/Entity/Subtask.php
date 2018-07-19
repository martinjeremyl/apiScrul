<?php
/**
 * Created by PhpStorm.
 * Person: jeremy martin
 * Date: 18/07/2018
 * Time: 20:20
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Subtask is a task relative to another task
 * @package App\Entity
 * @ApiResource
 * @ORM\Entity
 */
class Subtask
{
    /**
     * @var int The id of this subtask.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The name of the subtask
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 2,
     *     max = 500,
     *     minMessage = "the subtask name must be at least {{ limit }} characters long",
     *     maxMessage = "the subtask name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @var string The description of the subtask
     * @Assert\Length(
     *     max = 500,
     *     maxMessage = "the subtask description cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var Project The task of this subtask.
     *
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="subtasks")
     */
    public $task;

    /**
     * @ORM\ManyToMany(targetEntity="Person", inversedBy="subtaskAssignees")
     * @ORM\JoinTable(
     *  name="subtask_assignees",
     *  joinColumns={
     *      @ORM\JoinColumn(name="subtask_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *  }
     * )
     */
    private $assignees;

    /**
     * @ORM\ManyToMany(targetEntity="Person", inversedBy="subtaskFollowers")
     * @ORM\JoinTable(
     *  name="subtask_followers",
     *  joinColumns={
     *      @ORM\JoinColumn(name="subtask_id", referencedColumnName="id")
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
     * @return Project
     */
    public function getTask(): Project
    {
        return $this->task;
    }

    /**
     * @param Project $task
     */
    public function setTask(Project $task): void
    {
        $this->task = $task;
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