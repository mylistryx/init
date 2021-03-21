<?php

declare(strict_types=1);

namespace common\dispatchers;

use Yii;

use function get_class;

final class DummyEventDispatcher implements EventDispatcherInterface
{
    public function dispatch(array $events)
    {
        foreach ($events as $event) {
            Yii::info('Dispatch event ' . get_class($event));
        }
    }
}