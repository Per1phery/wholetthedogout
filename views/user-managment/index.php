<?php
echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'login',
        'email',
        [
            'attribute' => 'created_at',
            'format' => ['date', 'd/m/Y H:i:s']
        ]
    ]
]);