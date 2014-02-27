<?php

namespace wott\BackBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class FilmAdmin extends Admin
{

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('original_title', 'text')
            ->add('date_dvd', 'date', array('years' => range( date('Y'), '1900')))
            ->add('date_cinema', 'date', array('years' => range( date('Y'), '1900')))
            ->add('synopsis', 'text')
            ->add('nationalities', 'text')
            ->add('url_trailer', 'url')
            ->add('runtime', 'integer')
            ->add('popularity', 'number')
            ->add('url_poster', 'url')
            ->add('genres', 'entity', array('class' => 'wott\CoreBundle\Entity\Genre', 'property' => 'name', 'multiple' => true, 'by_reference' => false))
            ;
        
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('date_dvd')
            ->add('date_cinema')
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