<?php

namespace WXR\EventBundle\Admin\Model;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


abstract class EventAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_by' => 'startAt',
        '_sort_order' => 'DESC'
    );

    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('form.group_general')
                ->add('startAt')
                ->add('endAt')
                ->add('title')
                ->add('content', null, array(
                    'attr' => array('class' => 'wysiwyg', 'rows' => 8)
                ))
                ->add('excerpt', null, array(
                    'required' => false
                ))
            ->end()
            ->with('form.group_categories')
                ->add('categories', 'sonata_type_model', array(
                    'class' => 'WXR\\EventBundle\\Entity\\Category',
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false
                ))
                ->add('tags', 'sonata_type_model', array(
                    'class' => 'WXR\\EventBundle\\Entity\\Tag',
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false
                ))
            ->end()
            ->with('form.group_options')
                ->add('enabled', null, array(
                    'required' => false
                ))
            ->end()
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('content')
            ->add('categories')
            ->add('tags')
            ->add('startAt')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('enabled')
            ->add('categories')
            ->add('tags')
            ->add('startAt')
            ->add('started', 'boolean')
            ->add('endAt')
            ->add('ended', 'boolean')
            ->add('inProgress', 'boolean')
        ;
    }
}
