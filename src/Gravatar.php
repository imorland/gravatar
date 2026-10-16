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

use Flarum\Http\UrlGenerator;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;

class Gravatar
{
    /**
     * Pixel size for each pixel density, matching the 100/200/300px variants
     * core generates for uploaded avatars.
     */
    public const SIZES = [1 => 100, 2 => 200, 3 => 300];

    /**
     * Gravatar base url.
     *
     * @var string
     */
    private string $publicBaseUrl = 'https://www.gravatar.com/avatar/';

    public function __construct(private SettingsRepositoryInterface $settings, private UrlGenerator $url)
    {
    }

    /**
     * Whether the user should be shown a gravatar instead of their own avatar.
     */
    public function usesGravatar(User $user): bool
    {
        return empty($user->avatar_url) || (bool) $this->settings->get('ianm-gravatar.replace-flarum-custom');
    }

    /**
     * Get the gravatar URL for the given user.
     */
    public function getForUser(User $user, int $size = self::SIZES[1]): string
    {
        if ((bool) $this->settings->get('ianm-gravatar.proxy')) {
            $url = $this->url->to('api')->route('ianm.gravatar.image', ['id' => $user->id]);

            return $size === self::SIZES[1] ? $url : $url.'?'.http_build_query(['s' => $size]);
        }

        return $this->buildUrl($user->email, $size);
    }

    /**
     * Get a HiDPI srcset of gravatar URLs for the given user.
     */
    public function getSrcsetForUser(User $user): string
    {
        $entries = [];

        foreach (self::SIZES as $density => $size) {
            $entries[] = $this->getForUser($user, $size)." {$density}x";
        }

        return implode(', ', $entries);
    }

    /**
     * Get the gravatar directly from gravatar.com.
     */
    public function getRemote(int $id, int $size = self::SIZES[1]): string
    {
        $user = User::findOrFail($id);

        return $this->buildUrl($user->email, $size);
    }

    /**
     * Helper function to md5 hash the email address.
     */
    private function hashEmail(string $email): string
    {
        return md5(strtolower(trim($email)));
    }

    /**
     * @return string
     */
    private function getExtension(): string
    {
        return '.png';
    }

    private function buildUrl(string $email, int $size): string
    {
        $url = $this->publicBaseUrl;
        $url .= $this->hashEmail($email);
        $url .= $this->getExtension();
        $url .= $this->getUrlParameters($size);

        return $url;
    }

    private function getUrlParameters(int $size): string
    {
        $build = array_replace(
            $this->sizeParameter($size),
            $this->defaultParameter(),
            $this->ratingParameter(),
            $this->forceDefaultParameter() ?? []
        );

        return '?'.http_build_query($build);
    }

    /**
     * @return array
     */
    private function sizeParameter(int $size): array
    {
        return ['s' => (string) $size];
    }

    /**
     * @return array
     */
    private function defaultParameter(): array
    {
        return ['d' => $this->settings->get('ianm-gravatar.default')];
    }

    /**
     * @return array
     */
    private function ratingParameter(): array
    {
        return ['r' => $this->settings->get('ianm-gravatar.rating')];
    }

    /**
     * @return array|null
     */
    private function forceDefaultParameter(): ?array
    {
        if ((bool) $this->settings->get('ianm-gravatar.force-default')) {
            return ['forcedefault' => 'y'];
        }

        return null;
    }
}
