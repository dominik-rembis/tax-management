<?php

declare(strict_types=1);

namespace App\Invoice\Data\EventSubscriber\Orm;

use App\Core\Service\Property;
use App\Invoice\Data\Model\InvoiceData;
use App\Invoice\Data\Service\NumberGenerator;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class InvoiceNumberSubscriber implements EventSubscriber
{
    public function __construct(
        private readonly NumberGenerator $numberGenerator
    ) {}

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($this->supports($entity)) {
            Property::set($entity, 'number', $this->numberGenerator->generate());
        }
    }

    private function supports(object $object): bool
    {
        return $object instanceof InvoiceData && !$object->getNumber();
    }
}