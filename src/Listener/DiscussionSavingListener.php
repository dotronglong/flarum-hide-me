<?php

namespace Long\HideMe\Listener;

use Flarum\Discussion\Event\Saving;
use Long\HideMe\HideMe;

class DiscussionSavingListener
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

        $event->discussion[HideMe::COL_HIDE_ME] = $mode;
    }
}
