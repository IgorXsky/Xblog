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
                   ->add('blog')
                   ->add('image')
                   ->add('tags')
            ->add('category', 'entity', array(
                'class' => 'BlogBundle\Entity\Category',
                'property' => 'name'
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title')
                        ->add('blog')
                        ->add('image')
                        ->add('tags')
            ->add('category', 'entity', array(
                'class' => 'BlogBundle\Entity\Category',
                'property' => 'name'
            ));

    }

    protected function configureListFields(ListMapper $formMapper)
    {
        $formMapper->add('title')
                    ->add('blog')
                    ->add('image')
                    ->add('tags')
                    ->add('category', 'entity', array(
                        'class' => 'BlogBundle\Entity\Category',
                        'property' => 'name'
                    ));
    }
}