<?php

namespace App\Controller\Admin;

use App\Entity\Formulas;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FormulasCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formulas::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Formules')
            ->setEntityLabelInSingular('Formule')
            ->setPageTitle("index", "Quai Antique - Administration des formules")
            ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            Field::new('description'),
            MoneyField::new('price')->setCurrency('EUR')
        ];
    }
}
