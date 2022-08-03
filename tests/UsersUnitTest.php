<?php

namespace App\Tests;

use App\Entity\Coaches;
use App\Entity\Customers;
use App\Entity\Municipalities;
use App\Entity\PostalCodes;
use App\Entity\Users;
use DateTime;
use PHPUnit\Framework\TestCase;


class UsersUnitTest extends TestCase
{
    public function testTrue()
    {
        $user = new Users();
        $date = new DateTime();
        $postalcode = new PostalCodes();
        $municipality = new Municipalities();
        $coach = new Coaches();
        $customer = new Customers();        

        $user->setEmail('ars@gmail.com')
             ->setPassword('password')
             ->setAddressNumber('addNumber')
             ->setRegistration($date)
             ->setUserType('userType')
             ->setNumberOfUnsuccessfulTests(1)
             ->setBanned(true)
             ->setPostalCode($postalcode)
             ->setMunicipality($municipality)
             ->setCoach($coach)
             ->setCustomer($customer);           

        $this->assertTrue($user->getEmail() === 'ars@gmail.com');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getAddressNumber() === 'addNumber');
        $this->assertTrue($user->getRegistration() === $date);
        $this->assertTrue($user->getUserType() === 'userType');
        $this->assertTrue($user->getNumberOfUnsuccessfulTests() === 1);
        $this->assertTrue($user->IsBanned() === true);
        $this->assertTrue($user->getPostalCode() === $postalcode);
        $this->assertTrue($user->getMunicipality() === $municipality);
        $this->assertTrue($user->getCoach() === $coach);
        $this->assertTrue($user->getCustomer() === $customer);        
    }

    public function testFalse()
    {
        $user = new Users();
        $date = new DateTime();
        $postalcode = new PostalCodes();
        $municipality = new Municipalities();
        $coach = new Coaches();
        $customer = new Customers();   
        $false = false;     

        $user->setEmail('ars@gmail.com')
            ->setPassword('password')
            ->setAddressNumber('addNumber')
            ->setRegistration($date)
            ->setUserType('userType')
            ->setNumberOfUnsuccessfulTests(1)
            ->setBanned(true)
            ->setPostalCode($postalcode)
            ->setMunicipality($municipality)
            ->setCoach($coach)
            ->setCustomer($customer);           

        $this->assertFalse($user->getEmail() === 'false@gmail.com');
        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getAddressNumber() === 'false');
        $this->assertFalse($user->getRegistration() === new DateTime());
        $this->assertFalse($user->getUserType() === 'false');
        $this->assertFalse($user->getNumberOfUnsuccessfulTests() === '1');
        $this->assertFalse($user->IsBanned() === false);
        $this->assertFalse($user->getPostalCode() === $false);
        $this->assertFalse($user->getMunicipality() === $false);
        $this->assertFalse($user->getCoach() === $false);
        $this->assertFalse($user->getCustomer() === $false);        
    }

    public function testIsEmpty()
    {
        $user = new Users();        

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getAddressNumber());
        $this->assertEmpty($user->getRegistration());
        $this->assertEmpty($user->getUserType());
        $this->assertEmpty($user->getNumberOfUnsuccessfulTests());
        $this->assertEmpty($user->IsBanned());
        $this->assertEmpty($user->getPostalCode());
        $this->assertEmpty($user->getMunicipality());
        $this->assertEmpty($user->getCoach());
        $this->assertEmpty($user->getCustomer()); 
    }
}