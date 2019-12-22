<?php

namespace Long\HideMe\User;

use Carbon\Carbon;
use Flarum\User\User;

class Anonymous extends User
{
    protected $fillable = [
        'username'
    ];

    public static function user()
    {
        $now = Carbon::now('utc')->toDateTimeString();
        return new static([
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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setAttribute('id', 0);
        $this->setRelation('groups', []);
    }
}
