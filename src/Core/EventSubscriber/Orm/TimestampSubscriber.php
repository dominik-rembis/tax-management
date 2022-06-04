<?php

declare(strict_types=1);

namespace App\Core\EventSubscriber\Orm;

use App\Core\Service\Property;
use App\Core\Util\Trait\Timestamp;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TimestampSubscriber implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($this->supports($entity)) {
            Property::set($entity, 'createdAt', new \DateTimeImmutable());
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($this->supports($entity)) {
            Property::set($entity, 'updatedAt', new \DateTimeImmutable());
        }
    }

    private function supports(object $object): bool
    {
        return in_array(Timestamp::class, class_uses($object));
    }
}