<?php

namespace App\Controller\Admin;

use App\Entity\Customers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Config\LiipImagineConfig;

class CustomersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customers::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('name'),
            TextField::new('first_name'),
            AssociationField::new('users'),
            
        ];
    }
    
}
