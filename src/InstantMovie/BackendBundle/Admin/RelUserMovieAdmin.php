<?php
// src/InstantMovie/BackendBundle/Admin/RelUserMovieAdmin.php

namespace InstantMovie\BackendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use InstantMovie\BackendBundle\Entity\User;
use InstantMovie\BackendBundle\Entity\Movie;

class RelUserMovieAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user', 'entity', array('class' => 'InstantMovie\BackendBundle\Entity\User'))
            ->add('movie', 'entity', array('class' => 'InstantMovie\BackendBundle\Entity\Movie'))
            ->add('comment', 'text', array('label' => 'Comment'))
            ->add('valoration', 'integer', array('label' => 'Valoration'))
            ->add('viewDate', 'datetime')
;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('viewDate')
            ->add('user')
            ->add('movie')
            ->add('comment')
            ->add('valoration')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('viewDate')
            ->addIdentifier('user')
            ->add('movie')
            ->add('comment')
            ->add('valoration')
        ;
    }
}
