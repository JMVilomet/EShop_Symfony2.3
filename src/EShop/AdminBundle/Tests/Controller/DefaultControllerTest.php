<?php
/*
 * This file is part of the EShop application.
 *
 * (c) Jean-Michel VILOMET <jmvilomet@faeryscape.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */
namespace EShop\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultControllerTest extends WebTestCase
{
    private $client = null;

    /**
     * Création d'un client authentifié
     * cf: http://advancingusability.wordpress.com/2013/11/15/functional-testing-with-authentication-and-symfony-2-3-fosuserbundle/
     */
    protected function createAuthorizedClient()
    {
     $client = static::createClient();
     $container = $client->getContainer();

     $session = $container->get('session');
     /** @var $userManager \FOS\UserBundle\Doctrine\UserManager */
     $userManager = $container->get('fos_user.user_manager');
     /** @var $loginManager \FOS\UserBundle\Security\LoginManager */
     $loginManager = $container->get('fos_user.security.login_manager');
     $firewallName = $container->getParameter('fos_user.firewall_name');

     $user = $userManager->findUserBy(array('username' => 'admin'));
     $loginManager->loginUser($firewallName, $user);

     // save the login token into the session and put it in a cookie
     $container->get('session')->set('_security_' . $firewallName, 
     serialize($container->get('security.context')->getToken()));
     $container->get('session')->save();
     $client->getCookieJar()->set(new Cookie($session->getName(), $session->getId()));

     return $client;
    }

    public function testIndex()
    {
        $this->client = $client = static::createClient();

        // Vérification de la redirection de la page admin vers connexion
        $client->followRedirects(false);
        $crawler = $this->client->request('GET', '/admin');
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode(), "Redirection vers la page de connexion absente");

        // On teste le mauvais login
        $client->followRedirects(true);
        $crawler = $this->client->request('GET', '/connexion');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "Code de retour erroné pour la page /connexion (appel 1)");
        $form = $crawler->selectButton('_submit')->form(array(
            '_username'  => 'admin',
            '_password'  => 'wrong',
        ));
        
        $crawler = $this->client->submit($form);//$client->followRedirect();
        $this->assertGreaterThan(0, $crawler->filter('div:contains("utilisateur ou mot de passe incorrect")')->count(), 'Message d\'erreur d\'authentification erroné');
        
        // On teste le bon login
        $client->followRedirects(true);
        $crawler = $this->client->request('GET', '/connexion');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "Code de retour erroné pour la page /connexion (appel 2)");
        $form = $crawler->selectButton('_submit')->form(array(
            '_username'  => 'admin',
            '_password'  => 'admin',
        ));
        $crawler = $this->client->submit($form);
        $this->assertGreaterThan(0, $crawler->filter('a:contains("catalogue")')->count(), 'Mauvaise page après la connexion');
    }
    
    public function testCommande(){
        $this->client = $this->createAuthorizedClient();
        $crawler = $this->client->request('GET', '/admin/commande');
        //print "Code :".$this->client->getResponse()->getStatusCode()."\n\n".$this->client->getResponse()->getContent();
        $this->assertGreaterThan(0, $crawler->filter('h3:contains("Liste des commandes")')->count(), 'Page commande innaccessible');
    }
    
}
