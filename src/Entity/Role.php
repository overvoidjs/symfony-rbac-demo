<?php

namespace App\Entity;

use Eb22fbb4\Bundle\RBACBundle\Model\RoleableTrait;
use Eb22fbb4\Bundle\RBACBundle\Model\RoleableInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role implements ResourceInterface, RoleableInterface, TimestampableInterface
{
    use ResourceTrait, RoleableTrait, TimestampableTrait;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $name;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
