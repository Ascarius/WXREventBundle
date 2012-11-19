<?php

namespace WXR\EventBundle\Admin\Entity;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use WXR\EventBundle\Admin\Model\EventAdmin as BaseEventAdmin;

class EventAdmin extends BaseEventAdmin
{
    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
            ->with('form.group_categories')
                ->add('categories', 'sonata_type_model', array(
                    'class' => 'Application\\WXR\\EventBundle\\Entity\\Category',
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false
                ))
                ->add('tags', 'sonata_type_model', array(
                    'class' => 'Application\\WXR\\EventBundle\\Entity\\Tag',
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false
                ))
            ->end()
        ;
    }
}
