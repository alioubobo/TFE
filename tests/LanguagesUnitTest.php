<?php

namespace App\Tests;

use App\Entity\CoachesLang;
use App\Entity\CommentsLang;
use App\Entity\Languages;
use App\Entity\PromotionsLang;
use App\Entity\TrainingsLang;
use PHPUnit\Framework\TestCase;

class LanguagesUnitTest extends TestCase
{
    public function testTrue()
    {
        $language = new Languages();
        $promotionsLang = new PromotionsLang();
        $commentsLang = new CommentsLang();
        $coachesLang = new CoachesLang();
        $trainingLang = new TrainingsLang();

        $language->setCode('code')
                 ->setName('name')
                 ->setPromotionsLang($promotionsLang)
                 ->setCommentsLang($commentsLang)
                 ->setCoachesLang($coachesLang)
                 ->setTrainingsLang($trainingLang);

        $this->assertTrue($language->getCode() === 'code');
        $this->assertTrue($language->getName() === 'name');
        $this->assertTrue($language->getPromotionsLang() === $promotionsLang);
        $this->assertTrue($language->getCommentsLang() === $commentsLang);
        $this->assertTrue($language->getCoachesLang() === $coachesLang);
        $this->assertTrue($language->getTrainingsLang() === $trainingLang);
    }

    public function testFalse()
    {
        $language = new Languages();
        $promotionsLang = new PromotionsLang();
        $commentsLang = new CommentsLang();
        $coachesLang = new CoachesLang();
        $trainingLang = new TrainingsLang();
        $false = false;

        $language->setCode('code')
                 ->setName('name')
                 ->setPromotionsLang($promotionsLang)
                 ->setCommentsLang($commentsLang)
                 ->setCoachesLang($coachesLang)
                 ->setTrainingsLang($trainingLang);

        $this->assertFalse($language->getCode() === 'false');
        $this->assertFalse($language->getName() === 'false');
        $this->assertFalse($language->getPromotionsLang() === $false);
        $this->assertFalse($language->getCommentsLang() === $false);
        $this->assertFalse($language->getCoachesLang() === $false);
        $this->assertFalse($language->getTrainingsLang() === $false);
    }

    public function testIsEmpty()
    {
        $language = new Languages();       
        
        $this->assertEmpty($language->getCode());
        $this->assertEmpty($language->getName());
        $this->assertEmpty($language->getPromotionsLang());
        $this->assertEmpty($language->getCommentsLang());
        $this->assertEmpty($language->getCoachesLang());
        $this->assertEmpty($language->getTrainingsLang());
    }
}
