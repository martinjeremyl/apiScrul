<?php
/**
 * Created by PhpStorm.
 * User: jeremy martin
 * Date: 18/07/2018
 * Time: 20:21
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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

}