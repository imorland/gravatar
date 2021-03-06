# Gravatar

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/ianm/gravatar.svg)](https://packagist.org/packages/ianm/gravatar) 

![Extiverse](https://extiverse.com/extension/ianm/gravatar/open-graph-image)

A [Flarum](http://flarum.org) extension. Add [gravatar](https://gravatar.com/) avatars to your forum.

### Features

- Save on disk space by using Gravatar avatars stored remotely
- Option to keep or replace existing avatars already uploaded to your forum
- Supports multiple Gravatar default sets
- Option to override a user-set Gravatar with one from the chosen default set
- Support for restricting Gravatars to their content rating
- Proxy fetching gravatar images via the forum

![forum](https://user-images.githubusercontent.com/16573496/123618543-370b0200-d800-11eb-8b8b-15da53071874.png)

![profile](https://user-images.githubusercontent.com/16573496/123618712-5c980b80-d800-11eb-9c03-0355472caa53.png)

![settings](https://user-images.githubusercontent.com/16573496/123634120-f1573500-d811-11eb-83c1-1e1fd9004183.png)


##### TO-DO

- Allow users to switch between gravatar and forum uploaded avatar, with admin option to enable/disable
- Add support for Gravatar profile fields

### Installation

Install with composer:

```sh
composer require ianm/gravatar:"*"
```

### Updating

```sh
composer update ianm/gravatar:"*"
php flarum migrate
php flarum cache:clear
```

### Links

- [Packagist](https://packagist.org/packages/ianm/gravatar)
- [GitHub](https://github.com/imorland/gravatar)
- [Discuss](https://discuss.flarum.org/d/27930)
