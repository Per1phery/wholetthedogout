<?php
echo \himiklab\sortablegrid\SortableGridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'image',
            'format' => 'html',
            'value' => function($model) {
                return \yii\helpers\Html::img(Yii::getAlias('@web') .'/uploads/'. $model->image, ['width'=>'140']);
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