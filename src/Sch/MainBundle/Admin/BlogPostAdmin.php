<?php

namespace Sch\MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class BlogPostAdmin extends AbstractAdmin
{
    protected $translationDomain = 'SonataPageBundle';
    protected $listModes = array(
            'list' => array(
                'class' => 'fa fa-list fa-fw',
            )
        );

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('category', null, [], 'entity', [
                'class'    => 'Sch\MainBundle\Entity\Category',
                'choice_label' => 'name', // In Symfony2: 'property' => 'name'
            ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('category.name')
            ->add('draft')
            ->add('_action', 'actions', ['actions' => ['edit' => []]])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {   
        unset($this->listModes['mosaic']);
        $formMapper
            ->add('title', 'text')
            ->add('body', 'textarea')
            ->add('category', 'entity', [
            'class' => 'Sch\MainBundle\Entity\Category',
            'property' => 'name',
        ])
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('body')
            ->add('draft')
        ;
    }
}
