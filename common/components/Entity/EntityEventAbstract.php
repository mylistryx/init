<?php

declare(strict_types=1);

namespace common\components\Entity;

use DateTimeImmutable;

/**
 * Class EntityEventAbstract
 * @property AggregateRootInterface $entity
 * @property DateTimeImmutable $dateTime
 */
abstract class EntityEventAbstract implements EntityEventInterface
{
    public AggregateRootInterface $entity;
    public DateTimeImmutable $dateTime;

    public function __construct(AggregateRootInterface $entity)
    {
        $this->entity = $entity;
        $this->dateTime = new DateTimeImmutable();
    }
}
