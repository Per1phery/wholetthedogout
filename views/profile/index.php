<?php
echo \himiklab\sortablegrid\SortableGridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'image',
            'format' => 'html',
            'value' => function($model) {
                return \yii\helpers\Html::img($model->getThumbImage(150, 100));
            }
        ],
        'full_name',
        'description',
        [
            'attribute' => 'status',
            'value' => function($model) use ($statuses) {
                return $statuses[$model->status];
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ],
    ]
]);