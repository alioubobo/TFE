<?php

namespace App\Entity;

use App\Repository\StatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticsRepository::class)
 */
class Statistics
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_of_visits;

    /**
     * @ORM\Column(type="integer")
     */
    private $visit_page;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="statistics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfVisits(): ?int
    {
        return $this->number_of_visits;
    }

    public function setNumberOfVisits(int $number_of_visits): self
    {
        $this->number_of_visits = $number_of_visits;

        return $this;
    }

    public function getVisitPage(): ?int
    {
        return $this->visit_page;
    }

    public function setVisitPage(int $visit_page): self
    {
        $this->visit_page = $visit_page;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }
}
