<?php
/**
 * Created by PhpStorm.
 * User: jeremy martin
 * Date: 18/07/2018
 * Time: 21:14
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ApiResource
 */
class Document
{
    /**
     * @var int The id of this file.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @var string The description of the file
     * @Assert\Length(
     *     min = 0,
     *     max = 1000,
     *     maxMessage = "the description must have less than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    public $description;

    /**
     * @var MediaObject|null
     * @ORM\ManyToOne(targetEntity="App\Entity\MediaObject")
     * @ORM\JoinColumn(nullable=false)
     */
    public $file;

    /**
     * @var Task task assigned to this document.
     *
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="documents")
     */
    public $task;

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
     * @return MediaObject|null
     */
    public function getFile(): ?MediaObject
    {
        return $this->file;
    }

    /**
     * @param MediaObject|null $file
     */
    public function setFile(?MediaObject $file): void
    {
        $this->file = $file;
    }

    
}