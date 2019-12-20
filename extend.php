<?php

namespace Long\HideMe;

use Flarum\Extend;
use Flarum\Post\Event\Saving as PostSaving;
use Flarum\Discussion\Event\Saving as DiscussionSaving;
use Illuminate\Contracts\Events\Dispatcher;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),
    (new Extend\Frontend('forum'))
        ->js(__DIR__ . '/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),
    new Extend\Locales(__DIR__ . '/locale'),
    new \Long\HideMe\Extend\Settings(),
    function (Dispatcher $events) {
        $events->listen(PostSaving::class, Listener\PostSaving::class);
        $events->listen(DiscussionSaving::class, Listener\DiscussionSaving::class);
    }
];
