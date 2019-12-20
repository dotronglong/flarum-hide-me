<?php

namespace Long\HideMe;

class HideMe
{
    const PUBLIC = 1;
    const ANONYMOUS = 2;
    const GHOST = 3;
    const COL_HIDE_ME = 'hide_me';
    const COL_HIDE_ME_OWNER = 'hide_me_owner';

    public static function validate($mode)
    {
        return in_array($mode, [
            self::PUBLIC,
            self::ANONYMOUS,
            self::GHOST
        ]);
    }
}
