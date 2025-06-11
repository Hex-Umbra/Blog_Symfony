<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticlesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Articles::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title'),
            TextEditorField::new('content'),
            ImageField::new("image")
                ->setBasePath("uploads")
                ->setUploadDir("public/uploads"),
            DateField::new("createdAt")->onlyOnIndex(),
            DateField::new("updatedAt")->onlyOnIndex(),
            AssociationField::new("user")->setFormTypeOption("choice_label", "email"),
            AssociationField::new("category")->setFormTypeOption("choice_label", "name"),
            AssociationField::new("tags")->setFormTypeOption("choice_label", "name"),

        ];
    }
}
