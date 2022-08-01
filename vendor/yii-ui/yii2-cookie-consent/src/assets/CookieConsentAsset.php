<?php
/**
 * @author Christoph Möke <christophmoeke@gmail.com>
 * @copyright Copyright (c) 2019 Yii UI
 * @license https://www.yii-ui.com/packages/yii2-cookie-consent/license MIT
 * @link https://www.yii-ui.com/packages/yii2-cookie-consent
 * @see https://www.yii-ui.com/packages/yii2-cookie-consent/docs Documentation of yii2-cookie-consent
 * @since File available since Release 1.0.0
 */

namespace yiiui\yii2cookieconsent\assets;

use yii\web\AssetBundle;

/**
 * Class CookieConsentAsset
 * @package yiiui\yii2cookieconsent\assets
 */
class CookieConsentAsset extends AssetBundle
{
    public $sourcePath = '@npm/cookieconsent/build';

    public $js = [
        'cookieconsent.min.js'
    ];

    public $css = [
        'cookieconsent.min.css'
    ];
}
