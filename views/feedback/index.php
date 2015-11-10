<?php
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'phone',
        'created_at',
        [
            'filter' => $statuses,
//            'format' => 'html',
            'format' => 'raw',
            'attribute' => 'status',
            /*'value' => function($model) use ($statuses) {
                return $statuses[$model->status];
            }*/
            'value' => function($model) {
                return \yii\helpers\Html::checkbox('', $model->status == \app\models\Feedback::STATUS_CONFIRMED, [
                    'class' => 'switch',
                    'data-id' => $model->primaryKey,
                    'data-link' => \yii\helpers\Url::to([$this->context->id.'/change-status/']),
                    'data-link2' => \yii\helpers\Url::toRoute([$this->context->id.'/test/', 'a' => 1, 'b' => 'qw']),
                ]);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
        ],
    ]
]);