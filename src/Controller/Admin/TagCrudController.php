<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Identification')
            ->setIcon('home')->addCssClass('optional')
            ->setHelp('Toutes les informations à propos des tags'),
            IdField::new('id'),
            TextField::new('name'),
        ];
    }

}
