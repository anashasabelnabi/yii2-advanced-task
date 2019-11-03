<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
