<?php

namespace Sch\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RevenueType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fkProducts')->add('fkRetailerCountry')->add('fkRetailerType')->add('fkOrderMode')->add('year')->add('quarter')->add('revenue')->add('quantity')->add('grossMargin');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sch\MainBundle\Entity\Revenue'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sch_mainbundle_revenue';
    }


}
