<?php

namespace App\Controller\Admin;

use App\Entity\Menus;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MenusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Menus::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Menus')
            ->setEntityLabelInSingular('Menu')
            ->setPageTitle("index", "Quai Antique - Administration des menus")
            ->setPaginatorPageSize(10);
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
