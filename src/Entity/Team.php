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
 * Class team
 * @package App\Entity
 * @ApiResource
 * @ORM\Entity
 */
class Team
{
    /**
     * @var int The id of this team.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The name of the team
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 2,
     *     max = 500,
     *     minMessage = "the team name must be at least {{ limit }} characters long",
     *     maxMessage = "the team name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @var string The description of the team
     * @Assert\Length(
     *     max = 500,
     *     maxMessage = "the team description cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="teams")
     */
    private $projects;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="teams")
     * @ORM\JoinTable(
     *  name="team_members",
     *  joinColumns={
     *      @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     *  }
     * )
     */
    private $members;

    public function __construct() {
        $this->members = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param mixed $members
     */
    public function setMembers($members): void
    {
        $this->members = $members;
    }

}