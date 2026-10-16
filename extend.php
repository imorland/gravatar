<?php

/*
 * This file is part of ianm/gravatar.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\Gravatar;

use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Extend;
use IanM\Gravatar\Provider\GravatarProvider;
use Flarum\Api\Context;
use Flarum\Api\Endpoint;
use Flarum\Api\Resource;
use Flarum\Api\Schema;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),

    (new Extend\Routes('api'))
        ->remove('users.avatar.upload')
        ->get(
            '/users/{id}/gravatar.jpg',
            'ianm.gravatar.image',
            Api\Controllers\GetGravatarImageController::class
        ),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\ServiceProvider())
        ->register(GravatarProvider::class),

    // @TODO: Replace with the new implementation https://docs.flarum.org/2.x/extend/api#extending-api-resources
    (new Extend\ApiSerializer(BasicUserSerializer::class))
        ->attributes(Api\AddGravatar::class),

    (new Extend\Settings())
        ->default('ianm-gravatar.default', 'mp')
        ->default('ianm-gravatar.rating', 'g')
        ->default('ianm-gravatar.proxy', false)
        ->default('ianm-gravatar.force-default', false)
        ->default('ianm-gravatar.replace-flarum-custom', false),
];
