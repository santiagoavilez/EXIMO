<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Task $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

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
            'name',
            'description',
            'type',
            'person_id',
            'company_id',
            [
                'attribute' => 'priority',
                'format' => 'text',
                'value' => function ($model) {
                    if ($model->priority === 1) {
                        return 'High';
                    } elseif ($model->priority === 2) {
                        return 'Medium';
                    } else {
                        return 'Low';
                    }
                }
            ],
            'modification_date',
            'creation_date',
            'finish_date',
            [
                'attribute' => 'active',
                'format' => 'text',
                'value' => $model->active === 1 ? 'si' : 'no'
            ],
        ],
    ]) ?>

</div>