<?php
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'phone',
        'created_at',
        [
            'filter' => $statuses,
            'format' => 'html',
            'attribute' => 'status',
            'value' => function($model) use ($statuses) {
                return $statuses[$model->status];
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
        ],
    ]
]);