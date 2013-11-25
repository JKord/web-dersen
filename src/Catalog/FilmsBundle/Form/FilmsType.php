<?php

namespace Catalog\FilmsBundle\Form;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormEvents,
    Symfony\Component\Form\FormEvent,
    Symfony\Component\Form\FormError;

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
        $builder
            ->add('name')
            ->add('description')
            ->add('actor')
            ->add('category')
            ->add('genre')
            ->add('image','file', array('required' => false, 'data_class' => null))
        ;

        $url = null;

        $builder->addEventListener(FormEvents::SUBMIT, function(FormEvent $event) use ($url) {
            $form = $event->getForm();

            $res = $this->hm->uploadFile($form['image']->getData());
            if(is_array($res)) {
                $url = $res['url'];
            } else
                $form->addError(new FormError($res));
        });

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($url) {
            $form = $event->getForm();
            $form['image']->setData($url);
        });
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
