<?php
/**
 * Created by PhpStorm.
 * User: jeremy martin
 * Date: 18/07/2018
 * Time: 20:20
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
}