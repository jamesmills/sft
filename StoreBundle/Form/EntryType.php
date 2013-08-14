<?php

namespace Sensio\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EntryType extends AbstractType
{
    public function getName()
    {
        return 'entry';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Sensio\StoreBundle\Model\Entry'
            )
        );
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add(
                'unitPrice',
                'text',
                array(
                    'label' => 'unit Price'
                )
            )
            ->add('quantity', 'integer');
    }

}