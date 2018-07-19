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
 * Class ComplexityPoint is the amount of complexity points gived to a task or subtask
 * @package App\Entity
 * @ApiResource
 * @ORM\Entity
 */
class ComplexityPoint
{
    /**
     * @var int The id of this complexity point.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var integer Value of the complexity point
     * @Assert\NotBlank
     * @Assert\Choice(
     *     choices={1,2,3,5,8,13,20,40,100},
     *     message="The complexity point must be equal to 1,2,3,5,8,13,20,40 or 100"
     * )
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @var Task[] List of tasks estimated with this complexity point.
     *
     * @ORM\OneToMany(targetEntity="Task", mappedBy="complexityPoint")
     */
    private $tasks;

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
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
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

}