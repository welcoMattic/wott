<?php

namespace wott\FrontBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{


    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Accueil', array('route' => 'homepage'));
        $menu->addChild('Suggestions', array('route' => 'suggest'));
        $menu->addChild('Contact', array('route' => 'contact'));
        $menu->addChild('Mentions', array('route' => 'mentions'));

        return $menu;
    }

    public function filtersMenu(FactoryInterface $factory, array $options)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $genres = $em->getRepository('wottCoreBundle:Genre')->findAll();

        $menu = $factory->createItem('root');

        $menu->addChild('Trier par')
            ->setAttribute('class', 'navbar-text');

        $menu->addChild('Genres', array('route' => 'homepage'))
            ->setAttribute('dropdown', true)
            ->setAttribute('data-toggle', 'dropdown')
            ->setChildrenAttributes(array('class' => 'genres'));

        foreach($genres as $genre) {
            $menu['Genres']->addChild($genre->getName(), array('uri' => $genre->getId()))
                            ->setAttribute('data-id', $genre->getId());
        }

        $menu->addChild('Note', array('route' => 'homepage'));

        return $menu;
    }

    public function profileMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Ma Watchlist', array('route' => 'profile'));
        $menu->addChild('Films vus', array('route' => 'profile', 'routeParameters' => array('action' => 'seen')));
        $menu->addChild('Mes Likes', array('route' => 'profile', 'routeParameters' => array('action' => 'like')));
        $menu->addChild('Mes informations', array('route' => 'sonata_user_profile_edit_authentication'));

        return $menu;
    }

}
