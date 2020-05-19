<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Hotel;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class HotelAPITest extends WebTestCase
{
    use FixturesTrait;

    private $entityManager;
    private $client;
    private $hotel;

    protected function setUp(): void
    {        
        $this->client = static::createClient();

        $kernel = self::bootKernel();

        $this->loadFixtures(array(
            'App\DataFixtures\HotelChainFixtures',
            'App\DataFixtures\HotelFixtures',
            'App\DataFixtures\ReviewFixtures'
        ));

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        
        $this->hotel = $this->entityManager->getRepository(Hotel::class)->find(1);
    }

    public function testGetAverage()
    {
        $this->client->request('GET', "/api/v1/hotels/{$this->hotel->getUuid()}/average");

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('{"average":6.5}', $this->client->getResponse()->getContent());
    }

    public function testGetReviews()
    {
        $this->client->request('GET', "/api/v1/hotels/{$this->hotel->getUuid()}/reviews");

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":1,"score":10,"comment":"Very nice stay"},{"id":2,"score":5,"comment":"Average"},{"id":3,"score":9,"comment":"Very nice stay, I enjoyed it a lot."},{"id":4,"score":2,"comment":"Worst experience ever."}]', $this->client->getResponse()->getContent()); 
    }

    public function testGetHotels()
    {
        $this->client->request('GET', '/api/v1/hotels');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":"1","name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin"},{"id":"2","name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin"},{"id":"3","name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin"},{"id":"4","name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin"},{"id":"5","name":"Hotel Alexanderplatz","address":"Alexanderplatz 1, 10409, Berlin"}]', $this->client->getResponse()->getContent());
    }
}
