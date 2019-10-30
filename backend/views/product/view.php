<?php

use backend\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
        ],
    ]) ?>

</div>
