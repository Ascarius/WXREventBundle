<?php

namespace WXR\EventBundle\Admin\Model;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EventAdmin extends Admin
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
                ->add('duration', 'time')
                ->add('title')
                ->add('description', null, array(
                    'attr' => array('data-wysiwyg' => true, 'rows' => 20)
                ))
                ->add('excerpt', null, array(
                    'required' => false
                ))
            ->end()
            ->with('form.group_categories')
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
            ->add('description')
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
            ->add('startAt')
            ->add('duration', 'time')
            ->add('endAt')
            ->add('started', 'boolean')
            ->add('ended', 'boolean')
            ->add('inProgress', 'boolean')
            ->add('categories')
            ->add('tags')
        ;
    }
}