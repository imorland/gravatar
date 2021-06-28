<?php

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        /**
         * @var SettingsRepositoryInterface
         */
        $settings = resolve('flarum.settings');

        $settings->set('ianm-gravatar.default', 'mp');
        $settings->set('ianm-gravatar.rating', 'g');
    },
    'down' => function (Builder $schema) {
        //
    },
];
