<?php

namespace App\Controller\Admin;

use App\Entity\Pictures;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
            ->setPaginatorPageSize(10);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('title')
                ->setLabel('Nom de l\'image'),
            TextField::new('text_alt')
                ->setLabel('Description'),
            TextField::new('imageFile')
                ->setFormType(VichImageType::class)
                ->setLabel('Importez votre image')
                ->onlyWhenCreating(),
            BooleanField::new('Carrousel'),
            ImageField::new('file')
                ->setBasePath('/uploads/pictures')
                ->onlyOnIndex(),
            TextareaField::new('imageFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
        ];
    }
}
