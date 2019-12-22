<?php

namespace Long\HideMe;

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
}
