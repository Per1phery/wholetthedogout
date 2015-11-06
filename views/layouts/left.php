<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?= dmstr\widgets\Menu::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'Feedback') . \yii\helpers\Html::tag('span',\app\models\Feedback::unconfirmedCount(), ['class' => 'badge', 'style' => 'float:right; margin-right:5px']),
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
