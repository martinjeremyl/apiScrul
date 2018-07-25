<?php
/**
 * Created by PhpStorm.
 * Person: jeremy martin
 * Date: 18/07/2018
 * Time: 20:27
 */

// src/Entity/Personon.php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiSubresource;
/**
 * @ORM\Entity
 * @ApiResource
 */
class Person implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $prenom;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

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
     * @ORM\ManyToMany(targetEntity="Subtask", mappedBy="assignees")
     */
    private $subtaskAssignees;

    /**
     * @ORM\ManyToMany(targetEntity="Subtask", mappedBy="followers")
     */
    private $subtaskFollowers;

    /**
     * @ORM\ManyToMany(targetEntity="Task", mappedBy="assignees")
     */
    private $taskAssignees;

    /**
     * @ORM\ManyToMany(targetEntity="Task", mappedBy="followers")
     */
    private $taskFollowers;

    public function __construct()
    {
        $this->imputations = new ArrayCollection();
        $this->teams = new ArrayCollection();
        $this->subtaskAssignees = new ArrayCollection();
        $this->subtaskFollowers = new ArrayCollection();
        $this->taskAssignees = new ArrayCollection();
        $this->taskFollowers = new ArrayCollection();
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

    public function setPassword($password) {
        $this->password = $password;
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
     * @return Imputation[]
     */
    public function getImputations()
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

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    
}