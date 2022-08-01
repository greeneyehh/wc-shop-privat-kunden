<?php
/**
 * @author Christoph Möke <christophmoeke@gmail.com>
 * @copyright Copyright (c) 2019 Yii UI
 * @license https://www.yii-ui.com/packages/yii2-cookie-consent/license MIT
 * @link https://www.yii-ui.com/packages/yii2-cookie-consent
 * @see https://www.yii-ui.com/packages/yii2-cookie-consent/docs Documentation of yii2-cookie-consent
 * @since File available since Release 1.0.0
 */

namespace yiiui\yii2cookieconsent\widgets;

use yii\base\Widget;
use yii\helpers\Json;
use yiiui\yii2cookieconsent\assets\CookieConsentAsset;

/**
 * Class CookieConsent
 * @package yiiui\yii2cookieconsent\widgets
 */
class CookieConsent extends Widget
{
    /**
     * @var array
     */
    public $options = [];

    /**
     * @var string
     */
    public $palettePopupBackground;

    /**
     * @var string
     */
    public $palettePopupText;

    /**
     * @var string
     */
    public $paletteButtonBackground;

    /**
     * @var string
     */
    public $paletteButtonText;

    /**
     * @var string
     */
    public $theme;

    /**
     * @var string
     */
    public $position;

    /**
     * @var bool
     */
    public $static;

    /**
     * @var bool
     */
    public $showLink;

    /**
     * @var string
     */
    public $contentMessage;

    /**
     * @var string
     */
    public $contentDismiss;

    /**
     * @var string
     */
    public $contentDeny;

    /**
     * @var string
     */
    public $contentAllow;

    /**
     * @var string
     */
    public $contentLink;

    /**
     * @var string
     */
    public $contentHref;

    /**
     * @var string
     */
    public $type;

    public function init()
    {
        parent::init();

        if ($this->palettePopupBackground !== null) {
            $this->options['palette']['popup']['background'] = $this->palettePopupBackground;
        }

        if ($this->palettePopupText !== null) {
            $this->options['palette']['popup']['text'] = $this->palettePopupText;
        }

        if ($this->paletteButtonBackground !== null) {
            $this->options['palette']['button']['background'] = $this->paletteButtonBackground;
        }

        if ($this->paletteButtonText !== null) {
            $this->options['palette']['button']['text'] = $this->paletteButtonText;
        }

        if ($this->theme !== null) {
            $this->options['theme'] = $this->theme;
        }

        if ($this->position !== null) {
            $this->options['position'] = $this->position;
        }

        if ($this->static !== null) {
            $this->options['static'] = $this->static;
        }

        if ($this->showLink !== null) {
            $this->options['showLink'] = $this->showLink;
        }

        if ($this->contentMessage !== null) {
            $this->options['content']['message'] = $this->contentMessage;
        }

        if ($this->contentDismiss !== null) {
            $this->options['content']['dismiss'] = $this->contentDismiss;
        }

        if ($this->contentDeny !== null) {
            $this->options['content']['deny'] = $this->contentDeny;
        }

        if ($this->contentAllow !== null) {
            $this->options['content']['allow'] = $this->contentAllow;
        }

        if ($this->contentLink !== null) {
            $this->options['content']['link'] = $this->contentLink;
        }

        if ($this->contentHref !== null) {
            $this->options['content']['href'] = $this->contentHref;
        }

        if ($this->type !== null) {
            $this->options['type'] = $this->type;
        }
    }

    /**
     * @return bool
     */
    public function beforeRun(): bool
    {
        if (!parent::beforeRun()) {
            return false;
        }

        CookieConsentAsset::register($this->getView());

        return true;
    }

    /**
     * @return string|null
     */
    public function run(): ?string
    {
        $js = 'window.cookieconsent.initialise('.Json::htmlEncode($this->options).');';

        $this->getView()->registerJs($js);

        return null;
    }
}
