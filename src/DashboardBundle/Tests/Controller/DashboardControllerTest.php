<?php

namespace DashboardBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardControllerTest extends WebTestCase
{
    public function testFreealancerdashboard()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/freealancerDashboard');
    }

    public function testEmployerdashboard()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/employerDashboard');
    }

}
