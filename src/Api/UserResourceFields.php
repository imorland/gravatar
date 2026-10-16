<?php

/*
 * This file is part of ianm/gravatar.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\Gravatar\Api;

use Flarum\Api\Schema;
use Flarum\User\User;
use IanM\Gravatar\Gravatar;

class UserResourceFields
{
    public function __construct(protected Gravatar $gravatar)
    {
    }

    public function __invoke(): array
    {
        return [
            Schema\Boolean::make('gravatar')
                ->get(fn (User $user) => $this->gravatar->usesGravatar($user)),
        ];
    }

    public static function avatarUrl(Schema\Str $field): Schema\Str
    {
        return $field->get(function (User $user) {
            $gravatar = resolve(Gravatar::class);

            return $gravatar->usesGravatar($user) ? $gravatar->getForUser($user) : $user->avatar_url;
        });
    }

    /**
     * The browser prefers srcset over the URL, so it must be replaced along
     * with avatarUrl or an uploaded avatar would still be shown.
     */
    public static function avatarSrcset(Schema\Str $field): Schema\Str
    {
        return $field->get(function (User $user) {
            $gravatar = resolve(Gravatar::class);

            return $gravatar->usesGravatar($user) ? $gravatar->getSrcsetForUser($user) : $user->avatar_srcset;
        });
    }
}
