<?php

namespace Catalog\FilmsBundle\Form;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormEvents,
    Symfony\Component\Form\FormEvent,
    Symfony\Component\Form\FormError;

use Catalog\FilmsBundle\Form\EventListener\UploadFileSubscriber;

class FilmsType extends AbstractType
{
    private $hm;

    public function __construct($hm)
    {
        $this->hm = $hm;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $nse = 'Catalog\\FilmsBundle\\Entity\\';

        $builder
            ->add('name')
            ->add('description')
            ->add('actor', 'entity', array('class' => $nse.'Actors', 'property' => 'name', 'multiple' => true, 'expanded' => true ))
            ->add('category', 'entity', array('class' => $nse.'Categories', 'property' => 'name', 'multiple' => true, 'expanded' => true ))
            ->add('genre', 'entity', array('class' => $nse.'Genres', 'property' => 'name', 'multiple' => true, 'expanded' => true ))
            ->add('imageUpload','file', array('data_class' => null, 'mapped' => false, 'required' => false ))
        ;

        $builder->addEventSubscriber(new UploadFileSubscriber($this->hm));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Catalog\FilmsBundle\Entity\Films'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'catalog_filmsbundle_films';
    }
}
