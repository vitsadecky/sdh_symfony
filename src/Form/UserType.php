<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\{AbstractType,
    Extension\Core\Type\DateType,
    Extension\Core\Type\EmailType,
    Extension\Core\Type\PasswordType,
    Extension\Core\Type\RepeatedType,
    FormBuilderInterface};
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserType
 * @package App\Form
 */
class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('surname')
            ->add('email', EmailType::class)
            ->add('language')
            ->add('login')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
            ])
            ->add('birthDate', DateType::class, ['label' => 'narozeni'])
            ->add('gender');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,

        ]);
    }
}
