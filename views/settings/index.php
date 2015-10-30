<?php
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'title',
        'value',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
        ],
    ]
]);