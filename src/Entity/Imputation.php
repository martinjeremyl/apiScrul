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

/**
 * Class Imputation is the amount of time spend on a task/subtask
 * @package App\Entity
 * @ApiResource
 * @ORM\Entity
 */
class Imputation
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
     * @var int number of hours
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 0,
     *      minMessage = "An imputation must have at least 15 minutes of work",
     * )
     * @ORM\Column(type="integer")
     */
    private $hours;

    /**
     * @var Task The task for this imputation.
     *
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="imputations")
     */
    public $task;

    /**
     * @var Person The Person for this imputation.
     *
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="imputations")
     */
    public $user;

    /**
     * @var \DateTimeInterface The publication date of this book.
     *
     * @ORM\Column(type="datetime")
     */
    public $imputationDate;

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
    public function getHours(): int
    {
        return $this->hours;
    }

    /**
     * @param int $hours
     */
    public function setHours(int $hours): void
    {
        $this->hours = $hours;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }

    /**
     * @param Task $task
     */
    public function setTask(Task $task): void
    {
        $this->task = $task;
    }

    /**
     * @return Person
     */
    public function getUser(): Person
    {
        return $this->user;
    }

    /**
     * @param Person $user
     */
    public function setUser(Person $user): void
    {
        $this->user = $user;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getImputationDate(): \DateTimeInterface
    {
        return $this->imputationDate;
    }

    /**
     * @param \DateTimeInterface $imputationDate
     */
    public function setImputationDate(\DateTimeInterface $imputationDate): void
    {
        $this->imputationDate = $imputationDate;
    }

}