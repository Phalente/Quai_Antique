<?php

namespace App\Entity;

use App\Repository\RestaurantHoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RestaurantHoursRepository::class)]
class RestaurantHours
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 50)]
  private ?string $Day = null;

  #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
  #[Assert\Time]
  private ?\DateTimeInterface $Opening_lunch = null;

  #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
  #[Assert\Time]
  private ?\DateTimeInterface $Closing_lunch = null;

  #[ORM\Column]
  #[Assert\PositiveOrZero]
  private ?int $Places_available_lunch = null;

  #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
  #[Assert\Time]
  private ?\DateTimeInterface $Opening_dinner = null;

  #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
  #[Assert\Time]
  private ?\DateTimeInterface $Closing_dinner = null;

  #[ORM\Column]
  #[Assert\PositiveOrZero]
  private ?int $Places_available_dinner = null;

  #[ORM\OneToMany(mappedBy: 'Restaurant_hour', targetEntity: Reservation::class, orphanRemoval: true)]
  private Collection $reservations;

  public function __construct()
  {
    $this->reservations = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getDay(): ?string
  {
    return $this->Day;
  }

  public function setDay(string $Day): self
  {
    $this->Day = $Day;

    return $this;
  }



  public function getOpeningLunch(): ?\DateTimeInterface
  {
    return $this->Opening_lunch;
  }

  public function setOpeningLunch(?\DateTimeInterface $Opening_lunch): self
  {
    $this->Opening_lunch = $Opening_lunch;

    return $this;
  }

  public function getClosingLunch(): ?\DateTimeInterface
  {
    return $this->Closing_lunch;
  }

  public function setClosingLunch(?\DateTimeInterface $Closing_lunch): self
  {
    $this->Closing_lunch = $Closing_lunch;

    return $this;
  }

  public function getPlacesAvailableLunch(): ?int
  {
    return $this->Places_available_lunch;
  }

  public function setPlacesAvailableLunch(int $Places_available_lunch): self
  {
    $this->Places_available_lunch = $Places_available_lunch;

    return $this;
  }

  public function getOpeningDinner(): ?\DateTimeInterface
  {
    return $this->Opening_dinner;
  }

  public function setOpeningDinner(?\DateTimeInterface $Opening_dinner): self
  {
    $this->Opening_dinner = $Opening_dinner;

    return $this;
  }

  public function getClosingDinner(): ?\DateTimeInterface
  {
    return $this->Closing_dinner;
  }

  public function setClosingDinner(?\DateTimeInterface $Closing_dinner): self
  {
    $this->Closing_dinner = $Closing_dinner;

    return $this;
  }

  public function getPlacesAvailableDinner(): ?int
  {
    return $this->Places_available_dinner;
  }

  public function setPlacesAvailableDinner(int $Places_available_dinner): self
  {
    $this->Places_available_dinner = $Places_available_dinner;

    return $this;
  }

  /**
   * @return Collection<int, Reservation>
   */
  public function getReservations(): Collection
  {
    return $this->reservations;
  }

  public function addReservation(Reservation $reservation): self
  {
    if (!$this->reservations->contains($reservation)) {
      $this->reservations->add($reservation);
      $reservation->setRestaurantHour($this);
    }

    return $this;
  }

  public function removeReservation(Reservation $reservation): self
  {
    if ($this->reservations->removeElement($reservation)) {
      // set the owning side to null (unless already changed)
      if ($reservation->getRestaurantHour() === $this) {
        $reservation->setRestaurantHour(null);
      }
    }

    return $this;
  }
}
