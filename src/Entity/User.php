<?php
namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\EntityListeners(value={"App\EventListener\PasswordEncodePrePersist"})
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @var Collection
     *
     * @ManyToMany(targetEntity="Project", mappedBy="users", cascade={"persist"})
     * @JoinTable(name="users_projects")
     *
     */
    private Collection $projects;

    /**
     * @var Collection
     *
     * @OneToMany(targetEntity="App\Entity\TaskTime", mappedBy="user")
     */
    private Collection $userTimes;

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
     * @var string|null
     *
     * @ORM\Column(type="string", unique=true)
     */
    private ?string $registerToken = null;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default" = false})
     */
    private bool $allowLogin = false;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column (type="datetime")
     */
    private ?DateTimeInterface $tokenExpireAt = null;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->tokenExpireAt = new \DateTime("+7 days");
        $this->projects = new ArrayCollection();
        $this->userTimes = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return User
     */
    public function setId(?int $id): User
    {
        $this->id = $id;
        return $this;
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
        $roles = array_unique($roles);
        if (($key = array_search('ROLE_USER', $roles)) !== false) {
            unset($roles[$key]);
        }
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

    /**
     * @return Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param Collection $projects
     * @return User
     */
    public function setProjects(Collection $projects): User
    {
        $this->projects = $projects;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getUserTimes(): Collection
    {
        return $this->userTimes;
    }

    /**
     * @param Collection $userTimes
     * @return User
     */
    public function setUserTimes(Collection $userTimes): User
    {
        $this->userTimes = $userTimes;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegisterToken(): ?string
    {
        return $this->registerToken;
    }

    /**
     * @param string|null $registerToken
     * @return User
     */
    public function setRegisterToken(?string $registerToken): User
    {
        $this->registerToken = $registerToken;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAllowLogin(): bool
    {
        return $this->allowLogin;
    }

    /**
     * @param bool $allowLogin
     * @return User
     */
    public function setAllowLogin(bool $allowLogin): User
    {
        $this->allowLogin = $allowLogin;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getTokenExpireAt(): ?DateTimeInterface
    {
        return $this->tokenExpireAt;
    }

    /**
     * @param DateTimeInterface|null $tokenExpireAt
     * @return User
     */
    public function setTokenExpireAt(?DateTimeInterface $tokenExpireAt): User
    {
        $this->tokenExpireAt = $tokenExpireAt;
        return $this;
    }

    public function __toString()
    {
        return ( $this->getId() ) ? $this->getEmail(): 'Unknown user';
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