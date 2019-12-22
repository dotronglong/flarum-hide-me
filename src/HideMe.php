<?php

namespace Long\HideMe;

use Flarum\Discussion\Discussion;
use Flarum\Post\CommentPost;
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
        $anonymous = Anonymous::user();
        if ($model instanceof Discussion) {
            $lastPost = $model->lastPost()->first();
            if ($lastPost[self::COL_HIDE_ME] === self::ANONYMOUS) {
                $model->setRelation('lastPostedUser', $anonymous);
            }
        } else if (($model instanceof Post || $model instanceof CommentPost)
            && $model[self::COL_HIDE_ME] === self::ANONYMOUS) {
            $model->setRelation('user', $anonymous);
        }
    }
}
