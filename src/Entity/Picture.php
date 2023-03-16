<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
#[Vich\Uploadable]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $PictureName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PictureTitle = null;

    #[Vich\UploadableField(mapping: 'quai_pictures', fileNameProperty: 'PictureName')]
    private ?File $PictureFile = null;


    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Text_alt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Slider = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $UpdatedAt = null;

    public function __construct()
    {
        $this->CreatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextAlt(): ?string
    {
        return $this->Text_alt;
    }

    public function setTextAlt(?string $Text_alt): self
    {
        $this->Text_alt = $Text_alt;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $PictureFile
     */
    public function setPictureFile(?File $PictureName = null): void
    {
        $this->PictureFile = $PictureName;

        if (null !== $PictureName) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->UpdatedAt = new \DateTimeImmutable();
        }
    }

    public function getPictureFile(): ?File
    {
        return $this->PictureFile;
    }

    public function setPictureName(?string $PictureName): void
    {
        $this->PictureName = $PictureName;
    }

    public function getPictureName(): ?string
    {
        return $this->PictureName;
    }


    public function isSlider(): ?bool
    {
        return $this->Slider;
    }

    public function setSlider(?bool $Slider): self
    {
        $this->Slider = $Slider;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPictureTitle(): ?string
    {
        return $this->PictureTitle;
    }

    /**
     * @param string|null $PictureTitle 
     * @return self
     */
    public function setPictureTitle(?string $PictureTitle): self
    {
        $this->PictureTitle = $PictureTitle;
        return $this;
    }
}
