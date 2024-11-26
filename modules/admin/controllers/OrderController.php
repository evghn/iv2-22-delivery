<?php

namespace app\modules\admin\controllers;

use app\models\Order;
use app\models\Status;
use app\modules\admin\models\OrderSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $statuses = Status::getStatuses();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statuses' => $statuses,

        ]);
    }

    /**
     * Displays a single Order model.
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
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCancel($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Order::SCENARIO_CANCEL;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->status_id = Status::getStatusId('Отмена');
            Yii::$app->session->setFlash('warning', 'Заказ отменен.');
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                VarDumper::dump($model->errors, 10, true);
                die;
            }
        }

        return $this->render('cancel', [
            'model' => $model,
        ]);
    }


    public function actionApply($id)
    {
        if ($model = $this->findModel($id)) {
            if ($model->status_id == Status::getStatusId('Новый')) {
                $model->status_id = Status::getStatusId('Готов к выдаче');
                Yii::$app->session->setFlash('success', 'Заказ успешно подтвержден.');
                if (!$model->save()) {
                    VarDumper::dump($model->errors, 10, true); die;
                }
            }
        }

        return $this->redirect('index');
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
