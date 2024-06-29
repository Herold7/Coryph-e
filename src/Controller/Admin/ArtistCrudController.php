<?php

namespace App\Controller\Admin;

use App\Entity\Artist;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArtistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artist::class;
    }

    // Method that configures the actions available for this entry (Show, Edit, Delete)
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Identification')
                ->setIcon('home')->addCssClass('optional')
                ->setHelp('Toutes les informations à propos de l\'artiste'),
            IdField::new('id')->hideOnForm(),
            TextField::new('nickname'),
            IntegerField::new('number'),
            // BooleanField::new('professional'),
            TextField::new('city')->hideOnIndex(),
            CountryField::new('country')->hideOnIndex(),
            TelephoneField::new('phone')->hideOnIndex(),
            EmailField::new('mail'),
            TextareaField::new('bio')
                ->hideOnIndex()
                ->setNumOfRows(30),
            IntegerField::new('birthyear')
                ->hideOnIndex(),
            DateTimeField::new('created_at')->hideOnIndex(),
            DateTimeField::new('updated_at')->hideOnIndex(),
            // AssociationField::new('user')
            //     ->hideOnForm()
            //     ->setSortProperty('name'),
            AssociationField::new('category')
                ->hideOnForm()
                ->setSortProperty('name'),
            ImageField::new('image')
                ->setBasePath('uploads/artists/')
                ->setUploadDir('public/uploads/artists/'),
        ];
    }
}
