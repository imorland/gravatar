<?php

namespace IanM\Gravatar\Api;

use Flarum\Api\Serializer\BasicUserSerializer;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;
use IanM\Gravatar\Gravatar;

class AddGravatar
{
    public Gravatar $gravatar;

    public SettingsRepositoryInterface $settings;

    public function __construct(Gravatar $gravatar, SettingsRepositoryInterface $settings)
    {
        $this->gravatar = $gravatar;
        $this->settings = $settings;
    }
    
    public function __invoke(BasicUserSerializer $serializer, User $user, array $attributes)
    {
        if (empty($user->avatarUrl) || (bool) $this->settings->get('ianm-gravatar.replace-flarum-custom', false)) {
            $attributes['avatarUrl'] = $this->gravatar->get($user->email);
        }

        return $attributes;
    }
}
