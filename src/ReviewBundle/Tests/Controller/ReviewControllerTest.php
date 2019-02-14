<?php

namespace ReviewBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReviewControllerTest extends WebTestCase
{
    public function testRateemployer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/rateEmployer');
    }

    public function testRatefreelancer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/rateFreelancer');
    }

}
