<?php

namespace BuyAndSellBundle\Form;


use BuyAndSellBundle;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class AdType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('price', TextType::class)
            ->add('info', TextType::class)
        ->add('img', FileType::class,
            [
                'constraints' => [
                    new File([
                        'maxSize' => '10024k'])
                ],
                'data_class' => null
            ]
        )
        ->add('location',TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BuyAndSellBundle\Entity\Ad'
        ));
    }
}
