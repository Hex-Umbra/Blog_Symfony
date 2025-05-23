<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Password', PasswordType::class, [
                "label" => "Saisissez votre nouveau mot de passe",
                "attr" => ["class" => "w-full input input-bordered mb-3"],
                'label_attr' => [
                    'class' => 'text-gray-500 mb-2 block font-semibold',
                ],
            ])
            ->add('confirm', SubmitType::class, [
                'label' => 'Reset Password',
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
