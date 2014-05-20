<?php
// src/InstantMovie/BackendBundle/Admin/MovieAdmin.php

namespace InstantMovie\BackendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use InstantMovie\BackendBundle\Entity\Actor;
use InstantMovie\BackendBundle\Entity\Director;
use InstantMovie\BackendBundle\Entity\RelUserMovie;

class MovieAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('date', 'date', array('label' => 'date'))
            ->add('title', 'text', array('label' => 'Movie Title'))
            ->add('image', 'text', array('label' => 'Movie Image'))
            ->add('type', 'entity', array('class' => 'InstantMovie\BackendBundle\Entity\Gender'))
            ->add('country', 'entity', array('class' => 'InstantMovie\BackendBundle\Entity\Country'))
            ->add('synapses', 'textarea', array('label' => 'Synapses'))
            ->add('url', 'textarea', array('label' => 'Url'))
            ->add('actors', 'sonata_type_model', array('expanded' => false, 'by_reference' => false, 'multiple' => true))
            ->add('director', 'sonata_type_model', array('expanded' => false, 'by_reference' => false, 'multiple' => true))
            ->add('subidaPor', 'entity', array('class' => 'InstantMovie\BackendBundle\Entity\User'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('date')
            ->add('country')
            ->add('synapses')
            ->add('url')
            ->add('subidaPor')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('date')
            ->add('country')
            ->add('synapses')
            ->add('url')
            ->add('subidaPor')
        ;
    }
}
