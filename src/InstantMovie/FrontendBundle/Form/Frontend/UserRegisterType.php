<?php
namespace InstantMovie\FrontendBundle\Form\Frontend;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class UserRegisterType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
    ->add('nickname')
    ->add('password', 'repeated', array(
        'type' => 'password',
        'invalid_message' => 'Las dos contraseñas deben coincidir',
        'options' => array('label' => 'Contraseña')
        ))
    ->add('name')
    ->add('lastName')
    ->add('email','email');
}
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'InstantMovie\BackendBundle\Entity\User'));
    }

    public function getName()
    {
        return '';
    }
}
