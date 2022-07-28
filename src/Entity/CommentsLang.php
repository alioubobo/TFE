<?php

namespace App\Entity;

use App\Repository\CommentsLangRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentsLangRepository::class)
 */
class CommentsLang
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
     * @ORM\OneToMany(targetEntity=Languages::class, mappedBy="commentsLang")
     */
    private $language;

    /**
     * @ORM\OneToOne(targetEntity=Comments::class, inversedBy="commentsLang", cascade={"persist", "remove"})
     */
    private $comment;

    public function __construct()
    {
        $this->language = new ArrayCollection();
    }

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
            $language->setCommentsLang($this);
        }

        return $this;
    }

    public function removeLanguage(Languages $language): self
    {
        if ($this->language->removeElement($language)) {
            // set the owning side to null (unless already changed)
            if ($language->getCommentsLang() === $this) {
                $language->setCommentsLang(null);
            }
        }

        return $this;
    }

    public function getComment(): ?Comments
    {
        return $this->comment;
    }

    public function setComment(?Comments $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
