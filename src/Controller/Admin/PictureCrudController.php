<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PictureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Picture::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Pictures')
            ->setEntityLabelInSingular('Picture')
            ->setPageTitle('index', 'Quai Antique - Administration des Pictures')
            ->setDefaultSort(['CreatedAt' => 'DESC'])
            ->setPaginatorPageSize(20);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('PictureName')
                ->hideOnIndex()
                ->hideOnForm(),
            TextField::new('PictureTitle')
                ->setLabel('Nom de l\'image'),
            TextField::new('text_alt')
                ->setLabel('Texte alternatif (Description)'),
            TextField::new('PictureFile')
                ->setFormType(VichImageType::class)
                ->setLabel('Importez votre image')
                ->onlyWhenCreating(),
            BooleanField::new('Slider'),
            ImageField::new('PictureName')
                ->setBasePath('/uploads/Pictures/')
                ->setLabel('Vos images')
                ->onlyOnIndex(),
            TextareaField::new('PictureFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
        ];
    }
}
