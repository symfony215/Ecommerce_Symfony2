<?php

namespace Ecommerce\EcommerceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoriesControllerTest extends WebTestCase
{
    public function testAllcategories()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'all');
    }

    public function testCategorie()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/categorie/{id}');
    }

}
