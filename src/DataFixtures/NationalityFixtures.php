<?php


namespace App\DataFixtures;

use App\Entity\Nationality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NationalityFixtures extends Fixture
{
    const NATIONALITIES = [
        'French',
        'English',
        'Spanish',
        'American',
        'German',
        'Swedish',
        'Canadian',
        'Iranian',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::NATIONALITIES as $key => $name) {
            $nationality = new Nationality();
            $nationality->setName($name);
            $manager->persist($nationality);
            $this->addReference('nationality_' . $key, $nationality);
        }
        $manager->flush();
    }
}