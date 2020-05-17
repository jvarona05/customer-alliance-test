<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Utils\FixtureUtils;
use App\Entity\HotelChain;
use App\Entity\Hotel;
use Ramsey\Uuid\Uuid;


class HotelFixtures extends Fixture 
{
    use FixtureUtils;

    private $tableName = 'hotel';

    public function load(ObjectManager $manager) : void
    {
        $hotels = $this->getData();

        foreach($hotels as $hotel)
            $manager->persist(
                $this->generateHotel($manager, $hotel)
            );

        $manager->flush();
    }

    private function generateHotel($manager, array $data) : Hotel
    {
        $hotel = new Hotel();

        $hotel->setUuid(Uuid::uuid4());
        $hotel->setName($data['name']);
        $hotel->setAddress($data['address']);
        $hotel->setHotelChain(
            $manager->getRepository(HotelChain::class)->find($data['hotel-chain-id'])
        );

        return $hotel;
    }

    
}
