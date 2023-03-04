<?php

namespace App\Controller\Admin;

use App\Entity\RestaurantHours;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RestaurantHoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RestaurantHours::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Horaires')
            ->setEntityLabelInSingular('Horaire')
            ->setPageTitle("index", "Quai Antique - Administration des horaires")
            ->setPaginatorPageSize(10);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('Day')
                ->setLabel('Jours de la semaine'),
            TimeField::new('Opening_lunch')
                ->setLabel('Ouverture Midi')
                ->setFormat('HH:mm'),
            TimeField::new('Closing_lunch')
                ->setLabel('Fermeture Midi')
                ->setFormat('HH:mm'),
            IntegerField::new('Places_available_lunch')
                ->setLabel('Nombre de places disponible'),
            TimeField::new('Opening_dinner')
                ->setLabel('Ouverture Soir')
                ->setFormat('HH:mm'),
            TimeField::new('Closing_dinner')
                ->setLabel('Fermeture Soir')
                ->setFormat('HH:mm'),
            IntegerField::new('Places_available_dinner')
                ->setLabel('Nombre de places disponible')
        ];
    }
}
