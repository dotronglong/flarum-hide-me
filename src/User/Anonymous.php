<?php

namespace Long\HideMe\User;

use Carbon\Carbon;
use Flarum\User\User;

class Anonymous extends User
{
    public function isAdmin()
    {
        return false;
    }

    public function isGuest()
    {
        return false;
    }

    public static function user()
    {
        $now = Carbon::now('utc')->toDateTimeString();
        $user = new static();
        $user->id = -1;
        $user->username = '[hidden]';
        $user->display_name = '[hidden]';
        $user->joined_at = $now;
        $user->last_seen_at = $now;
        $user->discussion_count = 0;
        $user->comment_count = 0;
        $user->is_email_confirmed = true;
        $user->email = 'mail@hidden.com';
        return $user;
    }
}
