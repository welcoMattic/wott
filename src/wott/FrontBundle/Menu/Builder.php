<?php

namespace wott\FrontBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Accueil', array('route' => 'homepage'));
        $menu->addChild('Suggestions', array('route' => 'suggest'));
        $menu->addChild('Contact', array('route' => 'contact'));
        $menu->addChild('Mentions', array('route' => 'mentions'));

        return $menu;
    }

    public function filtersMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Trier par')
            ->setAttribute('class', 'navbar-text');

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

    public function profileMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Ma Watchlist', array('route' => 'profile'));
        $menu->addChild('Films vus', array('route' => 'profile', 'routeParameters' => array('action' => 'seen')));
        $menu->addChild('Mes Likes', array('route' => 'profile', 'routeParameters' => array('action' => 'like')));
        $menu->addChild('Mes informations', array('route' => 'sonata_user_profile_edit_authentication'));

        return $menu;
    }

}
