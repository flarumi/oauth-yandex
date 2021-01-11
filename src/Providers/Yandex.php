<?php

namespace Flarumi\OauthYandex\Providers;

use FoF\OAuth\Provider;
use Flarum\Forum\Auth\Registration;
use Flarum\Settings\SettingsRepositoryInterface;
use League\OAuth2\Client\Provider\AbstractProvider;
use Aego\OAuth2\Client\Provider\Yandex as YandexProvider;

class Yandex extends Provider
{
	
    public function name(): string
    {
        return 'yandex';
    }
	
    public function link(): string
    {
        return 'https://oauth.yandex.ru/';
    }

    public function fields(): array
    {
        return [
            'client_id'     => 'required',
            'client_secret' => 'required',
        ];
    }
	
   public function provider(string $redirectUri): AbstractProvider
    {
        return $this->provider = new YandexProvider([
            'clientId'        => $this->getSetting('client_id'),
            'clientSecret'    => $this->getSetting('client_secret'),
            'redirectUri'     => $redirectUri,
        ]);
    }

    public function suggestions(Registration $registration, $user, string $token)
    {
        $registration
            ->provideTrustedEmail($user->getEmail())
			->provideAvatar("https://avatars.mds.yandex.net/get-yapic/" . array_get($user->toArray(), 'default_avatar_id') . "/islands-retina-50")
            ->suggestUsername($user->getName())
            ->setPayload($user->toArray());
    }
}
