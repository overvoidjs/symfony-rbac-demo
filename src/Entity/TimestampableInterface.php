<?php

namespace App\Entity;

interface TimestampableInterface
{
    public function getUpdatedAt(): ?\DateTimeInterface;

    public function setUpdatedAt(?\DateTimeInterface $updatedAt);

    public function getCreatedAt(): ?\DateTimeImmutable;

    public function setCreatedAt(\DateTimeImmutable $createdAt);
}
