<?php

namespace App\Form;

use App\Entity\Coaches;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoachesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('first_name')
            ->add('description')
            ->add('social_networking_link')
            // ->add('users')
            // ->add('image')
            // ->add('coachesLang')
            // ->add('favorites')
            ->add('save', SubmitType::class, [
                'label' => 'ajouter',
                'attr' => ['class' => 'submit'],
                'attr' => ['class' => 'btn-primary'],
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coaches::class,
        ]);
    }
}
