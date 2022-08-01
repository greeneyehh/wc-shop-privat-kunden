<?php


//$params = require __DIR__ . '/live_params.php';
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
//$db = require __DIR__ . '/db_live.php';

$config = [
    'id' => 'basic',
    'name' => 'Managed Nextcloud',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','queue'],
    'language' => 'de',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'greeneye\adminlte\AdminlteAsset' => [
                    'skin' => 'skin-black',
                ],
            ],
        ],
        'response' => [
            'formatters' => [
                'pdf' => [
                    'class' => 'robregonm\pdf\PdfResponseFormatter',
                ],
            ]
        ],
    	'JiraComponent' => [
            'class' => 'app\components\JiraComponent',
        ],
        'RocketChatComponent' => [
            'class' => 'app\components\RocketChatComponent',
        ],
        'GravatarComponent' => [
            'class' => 'app\components\GravatarComponent',
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6Lfv7qcZAAAAAESPJ4O8iqiSlLXgTNpO0SaFvyH1',
            'secret' => '6Lfv7qcZAAAAAEbusOGo_CWw1HBGNTCKNcvmFxfC ',
        ],
        'request' => [
            'cookieValidationKey' => 'H3Tgj0J0o3eVp25x0RQtGReEXeSTFgOV',
            'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'session' =>  [
        	'class' => 'yii\web\DbSession',
			'cookieParams' => [
			    'httponly' => true,
                'lifetime' => 3600 * 4,
                'secure' => true
            ],
	        'timeout' => 86400, //session expire
	        'useCookies' => true,
		],
		'cache' => [
            'class' => 'yii\caching\FileCache',
        /* 	'class' => 'yii\caching\MemCache',
         	'servers' => [
					[
		                'host' => 'localhost',
		                'port' => 11211,
		                'weight' => 100,
		            ],
				]*/
		],
        'user' => [
            'identityClass' => 'app\models\Account',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

         'mailer' => [
         'class' => 'yii\swiftmailer\Mailer',
         'transport' => [
             'class' => 'Swift_SmtpTransport',
             'host' => 'email.windcloud.de',
             'username' => 'shop@windcloud.de',
             'password' => 'GT*lS.D4i10',
             'port' => '587', // Port 25 is a very common port too
             'encryption' => 'tls',
            'streamOptions' => [
                'ssl' => [
                    'allow_self_signed' => true,
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ],
            ]
         ],
     ],

        'queue' => [
            'class' => \yii\queue\db\Queue::class,
            'db' => 'db', // DB connection component or its config
            'tableName' => '{{%queue}}', // Table name
            'channel' => 'default', // Queue channel key
            'mutex' => \yii\mutex\MysqlMutex::class, // Mutex that used to sync queries
        ],
         'log' => [
                'traceLevel' => YII_DEBUG ? 3 : 0,
                'targets' => [
                    [
                        'class' => 'yii\log\DbTarget',
                        'levels' => ['error'],
                        'categories' => [
                            'yii\db\*',
                            'yii\web\HttpException:*',
                        ],
                        'except' => [
                            'application',
                        ],
                    ],
                    [
                      //  'class' => 'yii\log\FileTarget',
                        //'class' => 'yii\log\DbTarget',
                        'class' => 'yii\log\EmailTarget',
                        'mailer' => 'mailer',
                        'levels' => ['error'],
                        'message' => [
                            'from' => ['log@windcloud.de'],
                            'to' => ['grote@windcloud.de'],
                            'subject' => 'Shop Live Log Message',
                        ],
                    ],
                ],
            ],


        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'normalizer' => [

                'class' => 'yii\web\UrlNormalizer',

                'collapseSlashes' => true,

                'normalizeTrailingSlash' => true,

                'action' => null,

            ],
            'rules' => [
                'dashboard' => 'dashboard/index',
		'emission-is-our-mission' => 'landingpage/index',
		'cart' => 'cart/index',
                'cart/<action:\w+>' => 'cart/<action>',
                '<action>'=>'site/<action>',

                'order/<action:\w+>' => 'order/<action>',
                'mail-chimp/<action:\w+>' => 'mail-chimp/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<action:\w+>/<id:\d+>' => 'site/<action>',
                'produkte/<slug:[\w\-]+>' => 'site/produkte',
                'POST produkte/<slug:[\w\-]+>/wizard' => 'wizard/produkte',
                'GET produkte/<slug:[\w\-]+>/wizard' => 'wizard/produkte', 
                'POST dashboard-wizard' => 'dashboard-wizard',
 		'GET dashboard-wizard' => 'dashboard-wizard',

		'unternehmen/<slug:[\w\-]+>' => 'site/unternehmen',
                'news/<slug:[\w\-]+>' => 'site/news',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                'defaultRoute' => '/site/index',
                '/' => '/site/index',

            ],
        ],
        
    ],
    'modules' => [

    ],

    'params' => $params,
];




if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
       //'allowedIPs' => ['95.91.228.143'],
//        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['95.91.228.143'],
    ];
}

return $config;
