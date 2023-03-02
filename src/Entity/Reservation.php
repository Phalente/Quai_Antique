<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(type: Types::DATETIME_MUTABLE)]
  private ?\DateTimeInterface $Date = null;

  #[ORM\Column(type: Types::TIME_MUTABLE)]
  private ?\DateTimeInterface $Hour = null;

  #[ORM\Column]
  private ?int $Number_of_guests = null;

  #[ORM\ManyToOne(inversedBy: 'reservations')]
  #[ORM\JoinColumn(nullable: false)]
  private ?RestaurantHours $Restaurant_hour = null;

  #[ORM\ManyToOne(inversedBy: 'reservations')]
  #[ORM\JoinColumn(nullable: true)]
  private ?User $User = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getDate(): ?\DateTimeInterface
  {
    return $this->Date;
  }

  public function setDate(\DateTimeInterface $Date): self
  {
    $this->Date = $Date;

    return $this;
  }

  public function getHour(): ?\DateTimeInterface
  {
    return $this->Hour;
  }

  public function setHour(\DateTimeInterface $Hour): self
  {
    $this->Hour = $Hour;

    return $this;
  }

  public function getNumberOfGuests(): ?int
  {
    return $this->Number_of_guests;
  }

  public function setNumberOfGuests(int $Number_of_guests): self
  {
    $this->Number_of_guests = $Number_of_guests;

    return $this;
  }

  public function getRestaurantHour(): ?RestaurantHours
  {
    return $this->Restaurant_hour;
  }

  public function setRestaurantHour(?RestaurantHours $Restaurant_hour): self
  {
    $this->Restaurant_hour = $Restaurant_hour;

    return $this;
  }

  public function getUser(): ?User
  {
    return $this->User;
  }

  public function setUser(?User $User): self
  {
    $this->User = $User;

    return $this;
  }
}
