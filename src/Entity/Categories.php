<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 100)]
    private ?string $Name = null;

    #[ORM\ManyToMany(targetEntity: Meals::class, inversedBy: 'categories')]
    private Collection $Meals;

    public function __construct()
    {
        $this->Meals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection<int, Meals>
     */
    public function getMeals(): Collection
    {
        return $this->Meals;
    }

    public function addMeal(Meals $meal): self
    {
        if (!$this->Meals->contains($meal)) {
            $this->Meals->add($meal);
            $meal->addCategory($this);
        }

        return $this;
    }

    public function removeMeal(Meals $meal): self
    {
        $this->Meals->removeElement($meal);

        return $this;
    }

    public function __toString(): string
    {
        return $this->Name;
    }
}
