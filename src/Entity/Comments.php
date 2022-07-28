<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 */
class Comments
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="date")
     */
    private $encoding_date;

    /**
     * @ORM\ManyToOne(targetEntity=Coaches::class, inversedBy="comments")
     */
    private $coach;

    /**
     * @ORM\ManyToOne(targetEntity=Customers::class, inversedBy="comments")
     */
    private $customer;

    /**
     * @ORM\OneToOne(targetEntity=CommentsLang::class, mappedBy="comment", cascade={"persist", "remove"})
     */
    private $commentsLang;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getEncodingDate(): ?\DateTimeInterface
    {
        return $this->encoding_date;
    }

    public function setEncodingDate(\DateTimeInterface $encoding_date): self
    {
        $this->encoding_date = $encoding_date;

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

    public function getCommentsLang(): ?CommentsLang
    {
        return $this->commentsLang;
    }

    public function setCommentsLang(?CommentsLang $commentsLang): self
    {
        // unset the owning side of the relation if necessary
        if ($commentsLang === null && $this->commentsLang !== null) {
            $this->commentsLang->setComment(null);
        }

        // set the owning side of the relation if necessary
        if ($commentsLang !== null && $commentsLang->getComment() !== $this) {
            $commentsLang->setComment($this);
        }

        $this->commentsLang = $commentsLang;

        return $this;
    }
}
