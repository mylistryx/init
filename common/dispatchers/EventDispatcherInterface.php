<?php

namespace common\dispatchers;

interface EventDispatcherInterface
{
    public function dispatch(array $events);
}