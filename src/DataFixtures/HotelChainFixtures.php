<?php

namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Utils\FixtureUtils;
use App\Entity\HotelChain;

class HotelChainFixtures extends Fixture
{
    use FixtureUtils;

    private $tableName = 'hotel_chain';

    public function load(ObjectManager $manager) :void
    {        
        $hotelChains = $this->getData();

        foreach($hotelChains as $hotelChains)
            $manager->persist(
                $this->generateHotelChain($hotelChains)
            );

        $manager->flush();
    }

    private function generateHotelChain(array $data) : HotelChain
    {
        $hotelChain = new HotelChain();

        $hotelChain->setName($data['name']);
        $hotelChain->setUrl($data['url']);

        return $hotelChain;
    }
}
