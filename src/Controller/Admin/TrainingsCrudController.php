<?php

namespace App\Controller\Admin;

use App\Entity\Trainings;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TrainingsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Trainings::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
