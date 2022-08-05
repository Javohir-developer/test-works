<?php

use common\models\Catalog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CatalogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $getParam;
$this->params['breadcrumbs'][] = Yii::t('app', 'Модель');
?>
<div class="catalog-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Создать каталог'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'car_grid_id',
                'value' => function($model) {
                    return $model->car->brand;
                }
            ],
            'models',
            [
                'attribute' => 'engine_type',
                'value' => function($model) {
                    return $model::engineType()[$model->engine_type];
                }
            ],
            [
                'attribute' => 'drive',
                'value' => function($model) {
                    return $model::engineType()[$model->drive];
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Catalog $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

</div>
