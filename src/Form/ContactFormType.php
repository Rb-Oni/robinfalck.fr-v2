<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'autocomplete' => 'email',
                    'class' => 'mt-5 p-3',
                    'placeholder' => 'Saisissez votre adresse email'
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'veuillez entrer une adresse e-mail',
                    ]),
                ],
                'label' => 'E-Mail',
                'label_attr' => [
                    'class' => 'text-white text-2xl mt-10'
                ]
            ])
            ->add('subject', TextType::class, [
                'attr' => [
                    'class' => 'mt-5 p-3',
                    'maxlength' => 255,
                    'placeholder' => 'Saisissez un objet'
                ],
                'required' => true,
                'label' => 'Objet',
                'label_attr' => [
                    'class' => 'text-white text-2xl mt-10'
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'mt-5 p-3',
                    "rows" => '6',
                    'maxlength' => 1000,
                    'placeholder' => 'Saisissez un message...'
                ],
                'required' => true,
                'label' => 'Message',
                'label_attr' => [
                    'class' => 'text-white text-2xl mt-10'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'text-3xl font-bold bg-green hover:bg-white hover:text-black mt-10 text-white py-3 px-6 ease-in duration-150',
                ],
                'label' => 'ENVOYER',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
