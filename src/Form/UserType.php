<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $role_list = [
            'Administrateur' => 'ADMIN',
            'Utilisateur' => 'USER'
        ];
        $builder
            ->add('email', null)
            /* ->add('roles', null ChoiceType::class, [
                'choices' => $role_list,
                'label' => "Rôle de l\'utilisateur",
                'required' => true,
            ]) */
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'repeat Password'],
            ])
            ->add('nom', null)
            ->add('prenom', null)
            ->add('tel', null)
            ->add('adresse', null)
            ->add('isactive', null)
            ->add('typeCompte', null)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
