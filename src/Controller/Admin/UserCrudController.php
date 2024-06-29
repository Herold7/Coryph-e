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
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Identification')
                ->setIcon('user')->addCssClass('optional')
                ->setHelp('Toutes les informations à propos de client'),
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            EmailField::new('email'),
            TextField::new('corporateName'),
            TextField::new('siret'),
            TelephoneField::new('phone')->hideOnIndex(),
            TextField::new('address')->hideOnIndex(),
            TextField::new('additionalAddress')->hideOnIndex(),
            TextField::new('city')->hideOnIndex(),
            TextField::new('zip')->hideOnIndex(),
            CountryField::new('country')->hideOnIndex(),
            BooleanField::new('consent')->hideOnIndex(),
            DateTimeField::new('created_at')->hideOnIndex(),
            DateTimeField::new('updated_at')->hideOnIndex(),
            ImageField::new('image')
                ->setBasePath('uploads/users/')
                ->setUploadDir('public/uploads/users/'),
            AssociationField::new('artists')
                ->hideOnForm()
                ->setSortProperty('name'),
        ];
    }
}
