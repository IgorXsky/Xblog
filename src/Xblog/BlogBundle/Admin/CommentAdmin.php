<?php
namespace Xblog\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class CommentAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('user')
                   ->add('comment')
                   ->add('blog.title');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('user')
                       ->add('comment')
                       ->add('blog.title');
}

    protected function configureListFields(ListMapper $formMapper)
    {
        $formMapper->addIdentifier('user')
                   ->addIdentifier('comment')
                   ->add('blog', 'entity', array(
                        'class' => 'BlogBundle\Entity\Blog',
                        'property' => 'title'))
        ;
    }
}