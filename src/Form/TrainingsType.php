<?php

namespace App\Form;

use App\Entity\Trainings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TrainingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')            
            ->add('price')
            ->add('creation_date')
            ->add('images', FileType::class,[
                'label' => 'Image',
                'multiple' => true,
                'mapped' => false,
                'required' => true
            ])
            // ->add('video')
            ->add('coache')
            ->add('forward')
            // ->add('trainingsLang')
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
            'data_class' => Trainings::class,
        ]);
    }
}
