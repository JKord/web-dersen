<?php
namespace Catalog\FilmsBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents,
    Symfony\Component\Form\FormEvent,
    Symfony\Component\Form\FormError;

class UploadFileSubscriber implements EventSubscriberInterface
{
    private $hm;

    public function __construct($hm)
    {
        $this->hm = $hm;
    }

    public static function getSubscribedEvents()
    {
        return array(FormEvents::SUBMIT => 'submit');
    }

    public function submit(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $form->getData();
        $file = $form['image']->getData();

        if('' == $file) return;
        $res = $this->hm->uploadFile($file);
        if(is_array($res)) {
            $data->setImage($res['url']);
        } else
            $form->addError(new FormError($res));
    }
}