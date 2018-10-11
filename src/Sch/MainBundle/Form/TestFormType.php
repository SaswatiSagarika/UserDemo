<?php


namespace Sch\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ApiTestFormType extends AbstractType
{
    /**
     * API form builder.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('verb', 'choice', array(
            'choices' => array('GET' => 'GET'),
            'required' => false,
        ));
        $builder->add('content', 'textarea', array('required' => false));
        $builder->add('url', 'text', array('required' => false));
        $builder->add('submit', 'submit');
    }

    /**
     * Returns the name of this type.
     *
     * @return string
     */
    public function getName()
    {
        return 'con_api_test_form';
    }
}
