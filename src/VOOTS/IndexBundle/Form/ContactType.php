<?php
// your-path-to-types/ContactType.php

namespace VOOTS\IndexBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('attr' => array('placeholder' => 'Nom'),
                'constraints' => array(
                    new NotBlank(array("message" => "Votre nom")),
                )
            ))
            ->add('surname', TextType::class, array('attr' => array('placeholder' => 'Prénom'),
                'constraints' => array(
                    new NotBlank(array("message" => "Prenom")),
                )
            ))
            ->add('subject', TextType::class, array('attr' => array('placeholder' => 'Sujet'),
                'constraints' => array(
                    new NotBlank(array("message" => "Please give a Subject")),
                )
            ))
            ->add('email', EmailType::class, array('attr' => array('placeholder' => 'E-mail'),
                'constraints' => array(
                    new NotBlank(array("message" => "Please provide a valid email")),
                    new Email(array("message" => "Your email doesn't seems to be valid")),
                )
            ))
            ->add('message', TextareaType::class, array('attr' => array('placeholder' => 'Messages'),
                'constraints' => array(
                    new NotBlank(array("message" => "Votre message")),
                )
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true
        ));
    }

    public function getName()
    {
        return 'contact_form';
    }
}