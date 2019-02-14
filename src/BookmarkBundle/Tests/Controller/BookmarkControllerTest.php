<?php

namespace BookmarkBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookmarkControllerTest extends WebTestCase
{
    public function testFreelancerbookmarks()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/freelancerBookmarks');
    }

    public function testEmployerbookmarks()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/employerBookmarks');
    }

}
