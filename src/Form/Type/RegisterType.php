<?php


namespace App\Form\Type;


use App\Entity\User;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaV3Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', SecurityEmailType::class)
            ->add('password', SecurityPasswordType::class)
            ->add('firstName', TextType::class, [
                'label' => 'First name'
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last name'
            ])
            ->add('recaptcha', EWZRecaptchaType::class, [
                'mapped' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => $options['btn-label'],

            ]);
    }

//    public function getBlockPrefix(): ?string
//    {
//        return '';
//    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'btn-label'  => "Go!",
                'data_class' => User::class,

            ])
            ->setAllowedTypes('btn-label', 'string')
        ;
    }
}