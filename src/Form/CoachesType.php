<?php

namespace App\Form;

use App\Entity\Coaches;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CoachesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('first_name')
            ->add('description')
            ->add('social_networking_link')
            ->add('users')
            ->add('images', FileType::class,[
                'label' => 'Image',
                'multiple' => false,
                'mapped' => false,
                'required' => true
            ])
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
