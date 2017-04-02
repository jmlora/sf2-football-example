<?php

namespace AppBundle\Club\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Player\Form\PlayerType;

class ClubType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Nombre',
                'attr' => array(
                    'class' => 'form-control'
                    )
                ))
            ->add('phone', null, array(
                'label' => 'Teléfono',
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 9
                    )
                ))
            ->add('players', CollectionType::class, array(
                'entry_type' => PlayerType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'required' => false,
                'label' => 'Jugadores',
                'attr' => array(
                    'class' => 'player-collection'
                    )
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Club'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_club';
    }


}
