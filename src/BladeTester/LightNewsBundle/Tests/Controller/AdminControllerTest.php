<?php

namespace BladeTester\LightNewsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{

	private $client;
	private $router;
	private $em;

	public function setUp() {
        $this->client = static::createClient();
		$this->router = self::$kernel->getContainer()->get('router');
		$this->em = self::$kernel->getContainer()->get('doctrine.orm.entity_manager');
	}

	/**
	 * @test
	 */
    public function shouldAddAPost()
    {
    	// Arrange
        $crawler = $this->visit('news_add');
        $form = $crawler->filter('form#news-add')->form();
        $data = array(
        	'news[created][year]' => '2013',
        	'news[created][month]' => '2',
        	'news[created][day]' => '26',
        	'news[created][hour]' => '12',
        	'news[created][minute]' => '10',
        	'bladetester_lightnews_news[title]' => 'Foo Title',
        	'bladetester_lightnews_news[body]' => '<p>This is a raw HTML body</p>');

        // Act
        $this->client->submit($form);

        // Assert
        $posts = $this->getRepository('BladeTesterLightNewsBundle:News');
        $this->assertCount(1, $posts);
    }


    private function visit($path_name, array $arguments = array()) {
    	$uri = $this->router->generate($path_name, $arguments);
    	return $this->client->request('GET', $uri);
    }
}
