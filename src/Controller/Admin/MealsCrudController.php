<?php

namespace App\Controller\Admin;

use App\Entity\Meals;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MealsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Meals::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('title'),
            MoneyField::new('price')->setCurrency('EUR')
        ];
    }
}
