<?php

namespace App\Tests;

use App\Entity\Coaches;
use App\Entity\Trainings;
use DateTime;
use PHPUnit\Framework\TestCase;

class TrainingsUnitTest extends TestCase
{
    public function testTrue()
    {
        $training = new Trainings();
        $date = new DateTime();
        $coaches = new Coaches;

        $training->setName('name')                 
                 ->setDescription('description')
                 ->setForward(true)
                 ->setPrice(120)
                 ->setCreationDate($date)
                 ->setVideo('video')
                 ->setCoache($coaches);
                 

        $this->assertTrue($training->getName() === 'name');
        $this->assertTrue($training->getDescription() === 'description');
        $this->assertTrue($training->isForward() === true);
        $this->assertTrue($training->getPrice() === 120);
        $this->assertTrue($training->getCreationDate() === $date);
        $this->assertTrue($training->getVideo() === 'video');
        $this->assertTrue($training->getCoache() === $coaches);
    }

    public function testFalse()
    {
        $training = new Trainings();
        $date = new DateTime();
        $coaches = new Coaches;
        $false = false;

        $training->setName('name')                 
                 ->setDescription('description')
                 ->setForward(true)
                 ->setPrice(120)
                 ->setCreationDate($date)
                 ->setVideo('video')
                 ->setCoache($coaches);
                 

        $this->assertFalse($training->getName() === 'false');
        $this->assertFalse($training->getDescription() === 'false');
        $this->assertFalse($training->isForward() === false);
        $this->assertFalse($training->getPrice() === '120');
        $this->assertFalse($training->getCreationDate() === new DateTime());
        $this->assertFalse($training->getVideo() === 'false');
        $this->assertFalse($training->getCoache() === $false);
    }

    public function testEmpty()
    {
        $training = new Trainings();       

        $this->assertEmpty($training->getName());
        $this->assertEmpty($training->getDescription());
        $this->assertEmpty($training->isForward());
        $this->assertEmpty($training->getPrice());
        $this->assertEmpty($training->getCreationDate());
        $this->assertEmpty($training->getVideo());
        $this->assertEmpty($training->getCoache());
    }
}
