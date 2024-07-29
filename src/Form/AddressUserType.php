<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class AddressUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class,[
            'label' => "Prénom",
            'constraints' => [
                new Length([
                    'min' => 2,
                    'max' => 30
                ])
            ],
            'attr' =>[
                'placeholder'=>"Prénom du destinataire"
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
                'placeholder'=>"Nom du destinataire"
            ]
        ]
        )
            ->add('address', TextType::class,[
                'label' => "Adresse",
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ],
                'attr' =>[
                    'placeholder'=>"Adresse postale"
                ]
            ]
            )
            ->add('secondaryAddress', TextType::class,[
                'label' => "Complément d'adresse",
                'required'   => false,
                'attr' =>[
                    'placeholder'=>"(Facultatif)"
                ]
            ]
            )
            ->add('postal', TextType::class,[
                'label' => "Code postal",
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ],
                'attr' =>[
                    'placeholder'=>"Code postal du destinataire"
                ]
            ])
            ->add('city', TextType::class,[
                'label' => "Ville",
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ],
                'attr' =>[
                    'placeholder'=>"Ville du destinataire"
                ]
            ])
            ->add('country', CountryType ::class,[
                'label' => "Pays",
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ],
                'attr' =>[
                    'placeholder'=>"Pays du destinataire"
                ]
            ])
            ->add('phone', TextType::class,[
                'label' => "Numéro de téléphone",
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30
                    ])
                ],
                'attr' =>[
                    'placeholder'=>"Numéro de téléphone"
                ]
            ])

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
            'data_class' => Address::class,
        ]);
    }
}
