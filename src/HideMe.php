<?php

namespace Long\HideMe;

use Flarum\Discussion\Discussion;
use Flarum\Post\Post;
use Long\HideMe\User\Anonymous;

class HideMe
{
    const PUBLIC = 1;
    const ANONYMOUS = 2;
    const COL_HIDE_ME = 'hide_me';

    public static function validate($mode)
    {
        return in_array($mode, [
            self::PUBLIC,
            self::ANONYMOUS,
        ]);
    }

    public static function hide($model)
    {
        if (($model instanceof Discussion || $model instanceof Post)
            && $model['hide_me'] === self::ANONYMOUS) {
            $model->setRelation('user', new Anonymous());
        }
    }
}
