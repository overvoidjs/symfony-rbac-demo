<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role implements ResourceInterface, TimestampableInterface
{
    use ResourceTrait, TimestampableTrait;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="json")
     */
    private $nodes = [];

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNodes(): ?array
    {
        return $this->nodes;
    }

    public function setNodes(array $nodes): self
    {
        $this->nodes = $nodes;

        return $this;
    }
}
