<?php

namespace App\Controller\Admin;

use App\Entity\Comments;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comments::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('text'),
            AssociationField::new('articles'),
            AssociationField::new('user')->setFormTypeOption("choice_label", "email"),
            DateTimeField::new('createdAt')->hideOnForm(),
        ];
    }

}
