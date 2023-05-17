<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Email(message="Please enter a valid email address")
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address_number;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $registration;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user_type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_of_unsuccessful_tests;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $banned;

    /**
     * @ORM\ManyToOne(targetEntity=PostalCodes::class, inversedBy="users")
     */
    private $postal_code;

    /**
     * @ORM\ManyToOne(targetEntity=Municipalities::class, inversedBy="users")
     */
    private $municipality;

    /**
     * @ORM\OneToOne(targetEntity=Coaches::class, inversedBy="users", cascade={"persist", "remove"})
     */
    private $coach;

    /**
     * @ORM\OneToOne(targetEntity=Customers::class, inversedBy="users", cascade={"persist", "remove"})
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity=Statistics::class, mappedBy="user", orphanRemoval=true)
     */
    private $statistics;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    public function __construct()
    {
        $this->statistics = new ArrayCollection();
    }

    public function __toString()
    {
        $this->getEmail();
        return $this->email;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAddressNumber(): ?string
    {
        return $this->address_number;
    }

    public function setAddressNumber(?string $address_number): self
    {
        $this->address_number = $address_number;

        return $this;
    }

    public function getRegistration(): ?\DateTimeInterface
    {
        return $this->registration;
    }

    public function setRegistration(?\DateTimeInterface $registration): self
    {
        $this->registration = $registration;

        return $this;
    }

    public function getUserType(): ?string
    {
        return $this->user_type;
    }

    public function setUserType(?string $user_type): self
    {
        $this->user_type = $user_type;

        return $this;
    }

    public function getNumberOfUnsuccessfulTests(): ?int
    {
        return $this->number_of_unsuccessful_tests;
    }

    public function setNumberOfUnsuccessfulTests(?int $number_of_unsuccessful_tests): self
    {
        $this->number_of_unsuccessful_tests = $number_of_unsuccessful_tests;

        return $this;
    }

    public function isBanned(): ?bool
    {
        return $this->banned;
    }

    public function setBanned(?bool $banned): self
    {
        $this->banned = $banned;

        return $this;
    }

    public function getPostalCode(): ?PostalCodes
    {
        return $this->postal_code;
    }

    public function setPostalCode(?PostalCodes $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getMunicipality(): ?Municipalities
    {
        return $this->municipality;
    }

    public function setMunicipality(?Municipalities $municipality): self
    {
        $this->municipality = $municipality;

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

    /**
     * @return Collection<int, Statistics>
     */
    public function getStatistics(): Collection
    {
        return $this->statistics;
    }

    public function addStatistic(Statistics $statistic): self
    {
        if (!$this->statistics->contains($statistic)) {
            $this->statistics[] = $statistic;
            $statistic->setUser($this);
        }

        return $this;
    }

    public function removeStatistic(Statistics $statistic): self
    {
        if ($this->statistics->removeElement($statistic)) {
            // set the owning side to null (unless already changed)
            if ($statistic->getUser() === $this) {
                $statistic->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
