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
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
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
                ->setIcon('user')->addCssClass('optional')
                ->setHelp('Identification de l\'artiste'),
            IdField::new('id')->hideOnForm(),
            TextField::new('nickname'),
            AssociationField::new('category')
                ->hideOnForm()
                ->setSortProperty('name'),
            IntegerField::new('birthyear')
                ->hideOnIndex(),
            IntegerField::new('number'),
            ImageField::new('image')
                ->setBasePath('uploads/artists/')
                ->setUploadDir('public/uploads/artists/'),
            // BooleanField::new('professional'),

            FormField::addTab('Biographie')
            ->setIcon('pen-to-square')->addCssClass('optional')
            ->setHelp('Biographie de l\'artiste'),
            TextEditorField::new('bio')
                ->hideOnIndex()
                ->setNumOfRows(10),

            FormField::addTab('Adresse')
                ->setIcon('home')->addCssClass('optional')
                ->setHelp('Toutes les informations d\'adressage de l\'artiste'),
            TextField::new('city')->hideOnIndex(),
            CountryField::new('country')->hideOnIndex(),

            FormField::addTab('Contact')
                ->setIcon('phone')->addCssClass('optional')
                ->setHelp('Toutes les coordonnées du client'),
            TelephoneField::new('phone')->hideOnIndex(),
            EmailField::new('mail'),

            FormField::addTab('Autres informations')
                ->setIcon('calendar')->addCssClass('optional')
                ->setHelp('Consent & dates'),
            DateTimeField::new('created_at')->hideOnIndex(),
            DateTimeField::new('updated_at')->hideOnIndex(),
            // AssociationField::new('user')
            //     ->hideOnForm()
            //     ->setSortProperty('name'),
            
        ];
    }
}
