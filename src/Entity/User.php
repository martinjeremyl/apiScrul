<?php
/**
 * Created by PhpStorm.
 * User: jeremy martin
 * Date: 18/07/2018
 * Time: 20:27
 */

// src/Entity/User.php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity
 * @ApiResource(
 *     normalizationContext={"groups"={"user", "user:read"}},
 *     denormalizationContext={"groups"={"user", "user:write"}}
 * )
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Groups({"user"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups({"user:write"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=254, unique=true)
     * @Groups({"user"})
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     * @Groups({"user"})
     */
    private $isActive;

    /**
     * @var Imputation[] List of imputations.
     *
     * @ORM\OneToMany(targetEntity="Imputation", mappedBy="user")
     */
    private $imputations;

    /**
     * @ORM\OneToOne(targetEntity="Document", inversedBy="user")
     * @ORM\JoinColumn(referencedColumnName="id", unique=true)
     * @ApiSubresource
     */
    public $avatar;

    /**
     * @ORM\ManyToMany(targetEntity="Team", mappedBy="members")
     */
    private $teams;

    /**
     * @ORM\ManyToMany(targetEntity="Team", mappedBy="assignees")
     */
    private $subtaskAssignees;

    /**
     * @ORM\ManyToMany(targetEntity="Team", mappedBy="followers")
     */
    private $subtaskFollowers;

    /**
     * @ORM\ManyToMany(targetEntity="Team", mappedBy="assignees")
     */
    private $taskAssignees;

    /**
     * @ORM\ManyToMany(targetEntity="Team", mappedBy="followers")
     */
    private $taskFollowers;

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            ) = unserialize($serialized, array('allowed_classes' => false));
    }

    public function isUser(?UserInterface $user = null): bool
    {
        return $user instanceof self && $user->id === $this->id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
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
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * @param mixed $teams
     */
    public function setTeams($teams): void
    {
        $this->teams = $teams;
    }

    /**
     * @return mixed
     */
    public function getSubtaskAssignees()
    {
        return $this->subtaskAssignees;
    }

    /**
     * @param mixed $subtaskAssignees
     */
    public function setSubtaskAssignees($subtaskAssignees): void
    {
        $this->subtaskAssignees = $subtaskAssignees;
    }

    /**
     * @return mixed
     */
    public function getSubtaskFollowers()
    {
        return $this->subtaskFollowers;
    }

    /**
     * @param mixed $subtaskFollowers
     */
    public function setSubtaskFollowers($subtaskFollowers): void
    {
        $this->subtaskFollowers = $subtaskFollowers;
    }

    /**
     * @return mixed
     */
    public function getTaskAssignees()
    {
        return $this->taskAssignees;
    }

    /**
     * @param mixed $taskAssignees
     */
    public function setTaskAssignees($taskAssignees): void
    {
        $this->taskAssignees = $taskAssignees;
    }

    /**
     * @return mixed
     */
    public function getTaskFollowers()
    {
        return $this->taskFollowers;
    }

    /**
     * @param mixed $taskFollowers
     */
    public function setTaskFollowers($taskFollowers): void
    {
        $this->taskFollowers = $taskFollowers;
    }

}