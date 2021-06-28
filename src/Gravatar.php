<?php

namespace IanM\Gravatar;

use Flarum\Settings\SettingsRepositoryInterface;

class Gravatar
{
    /**
	 * Gravatar base url
	 *
	 * @var string
	 */
	private string $publicBaseUrl = 'https://www.gravatar.com/avatar/';

	/**
	 * Email address to check
	 *
	 * @var string
	 */
	private string $email;

    private SettingsRepositoryInterface $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

	/**
	 * Get the gravatar url
	 *
	 * @param string $email
	 * @return string
	 */
	public function get($email): string
	{
		$this->email = $email;

		return $this->buildUrl();
	}

	/**
	 * Helper function to md5 hash the email address
	 *
	 * @return string
	 */
	private function hashEmail(): string
	{
		return md5(strtolower(trim($this->email)));
	}

	/**
	 * @return string
	 */
	private function getExtension(): string
	{
		return '.png';
	}

	/**
	 * @return string
	 */
	private function buildUrl(): string
	{
        $url = $this->publicBaseUrl;
		$url .= $this->hashEmail();
		$url .= $this->getExtension();
		$url .= $this->getUrlParameters();

		return $url;
	}

	/**
	 * @return string
	 */
	private function getUrlParameters(): string
	{
		$build = array();

		foreach (get_class_methods($this) as $method) {
			if (substr($method, -strlen('Parameter')) !== 'Parameter') {
				continue;
			}

			if ($called = call_user_func(array($this, $method))) {
				$build = array_replace($build, $called);
			}
		}

		return '?' . http_build_query($build);
	}

	/**
	 * @return array|null
	 */
	private function sizeParameter(): array
	{
		return array('s' => '100');
	}

	/**
	 * @return array
	 */
	private function defaultParameter(): array
	{
		return array('d' => $this->settings->get('ianm-gravatar.default'));
	}

	/**
	 * @return array|null
	 */
	private function ratingParameter(): array
	{
		return array('r' => $this->settings->get('ianm-gravatar.rating'));
	}

    /**
	 * @return array|null
	 */
	private function forceDefaultParameter()
	{
		if ((bool )$this->settings->get('ianm-gravatar.force-default', false)) {
			return array('forcedefault' => 'y');
		}

		return null;
	}
}
