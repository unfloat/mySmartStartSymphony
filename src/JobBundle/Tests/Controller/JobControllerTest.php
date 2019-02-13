<?php

namespace JobBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobControllerTest extends WebTestCase
{
    public function testManagejobs()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/manageJobs');
    }

}
