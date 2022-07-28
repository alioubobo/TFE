<?php

namespace App\Entity;

use App\Repository\CoachesLangRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoachesLangRepository::class)
 */
class CoachesLang
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Languages::class, mappedBy="coachesLang")
     */
    private $language;

    /**
     * @ORM\OneToOne(targetEntity=Coaches::class, inversedBy="coachesLang", cascade={"persist", "remove"})
     */
    private $coach;

    public function __construct()
    {
        $this->language = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
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
            $language->setCoachesLang($this);
        }

        return $this;
    }

    public function removeLanguage(Languages $language): self
    {
        if ($this->language->removeElement($language)) {
            // set the owning side to null (unless already changed)
            if ($language->getCoachesLang() === $this) {
                $language->setCoachesLang(null);
            }
        }

        return $this;
    }

    public function getCoach(): ?Coaches
    {
        return $this->coach;
    }

    public function setCoach(?Coaches $coach): self
    {
        $this->coach = $coach;

        return $this;
    }
}
