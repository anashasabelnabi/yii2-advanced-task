<?php

use backend\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'title',
            'description',
            [
                'attribute'=>'image',
                'value' => function ($model) {
                    return Html::a(Html::img(Yii::getAlias('@imageUrl'). '/' . $model->image,['width' => '120','height'=>'120']), Yii::getAlias('@imageUrl'). '/' . $model->image, ['class' => 'update-modal-link']);
                },
                'format'=>'raw',


            ],
            [
                'attribute'=>'created_at',

                'value'=>function($model){
                    return Yii::$app->formatter->asDatetime('now', "php:d-m-Y H:i:s");

                },

            ],
            [
                'attribute' => 'category',
                'filter'    =>ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'title'),
                'value'=>function($model){
                    return $model->createdBy->title;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
