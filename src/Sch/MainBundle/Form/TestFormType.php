<?php
/**
 * Form for API Testing functions.
 *
 * @author Saswati
 *
 * @category FormType
 */
namespace Sch\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TestFormType extends AbstractType
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
            'choices' => array('GET' => 'GET', 'POST' => 'POST'),
            'required' => true,
        ))
        ->add('content', 'textarea', array('required' => true))
        ->add('url', 'text', array('required' => true))
        ->add('submit', 'submit');
    }

    /**
     * Returns the name of this type.
     *
     * @return string
     */
    public function getName()
    {
        return 'testForm';
    }
}
