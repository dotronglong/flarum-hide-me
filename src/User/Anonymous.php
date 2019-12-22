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
            'id' => 0,
            'username' => 'anonymous',
            'displayName' => 'Anonymous',
            'joinTime' => $now,
            'lastSeenAt' => $now,
            'discussionCount' => 0,
            'commentCount' => 0,
            'isEmailConfirmed' => true,
            'email' => 'mail@anonymous.com'
        ]);
    }
}
