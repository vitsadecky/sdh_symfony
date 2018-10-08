<?php

namespace App\Form;

use App\Entity\User;
use App\Manager\LocaleManager;
use App\Manager\RoleManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{ChoiceType,
    DateTimeType,
    EmailType,
    HiddenType,
    PasswordType,
    TextType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class RegistrationType
 * @package App\Form
 */
class RegistrationType extends AbstractType
{
    /** @var LocaleManager */
    private $localeManager;

    /** @var TranslatorInterface */
    private $translator;

    /**
     * RegistrationType constructor.
     * @param LocaleManager $localeManager
     * @param TranslatorInterface $translator
     */
    public function __construct(LocaleManager $localeManager, TranslatorInterface $translator)
    {
        $this->localeManager = $localeManager;
        $this->translator = $translator;
    }

    /**
     * @return array
     */
    private function getGenders(): array
    {
        return [
            $this->translator->trans('Man') => 'M',
            $this->translator->trans('Woman') => 'Ž'
        ];
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //pktodo vyresit preklady
        $builder
            ->add('firstName', TextType::class, ['required' => false, 'label'=>'First name'])
            ->add('surname', TextType::class, ['label'=>'Surname'])
            ->add('email', EmailType::class, ['label'=>'E-mail'])
            ->add('language', ChoiceType::class, ['label'=>'Language','choices' => $this->localeManager->getLocales()])
            ->add('login', TextType::class, ['label'=>'Login'])
            ->add('password', PasswordType::class, ['label'=>'Password'])
            ->add('birthDate', DateTimeType::class, ['label'=>'Birth'])
            ->add('gender', ChoiceType::class, [ 'label'=>'Gender', 'choices' => $this->getGenders()])//pktodo udelat radio
            ->add('role', HiddenType::class)->setData(RoleManager::TYPE_VISITOR);  //default role
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
