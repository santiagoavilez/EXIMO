<?php

use app\models\Task;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TaskSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'type',
            [
                'attribute' => 'person_id',
                'format' => 'text',
                'value' => function (Task $model, $key, $index, $column) {
                    return $model->getPerson()->one()->name;
                }
            ],
            [
                'attribute' => 'company_id',
                'format' => 'text',
                'value' => function (Task $model, $key, $index, $column) {
                    
                    return $model->getCompany()->one() !=null ? $model->getCompany()->one()->name : 'Sin empresa';
                }
            ],

            [
                'attribute' => 'priority',
                'format' => 'text',
                'filter' => Html::activeDropDownList($searchModel, 'priority', [1 => 'High', 2 => 'Medium', 3 => 'Low'], ['class' => 'form-control', 'prompt' => 'All']),
                'value' => function ($searchModel) {
                    if ($searchModel->priority === 1) {
                        return 'High';
                    } elseif ($searchModel->priority === 2) {
                        return 'Medium';
                    } else {
                        return 'Low';
                    }
                }
            ],
            //'modification_date',
            //'creation_date',
            //'active',
            [
                'attribute' => 'active',
                'format' => 'text',
                'filter' => Html::activeDropDownList($searchModel, 'active', [0 => 'Completado', 1 => 'Activo'], ['class' => 'form-control', 'prompt' => 'Todas']),
                'value' => function (Task $model, $key, $index, $column) {

                    return $model->active === 1 ? 'Activa': 'Completada';
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Task $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>