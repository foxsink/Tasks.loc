<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    protected ?string $email = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected ?string $password = null;

    /**
     * @var string[]
     *
     * @ORM\Column(type="json", nullable=false)
     */
    protected array $roles = [];

    /**
     * @var string|null
     *
     * @ORM\Column(name="avatar_url", type="string")
     */
    protected ?string $avatarUrl = null;

    /**
     * @var string|null
     *
     * @ORM\Column(name="first_name", type="string")
     */
    protected ?string $firstName = null;

    /**
     * @var string|null
     *
     * @ORM\Column(name="last_name", type="string")
     */
    protected ?string $lastName = null;

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
        return $this->roles;
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



}