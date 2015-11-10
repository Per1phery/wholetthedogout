<aside class="main-sidebar">

    <section class="sidebar">
        <?php
        $unconfirmedCount = \app\models\Feedback::unconfirmedCount();
        if ($unconfirmedCount > 0) {
            $badge = \yii\helpers\Html::tag('span',\app\models\Feedback::unconfirmedCount(), ['class' => 'badge', 'style' => 'float:right; margin-right:5px']);
        } else {
            $badge = '';
        }
        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => Yii::t('app', 'Menu'), 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'Feedback') . $badge,
                        'icon' => 'glyphicon glyphicon-earphone', 'url' => ['/feedback/index']],
                    ['label' => Yii::t('app', 'Slider'), 'icon' => 'glyphicon glyphicon-picture', 'url' => '',
                        'items' => [
                            ['label' => Yii::t('app', 'List'), 'icon' => 'glyphicon glyphicon-list', 'url' => ['/carousel/index']],
                            ['label' => Yii::t('app', 'Create'), 'icon' => 'fa fa-file-code-o', 'url' => ['/carousel/create']]
                        ]
                    ],
                    ['label' => Yii::t('app', 'Profile'), 'icon' => 'glyphicon glyphicon-camera', 'url' => '',
                        'items' => [
                            ['label' => Yii::t('app', 'List'), 'icon' => 'glyphicon glyphicon-list', 'url' => ['/profile/index']],
                            ['label' => Yii::t('app', 'Create'), 'icon' => 'fa fa-file-code-o', 'url' => ['/profile/create']]
                        ]
                    ],
                    ['label' => Yii::t('app', 'File'), 'icon' => 'glyphicon glyphicon-floppy-disk', 'url' => ['/file/index']],
                    ['label' => Yii::t('app', 'Users Managment'), 'icon' => 'glyphicon glyphicon-user', 'url' => '',
                        'items' => [
                            ['label' => Yii::t('app', 'List'), 'icon' => 'glyphicon glyphicon-list', 'url' => ['/user-managment/index']],
                            ['label' => Yii::t('app', 'Create'), 'icon' => 'fa fa-file-code-o', 'url' => ['/user-managment/create']],
//                            ['label' => Yii::t('app', 'Self Profile'), 'icon' => 'fa fa-file-code-o', 'url' => ['/user-managment/profile']]
                        ]
                    ],
                    ['label' => Yii::t('app', 'Self Profile'), 'icon' => 'glyphicon glyphicon-sunglasses', 'url' => '',
                        'items' => [
                            ['label' => Yii::t('app', 'Update profile'), 'icon' => 'fa fa-file-code-o', 'url' => ['/user-managment/profile']],
                            ['label' => Yii::t('app', 'Change password'), 'icon' => 'fa fa-file-code-o', 'url' => ['/user-managment/change-password']]
                        ]
                    ],
                    ['label' => Yii::t('app', 'Settings'), 'icon' => 'glyphicon glyphicon-cog', 'url' => ['/settings/index']],
                    /*
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],*/
                ],
            ]
        ) ?>

    </section>

</aside>
