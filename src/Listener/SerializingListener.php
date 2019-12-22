<?php


namespace Long\HideMe\Listener;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\BasicPostSerializer;
use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Api\Serializer\PostSerializer;
use Long\HideMe\HideMe;

class SerializingListener
{
    public function handle(Serializing $event)
    {
        if ($event->serializer instanceof DiscussionSerializer
            || $event->serializer instanceof BasicPostSerializer
            || $event->serializer instanceof PostSerializer) {
            if ($event->actor->can('dotronglong-hide-me.see_author')) {
                return; // no hidden
            }
            HideMe::hide($event->model);
        }
    }
}
