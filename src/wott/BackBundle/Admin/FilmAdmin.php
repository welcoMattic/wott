<?php

namespace wott\BackBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class FilmAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {

        $collection->remove('create');
    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('original_title', 'text')
            ->add('release_date', 'genemu_jquerydate', array( 'widget' => 'single_text' ))
            ->add('synopsis', 'text')
            ->add('nationalities', 'text')
            ->add('url_trailer', 'url')
            ->add('runtime', 'integer')
            ->add('popularity', 'number')
            ->add('url_poster', 'url')
            ->add('genres', 'genemu_jqueryselect2_entity', array( 'class' => 'wott\CoreBundle\Entity\Genre', 'property' => 'name', 'multiple' => true))

            ;

    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('release_date')
            ->add('popularity')
            ->add('nationalities')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('_action', 'actions', array(
                'actions' => array(
                'show' => array(),
                'edit' => array(),
                'delete' => array(),
                )
            ))
        ;
    }

}
