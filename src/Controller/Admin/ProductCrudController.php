<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;


class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits');
    }
    public function configureFields(string $pageName): iterable
    {
        $required = true;

        if ($pageName=='edit') {
            $required= false;

        }

        return [

            IdField::new('ID')->setLabel("Id du produit")->setFormTypeOption("disabled","disabled")->onlyOnIndex(),
            TextField::new('name')->setLabel('Titre')->setHelp("Nom du produit"),
            SlugField::new('slug')->setLabel('URL')->setTargetFieldName('name')->setHelp("URL générée automatiquement."),
            TextEditorField::new('description')->setLabel('Description')->setHelp("Description de votre produit"),
            ImageField::new('illustration')
            ->setLabel('Image')
            ->setHelp('Image du produit')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
            ->setBasePath("/uploads")
            ->setUploadDir('/public/uploads')
            ->setRequired($required)
            ,
            NumberField::new('price')->setLabel('Prix (HT)')->setHelp('Prix HT du produit sans le symbole euro'),
            ChoiceField::new('tva')->setLabel('Taux de TVA')->setChoices([
                '5,5%' => '5.5',
                '10%' => '10',
                '20%' => '20'
            ]),
            AssociationField::new('category', 'Catégorie associée')
        
        ];
    }
}
