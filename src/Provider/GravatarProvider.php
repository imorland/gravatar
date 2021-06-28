<?php

namespace IanM\Gravatar\Provider;

use Flarum\Foundation\AbstractServiceProvider;
use IanM\Gravatar\Gravatar;

class GravatarProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->container->singleton('gravatar', Gravatar::class);
    }
}
