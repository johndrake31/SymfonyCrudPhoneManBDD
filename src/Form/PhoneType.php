<?php

namespace App\Form;

use App\Entity\Phone;
use App\Entity\Constructeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modelName')
            ->add('constructeur', EntityType::class, [
                'class' => Constructeur::class,
                'choice_label' => 'name'
            ])
            ->add('image')
            ->add('price')
            ->add('description')
            ->add('stockage')
            // ->add('createdDate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Phone::class,
        ]);
    }
}
