<?php

namespace Long\HideMe\Listener;

use Flarum\Post\Event\Saving;
use Flarum\Post\Post;
use Flarum\Settings\SettingsRepositoryInterface;
use Long\HideMe\HideMe;

class PostSaving
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

        $event->post[HideMe::COL_HIDE_ME] = $mode;
        $event->post[HideMe::COL_HIDE_ME_OWNER] = $event->post->user_id;
    }
}
