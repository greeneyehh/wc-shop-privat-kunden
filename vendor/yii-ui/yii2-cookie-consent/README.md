[![Yii UI](https://www.yii-ui.com/logos/logo-yii-ui-readme.jpg)](https://www.yii-ui.com/) Yii UI - Cookie Consent
================================================

[![Latest Stable Version](https://poser.pugx.org/yii-ui/yii2-cookie-consent/version)](https://packagist.org/packages/yii-ui/yii2-cookie-consent)
[![Total Downloads](https://poser.pugx.org/yii-ui/yii2-cookie-consent/downloads)](https://packagist.org/packages/yii-ui/yii2-cookie-consent)
[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](http://www.yiiframework.com/)
[![License](https://poser.pugx.org/yii-ui/yii2-cookie-consent/license)](https://packagist.org/packages/yii-ui/yii2-cookie-consent)


This is an [Yii framework 2.0](http://www.yiiframework.com) widget of the [Osano](https://github.com/osano/cookieconsent) Cookie Consent widget.

Installation
------------

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run
```
php composer.phar require yii-ui/yii2-cookie-consent
```
or add
```
"yii-ui/yii2-cookie-consent": "^1.0.0"
```
to the require section of your `composer.json` file.

Usage
-----

```php 
use yiiui\yii2cookieconsent\widgets\CookieConsent;

CookieConsent::widget([
    'palettePopupBackground' => '#000000',
    'paletteButtonBackground' => '#FBAD38',
    'theme' => 'classic',
    'position' => 'bottom-right',
    'contentDismiss' => 'Om nom nom nom',
    'contentLink' => 'Learn more',
    'contentMessage' => 'Do you like Cookies?',
    'contentHref' => 'https://en.wikipedia.org/wiki/Cookie_Monster',
]);
```

More [Examples](https://www.yii-ui.com/packages/yii2-cookie-consent) will be added soon at https://www.yii-ui.com/packages/yii2-cookie-consent.
For plugin configuration see [Osano](https://github.com/osano) Cookie Consent [Documentation](https://cookieconsent.osano.com/documentation).

Documentation
------------

[Documentation](https://www.yii-ui.com/packages/yii2-cookie-consent/docs) will be added soon at https://www.yii-ui.com/packages/yii2-cookie-consent/docs.

License
-------

**yii2-cookie-consent** is released under the MIT License. See the [LICENSE.md](LICENSE.md) for details.
