<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForgotPasswordForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Email', EmailType::class, [
                "label" => "Quel est votre email ?",
                "attr" => ["class" => "w-full input input-bordered mb-3"],
                'label_attr' => [
                    'class' => 'text-gray-500 mb-2 block font-semibold',
                ],

            ])
            ->add('confirm', SubmitType::class, [
                'label' => 'Get Email For Reset',
                'attr' => ['class' => 'btn btn-primary mt-3'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
