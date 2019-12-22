<?php

namespace Long\HideMe\User;

use Carbon\Carbon;
use Flarum\User\User;

class Anonymous extends User
{
    protected $fillable = [
        'id',
        'username'
    ];

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
        return new static([
            'id' => -1,
            'username' => '[hidden]',
            'display_name' => '[hidden]',
            'join_time' => $now,
            'last_seen_at' => $now,
            'discussion_count' => 0,
            'comment_count' => 0,
            'is_email_confirmed' => true,
            'email' => 'mail@hidden.com'
        ]);
    }
}
