	<?php
	use yii\helpers\Html;
	if (Yii::$app->user->isGuest) {
			return  $this->redirect('/dashboard/login');
    }?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/dashboard" class="brand-link">
        <span class="brand-text font-weight-light">Customer Control</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
        <?= greeneye\adminlte\widgets\Menu::widget(
            [
                'options' => ['class' => 'nav nav-pills nav-sidebar flex-column', 'data-widget'=> 'treeview' ,'role'=>"menu"],
                'items' => [
                    ['label' => 'Login', 'url' => ['dashboard'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Übersicht',
                        'icon' => 'home',
                        'url' => '/dashboard',
                        'visible' => Yii::$app->user->identity->right >= 0],
                    [
                        'label' => 'Produkte',
                        'icon' => 'database',
                        'url' => '/dashboard/produkte',
                        'visible' => Yii::$app->user->identity->right >= 0],
                    [
                        'label' => 'Rechnungen',
                        'icon' => 'money-bill',
                        'url' => '/dashboard/rechnungen',
                        'visible' => Yii::$app->user->identity->right >= 0],
                    [
                        'label' => 'Kontakt',
                        'icon' => 'comment',
                        'url' => '/dashboard/kontakt',
                        'visible' => Yii::$app->user->identity->right >= 0],

                    [
                        'label' => 'Stammdaten',
                        'icon' => 'cog',
                        'url' => '/dashboard/stammdaten',
                        'visible' => Yii::$app->user->identity->right >= 0],

                    [
                        'label' => 'CRM',
                        'url' => '',
                        'icon' => 'wrench',
                        'visible' => Yii::$app->user->identity->right >= 1,
                        'items' => [
                            [
                                'label' => 'Kunden Erfassen',
                                'url' => '/dashboard/kundendaten',
                                'visible' => Yii::$app->user->identity->right >= 1
                            ],
                            [
                                'label' => 'Kunden Produkt Erfassen',
                                'url' => '/dashboard/kundenproducts',
                                'visible' => Yii::$app->user->identity->right >= 1
                            ],
                            [
                                'label' => 'VPS Erfassen',
                                'url' => '/dashboard/kundenproductsvps',
                                'visible' => Yii::$app->user->identity->right >= 1
                            ],
                            ['label' => 'Monatliche Rechnung',
                                'url' => '/dashboard/monthly-invoice',
                                'visible' => Yii::$app->user->identity->right >= 1
                            ],

                            ['label' => 'Monatliche Kündigung',
                                'url' => '/dashboard/monthly-cancellation',
                                'visible' => Yii::$app->user->identity->right >= 1
                            ],
                        ]
                    ],
                    [
                        'label' => 'Marketing',
                        'url' => '',
                        'icon' => 'edit',
                        'visible' => Yii::$app->user->identity->right >= 2,
                        'items' => [
                            [
                                'label' => 'Seo Manager',
                                'url' => '/dashboard/seomanager',
                                'visible' => Yii::$app->user->identity->right >= 2
                            ],
                            [
                                'label' => 'Pressespiegel',
                                'url' => '/dashboard/pressespiegel',
                                'visible' => Yii::$app->user->identity->right >= 2
                            ],
                            [
                                'label' => 'Newsmanager',
                                'url' => '/dashboard/newsmanager',
                                'visible' => Yii::$app->user->identity->right >= 2
                            ],                            [
                                'label' => 'Newsletter',
                                'url' => '/dashboard/seomanager',
                                'visible' => Yii::$app->user->identity->right >= 2
                            ],

                        ]
                    ],

                    [
                        'label' => 'Simple Log Server',
                        'icon'=>'exclamation-triangle',
                        'url' => '',
                        'visible' => Yii::$app->user->identity->right >= 2,
                        'items' => [
                            ['label' => 'Weclapp Log',
                                'url' => '/dashboard/weclapplog',
                                'visible' => Yii::$app->user->identity->right >= 3
                            ],
                            ['label' => 'VR-Payment Log',
                                'url' => '/dashboard/vrpaymentlog',
                                'visible' => Yii::$app->user->identity->right >= 2
                            ],
                            ['label' => 'Nextcloud Log',
                                'url' => '/dashboard/nextcloudlog',
                                'visible' => Yii::$app->user->identity->right >= 3
                            ],
                            ['label' => 'Customer Pre Order',
                                'url' => '/dashboard/customerpreorder',
                                'visible' => Yii::$app->user->identity->right >= 3
                            ],
                        ]
                    ],

                    [
                        'label' => 'VR-Pay Konfiguration',
                        'icon' => 'money-bill',
                        'url' => '',
                        'visible' => Yii::$app->user->identity->right >= 4,
                        'items' => [
                            [
                                'label' => 'Grund Konfiguration',
                                'class'=>'nav-link',
                                'url' => '/dashboard/vr-configuration',
                                'visible' => Yii::$app->user->identity->right >= 5
                            ],
                            [
                                'label' => 'Brands Konfiguration',
                                'class'=>'nav-link',
                                'url' => '/dashboard/vr-brands-configuration',
                                'visible' => Yii::$app->user->identity->right >= 5
                            ],
                        ]
                    ],
                    [
                        'label' => 'Weclapp Konfiguration',
                        'icon' => 'user-alt',
                        'url' => '',
                        'visible' => Yii::$app->user->identity->right >= 5,
                        'items' => [
                            [
                                'label' => 'Grund Konfiguration',
                                'class'=>'nav-link',
                                'url' => '/dashboard/vr-configuration',
                                'visible' => Yii::$app->user->identity->right >= 5
                            ],
                            [
                                'label' => 'Brands Konfiguration',
                                'class'=>'nav-link',
                                'url' => '/dashboard/vr-brands-configuration',
                                'visible' => Yii::$app->user->identity->right >= 5
                            ],
                        ]
                    ],
                    [
                        'label' => 'Modul Konfiguration',
                        'icon' => 'cogs',
                        'url' => '',
                        'visible' => Yii::$app->user->identity->right >= 5,
                        'items' => [
                            [
                                'label' => 'Nextcloud Konfiguration',
                                'class'=>'nav-link',
                                'url' => '/dashboard/vr-configuration',
                                'visible' => Yii::$app->user->identity->right >= 5
                            ],
                            [
                                'label' => 'Proxmox Konfiguration',
                                'class'=>'nav-link',
                                'url' => '/dashboard/vr-brands-configuration',
                                'visible' => Yii::$app->user->identity->right >= 5
                            ],
                        ]
                    ],









                    ],

                ]


        ) ?>

        </nav>
    </div>

</aside>
