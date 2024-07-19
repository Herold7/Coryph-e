<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    // Method that configures the actions available for this entry (Show, Edit, Delete)
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Identification')
                ->setIcon('user')->addCssClass('optional')
                ->setHelp('Identification du client'),
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('corporateName'),
            TextField::new('siret'),
            ImageField::new('image')
                ->setBasePath('uploads/users/')
                ->setUploadDir('public/uploads/users/'),
            
            FormField::addTab('Adresse')
                ->setIcon('home')->addCssClass('optional')
                ->setHelp('Toutes les informations d\'adressage du client'),
            TextField::new('address')->hideOnIndex(),
            TextField::new('additionalAddress')->hideOnIndex(),
            TextField::new('city')->hideOnIndex(),
            TextField::new('zip')->hideOnIndex(),
            CountryField::new('country')->hideOnIndex(),

            FormField::addTab('Contact')
                ->setIcon('phone')->addCssClass('optional')
                ->setHelp('Toutes les coordonnées du client'),
            EmailField::new('email'),
            TelephoneField::new('phone')->hideOnIndex(),

            FormField::addTab('Artistes')
                ->setIcon('cubes')->addCssClass('optional')
                ->setHelp('Artistes associés à ce compte'),
            AssociationField::new('artists')
                ->hideOnForm()
                ->setSortProperty('name'),

            FormField::addTab('Autres informations')
                ->setIcon('calendar')->addCssClass('optional')
                ->setHelp('Consent & dates'),
            BooleanField::new('consent')->hideOnIndex(),
            DateTimeField::new('created_at')->hideOnIndex(),
            DateTimeField::new('updated_at')->hideOnIndex(),
        ];
    }
}
