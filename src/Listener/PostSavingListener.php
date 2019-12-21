<?php

namespace Long\HideMe\Listener;

use Flarum\Post\Event\Saving;
use Long\HideMe\HideMe;

class PostSavingListener
{
    public function handle(Saving $event)
    {
        if (!isset($event->data['attributes']['hide_me'])) {
            return;
        }

        $mode = intval($event->data['attributes']['hide_me']);
        if (!HideMe::validate($mode)) {
            return;
        }

        $event->post[HideMe::COL_HIDE_ME] = $mode;
    }
}
