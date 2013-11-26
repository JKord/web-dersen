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
            ->add('imageUpLoad','file', array('data_class' => null, 'mapped' => false))
        ;

        $url = null;

        $builder->addEventListener(FormEvents::SUBMIT, function(FormEvent $event) use ($url) {
            $form = $event->getForm();
            $file = $form['imageUpLoad']->getData();

            $res = $this->hm->uploadFile($file);
            if(is_array($res)) {
                $form->add('image', 'text', array('data' => $res['url']));
            } else
                $form->addError(new FormError($res));
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
