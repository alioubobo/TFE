<?php

namespace App\Entity;

use App\Repository\PDFRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PDFRepository::class)
 */
class PDF
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
    private $pdf;

    /**
     * @ORM\ManyToOne(targetEntity=Trainings::class, inversedBy="pDFs")
     */
    private $training;

    /**
     * @ORM\ManyToOne(targetEntity=Promotions::class, inversedBy="pDFs")
     */
    private $promotion;

    public function __toString()
    {
        $this->getPdf();
        return $this->pdf;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(string $pdf): self
    {
        $this->pdf = $pdf;

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
