<?php

namespace Opstalent\CrudBundle;

use Doctrine\ORM\EntityManagerInterface;
use Opstalent\CrudBundle\Exception\FormNotValidException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Class FormEventListener
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 * @package Opstalent\CrudBundle
 */
class FormEventListener implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * FormEventListener constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SUBMIT => [
                ['saveData', -255],
            ],
        ];
    }

    /**
     * @param FormEvent $event
     * @throws FormNotValidException
     */
    public function saveData(FormEvent $event)
    {
        if (!$event->getForm()->isValid()) {
            throw new FormNotValidException($event->getForm());
        }

        $this->em->persist($event->getData());
        $this->em->flush();
    }
}
