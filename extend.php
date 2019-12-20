<?php

namespace Long\HideMe;

use Flarum\Extend;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),
    new Extend\Locales(__DIR__ . '/locale'),
    new \Long\HideMe\Extend\Settings(),
];
