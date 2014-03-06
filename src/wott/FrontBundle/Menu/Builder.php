<?php

namespace wott\FrontBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'homepage'));

        $menu->addChild('Mon espace', array('route' => 'homepage'));

        $menu->addChild('Nous contacter', array('route' => 'homepage'));

        return $menu;
    }

    public function filtersMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Genres', array('route' => 'homepage'))
            ->setAttribute('dropdown', true);
            $menu['Genres']->addChild('Genre 1', array('uri' => '#'));
            $menu['Genres']->addChild('Genre 2', array('uri' => '#'));

        $menu->addChild('Décennie', array('route' => 'homepage'))
            ->setAttribute('dropdown', true);
            $menu['Décennie']->addChild('1900', array('uri' => '#'));
            $menu['Décennie']->addChild('2000', array('uri' => '#'));

        $menu->addChild('Note', array('route' => 'homepage'));

        return $menu;
    }

}

