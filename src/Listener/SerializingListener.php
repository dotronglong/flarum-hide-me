<?php


namespace Long\HideMe\Listener;

use Flarum\Api\Event\Serializing;
use Long\HideMe\HideMe;

class SerializingListener
{
    public function handle(Serializing $event)
    {
        HideMe::hide($event->model);
    }
}
