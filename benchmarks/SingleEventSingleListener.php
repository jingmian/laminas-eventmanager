<?php

namespace LaminasBench\EventManager;

use Athletic\AthleticEvent;
use Laminas\EventManager\EventManager;

class SingleEventSingleListener extends AthleticEvent
{
    use TraitEventBench;

    private $events;

    public function setUp()
    {
        $this->events = new EventManager();
        $this->events->attach('dispatch', $this->generateCallback());
    }

    /**
     * Trigger the dispatch event
     *
     * @iterations 5000
     */
    public function trigger()
    {
        $this->events->trigger('dispatch');
    }
}
