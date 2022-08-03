<?php

namespace App\Tests;

use App\Entity\Coaches;
use PHPUnit\Framework\TestCase;

class CoachesUnitTest extends TestCase
{
    public function testTrue()
    {
        $coach = new Coaches();        

        $coach->setName('name')
              ->setFirstName('firstName')
              ->setDescription('description')
              ->setSocialNetworkingLink('socialLink');              

        $this->assertTrue($coach->getName() === 'name');
        $this->assertTrue($coach->getFirstName() === 'firstName');
        $this->assertTrue($coach->getDescription() === 'description');
        $this->assertTrue($coach->getSocialNetworkingLink() === 'socialLink');
    }

    public function testFalse()
    {
        $coach = new Coaches();        

        $coach->setName('name')
              ->setFirstName('firstname')
              ->setDescription('description')
              ->setSocialNetworkingLink('socialLink');              

        $this->assertFalse($coach->getName() === 'false');
        $this->assertFalse($coach->getFirstName() === 'false');
        $this->assertFalse($coach->getDescription() === 'false');
        $this->assertFalse($coach->getSocialNetworkingLink() === 'false');
    }

    public function testIsEmpty()
    {
        $coach = new Coaches();     

        $this->assertEmpty($coach->getName());
        $this->assertEmpty($coach->getFirstName());
        $this->assertEmpty($coach->getDescription());
        $this->assertEmpty($coach->getSocialNetworkingLink());
    }
}
