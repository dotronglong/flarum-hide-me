<?php

use Flarum\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('discussions', function (Blueprint $table) {
            $table->tinyInteger('hide_me')->unsigned()->nullable()->default(1);
            $table->integer('hide_me_owner')->unsigned()->nullable()->default(0);
        });
        $schema->table('posts', function (Blueprint $table) {
            $table->tinyInteger('hide_me')->unsigned()->nullable()->default(1);
            $table->integer('hide_me_owner')->unsigned()->nullable()->default(0);
        });
    },
    'down' => function (Builder $schema) {
        $schema->table('discussions', function (Blueprint $table) {
            $table->dropColumn([
                'hide_me',
                'hide_me_owner'
            ]);
        });
        $schema->table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'hide_me',
                'hide_me_owner'
            ]);
        });
    }
];
