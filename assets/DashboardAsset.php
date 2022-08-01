<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'
    ];
    public $depends = [
        'greeneye\adminlte\AdminlteAsset',
    ];
    public $css = [
    'css/dashboard-windcloud.css',
    '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css',
];
}
