<?php

namespace wott\BackBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class FilmAdmin extends Admin
{

  /*  // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Title'))
            ->add('original_title', 'text', array('label' => 'Original Title'))
            ->add('date_dvd', 'datetime')
            ->add('date_cinema', 'datetime')
            ->add('synopsis', 'text', array('label' => 'Synopsis'))
            ;
        
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('original_title')
            ->add('date_dvd')
            ->add('date_cinema')
            ->add('synopsis')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
        ;
    }*/

}