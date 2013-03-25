LightNewsBundle
================

This bundle provides a lightweight framework to handle news or blog posts without the need of installing other heavy bundles like Sonata. The intention of LightNewsBundle is to allow developers adding their own logic without having to deal with the management of CRUD operations.

LightNewsBundle works with Symfony 2.1 and has almost no dependencies.


## Installation

### 1. Update your vendors

Add this line to your `composer.json`

    "require": {
        "carlescliment/light-news-bundle": "dev-master"
    }

Execute `php composer.phar update carlescliment/light-news-bundle`

### 2. Load the bundle in `app/AppKernel.php`
    $bundles = array(
         // Your other bundles
         new BladeTester\LightNewsBundle\BladeTesterLightNewsBundle(),
    );

### 3. Modify your `app/config/routing.yml`

    blade_tester_light_news_bundle:
        resource: "@BladeTesterLightNewsBundle/Resources/config/routing.yml"
        prefix:   /news        #choose the prefix you want


## Configuring your own news bundle

### 1. Create your own bundle overriding LightNewsBundle

    namespace My\NewsBundle;

    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class MyNewsBundle extends Bundle
    {

       public function getParent()
        {
            return 'BladeTesterLightNewsBundle';
        }
    }


### 2. Map a News class

Create an entity and inherit the base News class. The only mandatory field you have to add is "id" to map your entity properly.

NOTE: At the moment it works only with Doctrine. Contribution to provide other drivers will be very appreciated.


    namespace My\NewsBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use BladeTester\LightNewsBundle\Entity\News as BaseNews;


    /**
     * @ORM\Entity()
     * @ORM\Table(name="news")
     */
    class News extends BaseNews {

        /**
         * @ORM\Column(name="id", type="integer")
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $id;


        public function getId() {
            return $this->id;
        }
    }


### 3. Setup your News class in `app/config/config.yml` file:

    blade_tester_light_news:
        driver: doctrine/orm
        engine: twig
        classes:
            news:
                entity: 'My\NewsBundle\Entity\News'

### 4. Update your database schema

    app/console doctrine:schema:update --force


## Basic usage

LightNewsBundle provides the basic CRUD management. It's up to you to handle the security to allow or disallow users to administer news.

By default, you can access to the following routes:

- {prefix}/  -> Homepage
- {prefix}/{id} -> Display a piece of news
- {prefix}/admin -> Admin homepage
- {prefix}/admin/add -> Create a piece of news.
- {prefix}/admin/{id}/remove -> Delete the piece of news with id {id}.
- {prefix}/admin/{id}/edit -> Edits the piece of news with id {id}.


## Overriding the bundle

LightNewsBundle is aimed to be easily overrideable. You can override it the same way you normally override bundles in Symfony.

### Templates
Place a template with the same name and in the same dir and Symfony will load it instead of the default one.
For example, you could override the template Default/base.html.twig and inherit your base app template.

### Controllers
Place a controller with the same name in your bundle to override the default behaviour

### Routes
You can also override routes or define new ones.

### Forms
LightNewsBundle provides a default form to manage the basic entity. If you create your entity with extra fields, you will need to use a custom form. Just configure it in your `app/config/config.yml` file

    blade_tester_light_news:
        driver: doctrine/orm
        engine: twig
        classes:
            news:
                entity: Your\NewsBundle\Entity\News
        forms:
            news:
                class: Your\NewsBundle\Form\YourCustomForm


## The manager

If you plan to customize LightNewsBundle, you will probably need to use the NewsManager service. It will be better explained with an example:


    public function yourCustomAction()
    {
        $manager = $this->get('blade_tester_light_news.news_manager')
        $news = $manager->build(); // builds a non-persisted instance of your News class.
        $news = $manager->create('Title', 'body'); // builds and persists a piece of news.
        $news = $manager->find(33); // Retrieves the instance with id 33 from the database
        $manager->remove($news); // Removes a news instance
        $all_news = $manager->findAll(); // Retrieves all the instances from the database
	$manager->refresh($news); // Uses the entity manager to refresh the item
    }



## Credits

* Author: [Carles Climent][carlescliment]
* Contributor: [Fran Moreno][franmomu]


## Contribute and feedback

Please, feel free to provide feedback of this bundle. Contributions will be much appreciated.



[carlescliment]: https://github.com/carlescliment
[franmomu]: https://github.com/franmomu

