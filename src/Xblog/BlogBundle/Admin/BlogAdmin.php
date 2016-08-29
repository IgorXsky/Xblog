<?php
namespace Xblog\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class BlogAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title')
                   ->add('content')
                   ->add('image')
                   ->add('tags')
                    ->add('category', 'entity', array(
                        'class' => 'Xblog\BlogBundle\Entity\Category',
                        'property' => 'name'
                    ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title')
                        ->add('tags')
                        ->add('created', 'doctrine_orm_date_range', array('input_type' => 'timestamp'))
                        ->add('category.name');

    }

    protected function configureListFields(ListMapper $formMapper)
    {
        $formMapper->add('title')
                    ->add('content')
                    ->add('image')
                    ->add('tags')
                    ->add('category.name');
    }
}