<?php
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'login',
        'email',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
        ],
    ]
]);