<?php

namespace App\Entity;

use App\Repository\TrainingsLangRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrainingsLangRepository::class)
 */
class TrainingsLang
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Languages::class, mappedBy="trainingsLang")
     */
    private $language;

    /**
     * @ORM\OneToOne(targetEntity=Trainings::class, inversedBy="trainingsLang", cascade={"persist", "remove"})
     */
    private $training;

    public function __construct()
    {
        $this->language = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Languages>
     */
    public function getLanguage(): Collection
    {
        return $this->language;
    }

    public function addLanguage(Languages $language): self
    {
        if (!$this->language->contains($language)) {
            $this->language[] = $language;
            $language->setTrainingsLang($this);
        }

        return $this;
    }

    public function removeLanguage(Languages $language): self
    {
        if ($this->language->removeElement($language)) {
            // set the owning side to null (unless already changed)
            if ($language->getTrainingsLang() === $this) {
                $language->setTrainingsLang(null);
            }
        }

        return $this;
    }

    public function getTraining(): ?Trainings
    {
        return $this->training;
    }

    public function setTraining(?Trainings $training): self
    {
        $this->training = $training;

        return $this;
    }
}
