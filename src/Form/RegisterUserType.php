<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=> "E-mail.",
                'help'=>"Veuillez entrer une adresse e-mail valide",
                'attr' =>[
                    'placeholder'=>"Indiquez votre adresse mail"
                ]
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [
                    new Length([
                        'min'=> 4,
                        'max'=>30
                ])
                ],
                'first_options'  => ['label' => 'Votre mot de passe',
                'attr' =>[
                    'placeholder'=>"Créez votre mot de passe (minimum 4 caractères)"
                ],
                'hash_property_path' => 'password'],
                'second_options' => ['label' => 'Confirmation de votre mot de passe',
                'attr' =>[
                    'placeholder'=>"Confirmez votre mot de passe"
                ]],
                'mapped' => false,
            ])
            

            ->add('firstname', TextType::class,[
                'label' => "Prénom",
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ],
                'attr' =>[
                    'placeholder'=>"Indiquez votre Prénom"
                ]
            ])
            ->add('lastname', TextType::class,[
                'label' => "Nom",
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ],
                'attr' =>[
                    'placeholder'=>"Indiquez votre Nom"
                ]
            ]
            )
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-success'
                ]

                
            ]
            )
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints'=> [
                new UniqueEntity([
                    'entityClass'=> User::class,
                    'fields'=>'email'
                ])
            ],
            'data_class' => User::class,
        ]);
    }
}
