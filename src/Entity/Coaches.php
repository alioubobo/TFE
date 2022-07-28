<?php

namespace App\Entity;

use App\Repository\CoachesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoachesRepository::class)
 */
class Coaches
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
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $social_networking_link;

    /**
     * @ORM\OneToMany(targetEntity=Trainings::class, mappedBy="coache", orphanRemoval=true)
     */
    private $trainings;

    /**
     * @ORM\OneToOne(targetEntity=Users::class, mappedBy="coach", cascade={"persist", "remove"})
     */
    private $users;

    /**
     * @ORM\OneToOne(targetEntity=Images::class, mappedBy="coach")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Appointments::class, mappedBy="coach", orphanRemoval=true)
     */
    private $appointments;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="coach")
     */
    private $comments;    

    /**
     * @ORM\OneToOne(targetEntity=CoachesLang::class, mappedBy="coach", cascade={"persist", "remove"})
     */
    private $coachesLang;

    /**
     * @ORM\ManyToMany(targetEntity=Customers::class, inversedBy="favorites")
     */
    private $favorites;   

    public function __construct()
    {
        $this->trainings = new ArrayCollection();    
        $this->appointments = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->favorites = new ArrayCollection();              
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

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

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

    public function getSocialNetworkingLink(): ?string
    {
        return $this->social_networking_link;
    }

    public function setSocialNetworkingLink(?string $social_networking_link): self
    {
        $this->social_networking_link = $social_networking_link;

        return $this;
    }

    /**
     * @return Collection<int, Trainings>
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }

    public function addTraining(Trainings $training): self
    {
        if (!$this->trainings->contains($training)) {
            $this->trainings[] = $training;
            $training->setCoache($this);
        }

        return $this;
    }

    public function removeTraining(Trainings $training): self
    {
        if ($this->trainings->removeElement($training)) {
            // set the owning side to null (unless already changed)
            if ($training->getCoache() === $this) {
                $training->setCoache(null);
            }
        }

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        // unset the owning side of the relation if necessary
        if ($users === null && $this->users !== null) {
            $this->users->setCoach(null);
        }

        // set the owning side of the relation if necessary
        if ($users !== null && $users->getCoach() !== $this) {
            $users->setCoach($this);
        }

        $this->users = $users;

        return $this;
    }

    public function getImage(): ?Images
    {
        return $this->image;
    }

    public function setImage(?Images $image): self
    {
        $this->image = $image;

        return $this;
    }   

    /**
     * @return Collection<int, Appointments>
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointments $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setCoach($this);
        }

        return $this;
    }

    public function removeAppointment(Appointments $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getCoach() === $this) {
                $appointment->setCoach(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setCoach($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCoach() === $this) {
                $comment->setCoach(null);
            }
        }

        return $this;
    }

    public function getCoachesLang(): ?CoachesLang
    {
        return $this->coachesLang;
    }

    public function setCoachesLang(?CoachesLang $coachesLang): self
    {
        // unset the owning side of the relation if necessary
        if ($coachesLang === null && $this->coachesLang !== null) {
            $this->coachesLang->setCoach(null);
        }

        // set the owning side of the relation if necessary
        if ($coachesLang !== null && $coachesLang->getCoach() !== $this) {
            $coachesLang->setCoach($this);
        }

        $this->coachesLang = $coachesLang;

        return $this;
    }

    /**
     * @return Collection<int, Customers>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Customers $favorite): self
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites[] = $favorite;
        }

        return $this;
    }

    public function removeFavorite(Customers $favorite): self
    {
        $this->favorites->removeElement($favorite);

        return $this;
    }
   
}
