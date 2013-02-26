LightNewsBundle
================

¿Another news/blog bundle? Yes!

The intention of LightNewsBundle is to provide a lightweight bundle without dependencies to other heavy bundles like Sonata.

LightNewsBundle works with Symfony 2.1 and works as a unit of work by itself.

You can use it in your blog or in the news section of your web application.

## 1. Modify your `composer.json`

    "require": {
        "carlescliment/light-news-bundle": "dev-master"
    }

## 2. Load the bundle in `app/AppKernel.php`
    $bundles = array(
         // Your other bundles
         new BladeTester\LightNewsBundle\BladeTesterLightNewsBundle(),
    );

## 3. Modify your `app/config/routing.yml`

    blade_tester_light_news:
        resource: "@BladeTesterLightNewsBundle/Resources/config/routing.yml"
		prefix:   /news


## 4. Modify your `app/config/config.yml` file:

    blade_tester_light_news:
        driver: doctrine/orm
        engine: twig
        classes:
            news:
                form: 'BladeTester\LightNewsBundle\Form\Type\NewsFormType'

## 5. Update your database schema

    app/console doctrine:schema:update --force

