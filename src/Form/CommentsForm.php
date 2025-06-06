<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Comments;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text', TextType::class, [
                "attr" => ["class" => "w-full h-32 p-3 bg-gray-800 border border-gray-600 rounded-lg text-white resize-y focus:outline-none focus:border-[#00D3BB] focus:ring-1 focus:ring-[#00D3BB]"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
