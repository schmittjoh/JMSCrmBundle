<?php

namespace JMS\CrmBundle\Form;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\AbstractType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email', 'email')
            ->add('message')
        ;
    }

    public function getName()
    {
        return 'jms_crm_message';
    }
}