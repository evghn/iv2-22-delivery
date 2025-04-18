<?php

namespace app\modules\dmf\controllers;

use app\models\Item;
use app\models\ItemProp;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
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
     * Lists all Item models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Item::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
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
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Item();
        $props = [];
        $props[] = new ItemProp();

        if ($this->request->isPost) {
            //  VarDumper::dump($this->request->post(), 10, true); die;
            if ($id = $this->request->post('Item')['id']) {
                $model = Item::findOne($id);
            }

            if ($model->load($this->request->post()) && $model->save()) {
                $props = [];  
                              
                foreach($this->request->post('ItemProp') as $item) {
                    $prop = $item['id'] 
                        ? ItemProp::findOne($item['id'])
                        : new ItemProp();
                    $prop->load($item, '');
                    $prop->item_id = $model->id;
                    $props[] = $prop;
                }                
                
                if (Model::validateMultiple($props)) {
                    // сначала удалить из бд
                    
                    ItemProp::deleteAll([
                        'not in',
                        'id',
                        array_map(fn($val) => $val->id, $props)
                    ]);    
                   
                    foreach ($props as $prop) {
                        $prop->save();
                    }
                    // VarDumper::dump(
                    //     array_map(fn($val) => $val->attributes, $props)                        
                    //     , 10, true); 
                    //     die;
                } else {
                    VarDumper::dump($this->request->post(), 10, true); 
                    VarDumper::dump(
                        array_map(fn($val) => $val->attributes, $props)                        
                        , 10, true);                         
                    VarDumper::dump(
                        array_map(fn($val) => $val->errors, $props)                        
                        , 10, true);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'props' => $props,
        ]);
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
       
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Item model.
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
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
