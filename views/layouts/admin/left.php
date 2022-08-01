	<?php 
	use yii\helpers\Html;
	if (Yii::$app->user->isGuest) {
			return  $this->redirect('/dashboard/login');
    }?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/dashboard" class="brand-link">
        <span class="brand-text font-weight-light">Admin Control</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
        <?= greeneye\adminlte\widgets\Menu::widget(
            [
                'options' => ['class' => 'nav nav-pills nav-sidebar flex-column', 'data-widget'=> 'treeview' ,'role'=>"menu"],
                'items' => [
                    ['label' => 'Login', 'url' => ['dashboard'], 'visible' => Yii::$app->user->isGuest],
                        [
                        'label' => 'News Manager',
                              'icon' => 'ban',
                              'url' => './seomanager',
                              'visible' => Yii::$app->user->identity->right >= 5
                        ],
                    ],
            ]
        ) ?>

        </nav>
    </div>

</aside>
