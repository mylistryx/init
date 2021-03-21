<?php

declare(strict_types=1);

namespace common\components\Entity;

use common\components\Entity\AggregateRootInterface;

interface EntityEventInterface
{
    public function __construct(AggregateRootInterface $entity);
}