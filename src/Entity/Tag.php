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
 * Class tag
 * @package App\Entity
 * @ApiResource
 * @ORM\Entity
 */
class Tag
{
    /**
     * @var int The id of this tag.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The name of the tag
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 2,
     *     max = 500,
     *     minMessage = "the tag name must be at least {{ limit }} characters long",
     *     maxMessage = "the tag name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @var string The description of the tag
     * @Assert\Length(
     *     max = 500,
     *     maxMessage = "the tag description cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var string The name of the subtask
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 2,
     *     max = 20,
     *     minMessage = "the tag color must be at least {{ limit }} characters long",
     *     maxMessage = "the tag color cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $color;

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="tags")
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
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
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