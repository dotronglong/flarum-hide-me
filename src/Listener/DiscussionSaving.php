<?php

namespace Long\HideMe\Listener;

use Flarum\Discussion\Discussion;
use Flarum\Discussion\Event\Saving;
use Flarum\Settings\SettingsRepositoryInterface;
use Long\HideMe\HideMe;

class DiscussionSaving
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

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
        $event->discussion[HideMe::COL_HIDE_ME_OWNER] = $event->discussion->user_id;
//        $event->discussion->afterSave(function (Discussion $discussion) use ($mode) {
//        });
    }
}
