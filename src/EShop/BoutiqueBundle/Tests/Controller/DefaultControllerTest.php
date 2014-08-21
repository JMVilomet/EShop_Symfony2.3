<?php
/*
 * This file is part of the EShop application.
 *
 * (c) Jean-Michel VILOMET <jmvilomet@faeryscape.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace EShop\BoutiqueBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /** @var $client WebTestCase */
    private $client;
    
    public function testIndex()
    {
        $this->client = static::createClient();
        /** @var $crawler \Symfony\Component\DomCrawler\Crawler */
        $crawler = $this->client->request(
            'POST',
            '/rest/panier/creer',
            array("id"=>1),
            array(),
            array(
                'CONTENT_TYPE'          => 'text/html',
                'HTTP_X-Requested-With' => 'XMLHttpRequest',
            )
        );
        // On teste que la demande d'ajout dans le panier ne renvoie pas d'erreur
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "Ajout Ajax échoué");
        $crawler = $this->client->request('GET', '/');
        // On teste si le panier contient la ligne ajoutée
        $this->assertGreaterThan(0, $crawler->filter('#ligne_1')->count(), 'Aucune ligne ajoutée dans le panier');
    }
}
