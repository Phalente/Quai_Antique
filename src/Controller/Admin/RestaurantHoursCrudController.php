<?php

namespace App\Controller\Admin;

use App\Entity\RestaurantHours;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RestaurantHoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RestaurantHours::class;
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
