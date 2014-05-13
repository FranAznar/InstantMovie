<?php
// src/InstantMovie/BackendBundle/Admin/UserAdmin.php
namespace InstantMovie\BackendBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nickname', 'text', array('label' => 'nickname'))
            ->add('name', 'text', array('label' => 'name'))
            ->add('lastName', 'text', array('label' => 'last name'))
            ->add('email', 'text', array('label' => 'email'))
            ->add('password', 'text', array('label' => 'password'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nickname')
            ->add('password')
            ->add('name')
            ->add('lastName')
            ->add('email');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nickname')
            ->add('password')
            ->add('email');

    }

}
