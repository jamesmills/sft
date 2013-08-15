<?php

namespace Sensio\StoreBundle\Form;

use Sensio\StoreBundle\Form\CustomerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class QuotationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer', new CustomerType())
            ->add(
                'document',
                'file',
                array(
                    'required' => false,
                    'label' => 'Add a PDF version'
                )
            )
            ->add('amount', 'text')
            ->add(
                'entries',
                'collection',
                array(
                    'type' => new EntryType(),
                    'allow_add' => true
                )
            )
            ->add('vat', 'text')
            ->add('total', 'text')
            ->add('createTheQuotation', 'submit');
    }

    public function getName()
    {
        return 'quotation';
    }
}
