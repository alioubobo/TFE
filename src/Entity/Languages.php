<?php

namespace App\Entity;

use App\Repository\LanguagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LanguagesRepository::class)
 */
class Languages
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
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=PromotionsLang::class, inversedBy="language")
     */
    private $promotionsLang;

    /**
     * @ORM\ManyToOne(targetEntity=CommentsLang::class, inversedBy="language")
     */
    private $commentsLang;

    /**
     * @ORM\ManyToOne(targetEntity=CoachesLang::class, inversedBy="language")
     */
    private $coachesLang;

    /**
     * @ORM\ManyToOne(targetEntity=TrainingsLang::class, inversedBy="language")
     */
    private $trainingsLang;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
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

    public function getPromotionsLang(): ?PromotionsLang
    {
        return $this->promotionsLang;
    }

    public function setPromotionsLang(?PromotionsLang $promotionsLang): self
    {
        $this->promotionsLang = $promotionsLang;

        return $this;
    }

    public function getCommentsLang(): ?CommentsLang
    {
        return $this->commentsLang;
    }

    public function setCommentsLang(?CommentsLang $commentsLang): self
    {
        $this->commentsLang = $commentsLang;

        return $this;
    }

    public function getCoachesLang(): ?CoachesLang
    {
        return $this->coachesLang;
    }

    public function setCoachesLang(?CoachesLang $coachesLang): self
    {
        $this->coachesLang = $coachesLang;

        return $this;
    }

    public function getTrainingsLang(): ?TrainingsLang
    {
        return $this->trainingsLang;
    }

    public function setTrainingsLang(?TrainingsLang $trainingsLang): self
    {
        $this->trainingsLang = $trainingsLang;

        return $this;
    }
}
