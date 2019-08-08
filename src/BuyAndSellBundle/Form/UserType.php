<?php

namespace BuyAndSellBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
$builder
    ->add('email', EmailType::class)
    ->add('fullName', TextType::class)
    ->add('password',RepeatedType::class, array(
        'type' => PasswordType::class,
        'first_options' => array('label' => 'Password'),
        'second_options' => array('label' => 'Repeat Password'),
        'invalid_message' => 'The password fields must match.',
    ))
->add('number', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BuyAndSellBundle\Entity\User'
        ));
    }
}
