<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App
 *
 * @ORM\Entity
 * @ORM\EntityListeners("App\EventListener\PasswordEncodePrePersist")
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @var Collection
     *
     * @ManyToMany(targetEntity="Project", inversedBy="users")
     * @JoinTable(name="users_projects")
     */
    private Collection $projects;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    private ?string $email = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private ?string $password = null;

    /**
     * @var string[]
     *
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $avatarUrl = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private ?string $firstName = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private ?string $lastName = null;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return User
     */
    public function setEmail(?string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return User
     */
    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);

    }

    /**
     * @param string[] $roles
     * @return User
     */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvatarUrl(): ?string
    {
        return $this->avatarUrl;
    }

    /**
     * @param string|null $avatarUrl
     * @return User
     */
    public function setAvatarUrl(?string $avatarUrl): User
    {
        $this->avatarUrl = $avatarUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     * @return User
     */
    public function setFirstName(?string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     * @return User
     */
    public function setLastName(?string $lastName): User
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}