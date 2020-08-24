<?php
declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    public function testTreeReturns200()
    {
        $client = static::createClient();

        $client->request('GET', '/tree');
        $this->assertResponseIsSuccessful();
    }
}

