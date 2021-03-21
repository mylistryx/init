<?php

declare(strict_types=1);

namespace common\components\Entity;

interface AggregateRootInterface
{
    public function releaseEvents(): array;
}