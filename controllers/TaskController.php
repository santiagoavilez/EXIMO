<?php

namespace app\controllers;

use app\models\Companies;
use app\models\People;
use app\models\PeopleSearch;
use app\models\Task;
use app\models\TaskSearch;
use DateTime;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Task models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $tasks = Task::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tasks' => $tasks
        ]);
    }

    /**
     * Displays a single Task model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Task();
        $persons = People::find()->all();
        $companies = Companies::find()->all();
        if ($this->request->isPost) {

            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            var_dump($model->getErrors());
            die();
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'persons' => $persons,
            'companies' => $companies,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $values = $this->request->post();
        $newDate = new DateTime();
        $newDate = $newDate->format('Y-m-d H:i:s'); // for example
        $values['Task']['modification_date'] = $newDate;
        $persons = People::find()->all();
        $companies = Companies::find()->all();
        if ($this->request->isPost && $model->load($values) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'values' => $values]);
        }

        return $this->render('update', [
            'model' => $model,
            'persons' => $persons,
            'companies' => $companies,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $model = $this->findModel($id);
        $values = $this->request->post();
        $newDate = new DateTime();
        $newDate = $newDate->format('Y-m-d H:i:s'); // for example
        $values['Task']['finish_date'] = $newDate;
        $values['Task']['active'] = 0;
        $persons = People::find()->all();
        $companies = Companies::find()->all();
        if ($this->request->isPost && $model->load($values) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'values' => $values]);
        }
        // $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
