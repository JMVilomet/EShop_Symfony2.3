<?php

namespace EShop\BoutiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class articleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $defaultOpt = array(
            'label_attr'=>array('class'=>'control-label'),
            'attr'=>array('class'=>'form-control')
        );
        $builder
            ->add('designation',null,$defaultOpt)
            ->add('puht',null,$defaultOpt)
            ->add('stock',null,$defaultOpt)
            ->add('description',null,$defaultOpt)
            ->add('photo',null,$defaultOpt)
            ->add('categorie','entity',$defaultOpt+array('class' => 'EShopBoutiqueBundle:categorie','property'=>'libelle'))
            ->add('enligne','checkbox',$defaultOpt+array('required'=>false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EShop\BoutiqueBundle\Entity\article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'eshop_boutiquebundle_article';
    }
}
