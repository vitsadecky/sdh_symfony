<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{
    TextType, SubmitType, TextareaType, EmailType
};


/**
 * Class NotificationType
 * @package App\Form
 */
class NotificationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('senderName', TextType::class)
            ->add('senderEmail', EmailType::class)
            ->add('subject', TextType::class)
            ->add('body', TextareaType::class)
            ->add('send', SubmitType::class);
    }

    /**
     * @param OptionsResolver $resolver
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        /*$resolver->setRequired(
            ['senderName', 'recipient', 'subject', 'message']
        );*/

        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
