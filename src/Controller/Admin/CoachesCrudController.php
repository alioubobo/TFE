<?php

namespace App\Controller\Admin;

use App\Entity\Coaches;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CoachesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coaches::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name'),
            TextField::new('first_name'),
            TextField::new('description'),
        ];
    }
    
}
