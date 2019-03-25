<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @UniqueEntity(fields={"identifier"}, groups={"identifier"})
 */
class User implements ResourceInterface, TimestampableInterface, UserInterface, EquatableInterface
{
    use ResourceTrait, TimestampableTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role")
     *
     * @Assert\NotBlank(groups={"role"})
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(groups={"identifier"})
     * @Assert\Length(min=4, max=16, groups={"identifier"})
     * @Assert\Regex(pattern="/[0-9A-Za-z._-]$/", groups={"identifier"})
     */
    private $identifier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getRoles()
    {
        return $this->role->getNodes();
    }

    public function getSalt()
    {
    }

    public function getUsername()
    {
        return $this->identifier;
    }

    public function eraseCredentials()
    {
    }

    public function isEqualTo(UserInterface $user)
    {
        return $this->getRoles() === $user->getRoles();
    }
}
