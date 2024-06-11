<?php

namespace App\Entity;

use App\Repository\TrainingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrainingsRepository::class)
 */
class Trainings
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $forward;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="date")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @ORM\ManyToOne(targetEntity=Coaches::class, inversedBy="trainings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coache;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="training", cascade={"persist", "remove"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=PDF::class, mappedBy="training", cascade={"persist", "remove"})
     */
    private $pDFs;

    /**
     * @ORM\OneToOne(targetEntity=TrainingsLang::class, mappedBy="training", cascade={"persist", "remove"})
     */
    private $trainingsLang;

    /**
     * @ORM\OneToMany(targetEntity=Promotions::class, mappedBy="training")
     */
    private $promotions;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->pDFs = new ArrayCollection();
        $this->promotions = new ArrayCollection();
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

    public function isForward(): ?bool
    {
        return $this->forward;
    }

    public function setForward(?bool $forward): self
    {
        $this->forward = $forward;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getCoache(): ?Coaches
    {
        return $this->coache;
    }

    public function setCoache(?Coaches $coache): self
    {
        $this->coache = $coache;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setTraining($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getTraining() === $this) {
                $image->setTraining(null);
            }
        }

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
            $pDF->setTraining($this);
        }

        return $this;
    }

    public function removePDF(PDF $pDF): self
    {
        if ($this->pDFs->removeElement($pDF)) {
            // set the owning side to null (unless already changed)
            if ($pDF->getTraining() === $this) {
                $pDF->setTraining(null);
            }
        }

        return $this;
    }

    public function getTrainingsLang(): ?TrainingsLang
    {
        return $this->trainingsLang;
    }

    public function setTrainingsLang(?TrainingsLang $trainingsLang): self
    {
        // unset the owning side of the relation if necessary
        if ($trainingsLang === null && $this->trainingsLang !== null) {
            $this->trainingsLang->setTraining(null);
        }

        // set the owning side of the relation if necessary
        if ($trainingsLang !== null && $trainingsLang->getTraining() !== $this) {
            $trainingsLang->setTraining($this);
        }

        $this->trainingsLang = $trainingsLang;

        return $this;
    }

    /**
     * @return Collection<int, Promotions>
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotions $promotion): self
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions[] = $promotion;
            $promotion->setTraining($this);
        }

        return $this;
    }

    public function removePromotion(Promotions $promotion): self
    {
        if ($this->promotions->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getTraining() === $this) {
                $promotion->setTraining(null);
            }
        }

        return $this;
    }
}
