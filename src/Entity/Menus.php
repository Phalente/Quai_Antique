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

    #[ORM\ManyToMany(targetEntity: Meals::class, mappedBy: 'Menus')]
    private Collection $meals;

    #[ORM\ManyToMany(targetEntity: Formulas::class, inversedBy: 'menuses')]
    private Collection $Formulas;

    public function __construct()
    {
        $this->meals = new ArrayCollection();
        $this->Formulas = new ArrayCollection();
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
     * @return Collection<int, Meals>
     */
    public function getMeals(): Collection
    {
        return $this->meals;
    }

    public function addMeal(Meals $meal): self
    {
        if (!$this->meals->contains($meal)) {
            $this->meals->add($meal);
            $meal->addMenu($this);
        }

        return $this;
    }

    public function removeMeal(Meals $meal): self
    {
        if ($this->meals->removeElement($meal)) {
            $meal->removeMenu($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Formulas>
     */
    public function getFormulas(): Collection
    {
        return $this->Formulas;
    }

    public function addFormula(Formulas $formula): self
    {
        if (!$this->Formulas->contains($formula)) {
            $this->Formulas->add($formula);
        }

        return $this;
    }

    public function removeFormula(Formulas $formula): self
    {
        $this->Formulas->removeElement($formula);

        return $this;
    }
}
