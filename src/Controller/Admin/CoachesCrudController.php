<?php

namespace App\Controller\Admin;

use App\Entity\Coaches;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CoachesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coaches::class;
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
