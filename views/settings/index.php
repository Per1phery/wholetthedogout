<?php
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'title',
            'contentOptions'=>['style'=>'width: 48.5%']
        ],
        [
            'attribute' => 'value',
            'contentOptions'=>['style'=>'width: 48.5%']
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
        ],
    ]
]);