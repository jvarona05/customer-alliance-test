<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Utils\FixtureUtils;
use App\Entity\HotelChain;
use App\Entity\Review;
use App\Entity\Hotel;

class ReviewFixtures extends Fixture 
{
    use FixtureUtils;

    private $tableName = 'review';

    public function load(ObjectManager $manager) : void
    {
        $reviews = $this->getData();

        foreach($reviews as $review)
            $manager->persist(
                $this->generateReview($manager, $review)
            );

        $manager->flush();
    }

    private function generateReview($manager, array $data) : Review
    {
        $review = new Review();

        $review->setComment($data['comment']);
        $review->setScore($data['score']);
        $review->setHotel(
            $manager->getRepository(Hotel::class)->find($data['hotel-id'])
        );

        return $review;
    }    
}
