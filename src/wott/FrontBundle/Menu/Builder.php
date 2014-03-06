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
}