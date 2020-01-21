<?php


namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 300; $i++) {
            $customer = new Customer();
            $customer->setFirstname($faker->firstName);
            $customer->setLastname($faker->lastName);
            $customer->setEmail($faker->email);
            $manager->persist($customer);
            $customer->setNationality($this->getReference('nationality_' . rand(0,7)));
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [NationalityFixtures::class];
    }

}
