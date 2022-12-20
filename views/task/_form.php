<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
/** @var yii\web\View $this */
/** @var app\models\Task $model */
/** @var app\models\Person $person */
/** @var yii\widgets\ActiveForm $form */

    $arrPersons = array();
    foreach ($persons as $person) {
        $arrPersons[$person->id] =$person->name;
        
    }
    $arrCompanies = array();
    foreach ($companies as $company) {
        $arrCompanies[$company->id] = $company->name;
    }
    $arrPriority = array();
    $arrPriority[3] = 'Low';
    $arrPriority[2] = 'Medium';
    $arrPriority[1] = 'High';  
 ?>

<div class="task-form">


    <?php $form = ActiveForm::begin(); ?>
    

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_id')->widget(Select2::classname(), [
        'data' => $arrPersons,
        'options' => ['placeholder' => 'Select a Person ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    
    ?>
    <?= $form->field($model, 'company_id')->widget(Select2::classname(), [
        'data' => $arrCompanies,
        'options' => ['placeholder' => 'Select a Company ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    
    ?>   
    <?= $form->field($model, 'priority')->widget(Select2::classname(), [
        'data' => $arrPriority,
        'options' => ['placeholder' => 'Select a Company ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    
    ?>    
   
    
    <?php
    /*
    $form->field($model, 'modification_date')->widget(
        \yii\jui\DatePicker::className(),
        [
            'dateFormat' => 'yyyy-MM-dd',
        ],
        ['placeholder' => 'YYYY-MM-DD']
    )
        ->textInput(['placeholder' => \Yii::t('app', 'YYYY-MM-DD')]);
        */
         ?>

    <?php
    /*
     $form->field($model, 'creation_date')->widget(
        \yii\jui\DatePicker::className(),
        [
            'dateFormat' => 'yyyy-MM-dd',
        ],
        ['placeholder' => 'YYYY-MM-DD']
    )
        ->textInput(['placeholder' => \Yii::t('app', 'YYYY-MM-DD')]); */  ?>

    <?= $form->field($model, 'active')->textInput() 
    ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>