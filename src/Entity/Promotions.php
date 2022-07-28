<?php

namespace App\Entity;

use App\Repository\PromotionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionsRepository::class)
 */
class Promotions
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $start_date;

    /**
     * @ORM\Column(type="date")
     */
    private $end_date;

    /**
     * @ORM\OneToMany(targetEntity=PDF::class, mappedBy="promotion")
     */
    private $pDFs;

    /**
     * @ORM\OneToOne(targetEntity=PromotionsLang::class, mappedBy="promotion", cascade={"persist", "remove"})
     */
    private $promotionsLang;

    /**
     * @ORM\ManyToOne(targetEntity=Trainings::class, inversedBy="promotions")
     */
    private $training;

    public function __construct()
    {
        $this->pDFs = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * @return Collection<int, PDF>
     */
    public function getPDFs(): Collection
    {
        return $this->pDFs;
    }

    public function addPDF(PDF $pDF): self
    {
        if (!$this->pDFs->contains($pDF)) {
            $this->pDFs[] = $pDF;
            $pDF->setPromotion($this);
        }

        return $this;
    }

    public function removePDF(PDF $pDF): self
    {
        if ($this->pDFs->removeElement($pDF)) {
            // set the owning side to null (unless already changed)
            if ($pDF->getPromotion() === $this) {
                $pDF->setPromotion(null);
            }
        }

        return $this;
    }

    public function getPromotionsLang(): ?PromotionsLang
    {
        return $this->promotionsLang;
    }

    public function setPromotionsLang(?PromotionsLang $promotionsLang): self
    {
        // unset the owning side of the relation if necessary
        if ($promotionsLang === null && $this->promotionsLang !== null) {
            $this->promotionsLang->setPromotion(null);
        }

        // set the owning side of the relation if necessary
        if ($promotionsLang !== null && $promotionsLang->getPromotion() !== $this) {
            $promotionsLang->setPromotion($this);
        }

        $this->promotionsLang = $promotionsLang;

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
