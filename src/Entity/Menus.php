<?php

namespace App\Entity;

use App\Repository\MenusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MenusRepository::class)]
class Menus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 100)]
    private ?string $Title = null;

    #[ORM\ManyToMany(targetEntity: Meal::class, mappedBy: 'menus')]
    private Collection $meals;

    #[ORM\ManyToMany(targetEntity: Formulas::class, inversedBy: 'menus')]
    private Collection $formulas;

    public function __construct()
    {
        $this->meals = new ArrayCollection();
        $this->formulas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    /**
     * @return Collection<int, Meal>
     */
    public function getMeals(): Collection
    {
        return $this->meals;
    }

    public function addMeal(Meal $meal): self
    {
        if (!$this->meals->contains($meal)) {
            $this->meals->add($meal);
            $meal->addMenu($this);
        }

        return $this;
    }

    public function removeMeal(Meal $meal): self
    {
        if ($this->meals->removeElement($meal)) {
            $meal->removeMenu($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Fromula>
     */
    public function getFormula(): Collection
    {
        return $this->formulas;
    }

    public function addFormulas(Formulas $formulas): self
    {
        if (!$this->formulas->contains($formulas)) {
            $this->formulas->add($formulas);
        }

        return $this;
    }

    public function removeFormula(Formulas $formulas): self
    {
        $this->formulas->removeElement($formulas);

        return $this;
    }
}
