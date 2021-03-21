<?php

declare(strict_types=1);

namespace common\components\Entity;

trait EventTrait
{
    private array $events = [];

    private function recordEvent(EntityEventInterface $event)
    {
        $this->events[] = $event;
    }

    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}