<?php

namespace AppBundle\Form;

use AppBundle\Entity\UselessEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UselessType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('meh', TextType::class, ['required' => false])
            ->add('whatever', TextType::class, ['required' => false])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UselessEntity::class,
            'csrf_protection'   => false,
        ));
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
