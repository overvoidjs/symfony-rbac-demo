<?php

namespace App\Doctrine\EventListener;

use App\Entity\TimestampableInterface;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\LifecycleEventArgs;

class TimestampableSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [Events::prePersist, Events::preUpdate];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof TimestampableInterface) {
            return;
        }

        if (null === $entity->getCreatedAt()) {
            $entity->setCreatedAt(new \DateTimeImmutable());
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof TimestampableInterface) {
            return;
        }

        if (null === $entity->getUpdatedAt()) {
            $entity->setUpdatedAt(new \DateTime());
        }
    }
}
