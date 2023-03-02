<?php

namespace App\Controller\Admin;

use App\Entity\Pictures;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PicturesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pictures::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Photos')
        ->setEntityLabelInSingular('Photo')
        ->setPageTitle("index", "Quai Antique - Administration des photos")
        ->setPaginatorPageSize(20);
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
