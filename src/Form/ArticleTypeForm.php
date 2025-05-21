<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Entity\Tags;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'attr' => ["class" => "w-full input input-bordered mb-3"],
                    'label_attr' => [
                        'class' => 'text-gray-500 mb-2 block font-semibold',
                    ],
                ]
            )
            ->add(
                'content',
                TextareaType::class,
                [
                    'attr' => ["class" => "w-full input mb-3"],
                    'label_attr' => [
                        'class' => 'text-gray-500 mb-2 block font-semibold',
                    ],
                ]
            )
            ->add('imageFile', FileType::class, [
                'attr' => [
                    "class" => "file-input",
                "placeholder"=> "Choisir une image"],
                'label_attr' => [
                    'class' => 'text-gray-500 mb-2 block font-semibold',
                ],
                'mapped'=>false,
                'required'=> false,
            ])
            ->add('category', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'name',
                'attr' => ["class" => "w-full select select-info mb-3"],
                'label_attr' => [
                    'class' => 'text-gray-500 mb-2 block font-semibold',
                ],
            ])
            ->add('tags', EntityType::class, [
                'class' => Tags::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'attr' => ["class" => "w-full mb-3 tom-select"],
                'label_attr' => [
                    'class' => 'text-gray-500 mb-2 block font-semibold',
                ],
            ])
            ->add("Submit", SubmitType::class, [
                "attr" => ["class" => "btn btn-success"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
