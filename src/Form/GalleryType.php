<?php

namespace App\Form;

use App\Entity\Gallery;
use Symfony\Component\{Form\AbstractType,
    Form\Extension\Core\Type\TextareaType,
    Form\FormBuilderInterface,
    OptionsResolver\OptionsResolver};

/**
 * Class GalleryType
 * @package App\Form
 */
class GalleryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content', TextareaType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gallery::class,
        ]);
    }
}
