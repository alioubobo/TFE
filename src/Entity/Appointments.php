<?php

namespace App\Entity;

use App\Repository\AppointmentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppointmentsRepository::class)
 */
class Appointments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_appointments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $appointments_place;

    /**
     * @ORM\ManyToOne(targetEntity=Coaches::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coach;

    /**
     * @ORM\ManyToOne(targetEntity=Customers::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAppointments(): ?\DateTimeInterface
    {
        return $this->date_appointments;
    }

    public function setDateAppointments(\DateTimeInterface $date_appointments): self
    {
        $this->date_appointments = $date_appointments;

        return $this;
    }

    public function getAppointmentsPlace(): ?string
    {
        return $this->appointments_place;
    }

    public function setAppointmentsPlace(string $appointments_place): self
    {
        $this->appointments_place = $appointments_place;

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

    public function getCustomer(): ?Customers
    {
        return $this->customer;
    }

    public function setCustomer(?Customers $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
