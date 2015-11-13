<?php
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'login',
            'contentOptions'=>['style'=>'width: 43%']
        ],
        [
            'attribute' => 'email',
            'contentOptions'=>['style'=>'width: 43%']
        ],
        [
            'attribute' => 'created_at',
            'format' => ['date', 'd/m/Y H:i:s'],
            'contentOptions'=>['style'=>'width: 14%']
        ]
    ]
]);