<?php
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'attribute' => 'phone',
            'contentOptions'=>['style'=>'width: 47%;']
        ],
        [
            'attribute' => 'created_at',
            'headerOptions' => ['style'=>'text-align: center;'],
            'contentOptions'=>['style'=>'width: 25%;text-align: center;']
        ],
        [
            'filter' => $statuses,
            'format' => 'raw',
            'attribute' => 'status',
            'headerOptions' => ['style'=>'text-align: center;'],
            'contentOptions'=>['style'=>'width: 25%;text-align: center;'],
            'value' => function($model) {
                return \yii\helpers\Html::checkbox('', $model->status == \app\models\Feedback::STATUS_CONFIRMED, [
                    'class' => 'switch',
                    'data-id' => $model->primaryKey,
                    'data-link' => \yii\helpers\Url::to([$this->context->id.'/change-status/']),
                ]);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
        ],
    ]
]);