<?php

namespace Sch\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PhoneControllerTest extends WebTestCase
{
    public function testVerify()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/verify');
    }

}
