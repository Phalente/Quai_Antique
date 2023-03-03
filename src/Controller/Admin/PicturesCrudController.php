<?php

namespace App\Controller\Admin;

use App\Entity\Pictures;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Vich\UploaderBundle\Form\Type\VichImageType;

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


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('title')
                ->setLabel('nom de l\'image'),
            TextField::new('text_alt')
                ->setLabel('Description'),
            TextField::new('ImageFile')
                ->setFormType(VichImageType::class)
                ->setLabel('Importez votre image')
                ->onlyWhenCreating(),
            ImageField::new('file')
                ->setBasePath('/uploads/pictures')
                ->onlyOnIndex(),
            TextareaField::new('ImageFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
        ];
    }
}
