<?php

namespace App\Entity;

use App\Repository\PromotionsLangRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionsLangRepository::class)
 */
class PromotionsLang
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
     * @ORM\OneToMany(targetEntity=Languages::class, mappedBy="promotionsLang")
     */
    private $language;

    /**
     * @ORM\OneToOne(targetEntity=Promotions::class, inversedBy="promotionsLang", cascade={"persist", "remove"})
     */
    private $promotion;

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
            $language->setPromotionsLang($this);
        }

        return $this;
    }

    public function removeLanguage(Languages $language): self
    {
        if ($this->language->removeElement($language)) {
            // set the owning side to null (unless already changed)
            if ($language->getPromotionsLang() === $this) {
                $language->setPromotionsLang(null);
            }
        }

        return $this;
    }

    public function getPromotion(): ?Promotions
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotions $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }
}
