<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'Das darf nicht leer sein')]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Assert\NotBlank(message: 'Das darf nicht leer sein')]
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[Assert\NotBlank(message: 'Das darf nicht leer sein')]
    #[Assert\PositiveOrZero(message: 'This value should be either positive or zero.')]
    #[ORM\Column]
    private ?int $bookedseats = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getBookedseats(): ?int
    {
        return $this->bookedseats;
    }

    public function setBookedseats(int $bookedseats): static
    {
        $this->bookedseats = $bookedseats;

        return $this;
    }

    public function seats()
    {
        return $this->bookedseats - 200;
    }
}
