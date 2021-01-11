<?php

namespace Flarumi\OauthYandex;

use Illuminate\Support\ServiceProvider;

class OauthYandexServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->tag([
            Providers\Yandex::class,
        ], 'fof-oauth.providers');
    }
}
