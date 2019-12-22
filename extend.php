<?php

namespace Long\HideMe;

use Flarum\Api\Event\Serializing;
use Flarum\Discussion\Event\Saving as DiscussionSaving;
use Flarum\Extend;
use Flarum\Post\Event\Saving as PostSaving;
use Illuminate\Contracts\Events\Dispatcher;
use Long\HideMe\Listener\AddForumUserRelationship;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__ . '/less/forum.less'),
    new Extend\Locales(__DIR__ . '/locale'),
    new \Long\HideMe\Extend\Settings(),
    function (Dispatcher $events) {
        $events->listen(PostSaving::class, Listener\PostSavingListener::class);
        $events->listen(DiscussionSaving::class, Listener\DiscussionSavingListener::class);
        $events->listen(Serializing::class, Listener\SerializingListener::class);
        $events->subscribe(AddForumUserRelationship::class);
    }
];
