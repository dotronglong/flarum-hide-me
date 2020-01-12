<?php

namespace Long\HideMe\User;

use Carbon\Carbon;
use Flarum\User\User;
use Symfony\Component\Translation\TranslatorInterface;

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

    public static function user(TranslatorInterface $translator)
    {
        $now = Carbon::now('utc')->toDateTimeString();
        $user = new static();
        $user->id = -1;
        $user->username = $translator->trans("dotronglong-hide-me.anonymous.username");
        $user->display_name = $translator->trans("dotronglong-hide-me.anonymous.display_name");
        $user->joined_at = $now;
        $user->last_seen_at = $now;
        $user->discussion_count = 0;
        $user->comment_count = 0;
        $user->is_email_confirmed = true;
        $user->email = 'mail@hidden.com';
        return $user;
    }
}
