<?php

namespace backend\controllers;

use Yii;
use backend\models\Loan;
use backend\models\BookCopy;
use backend\models\LoanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

/**
 * LoanController implements the CRUD actions for Loan model.
 */
class LoanController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Loan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LoanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Loan model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Loan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Loan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionListJT(){
        $tan = date('Y-m-d');

        return $this->render('view', [
            'model' => $this->findModel('due_date' < $tan),
        ]);
    }

    /**
     * Updates an existing Loan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Loan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id , $copy_id)
    {

        $this->findModel($id)->delete();

        return $this->redirect(['view']);
    }

    /**
     * Finds the Loan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Loan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Loan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionApprove($id) {
        $tan = date('Y-m-d');
        $date = date_create($tan);
        date_add($date,date_interval_create_from_date_string("7 days"));
        $tanggal = date_format($date, "Y-m-d");
        $model = Loan::findOne($id);
        $model->start_date = $tan;
        $model->due_date = $tanggal;
        $model->save();

        return $this->redirect(['index']); 
    }

    public function actionReturn($id){
        $model = Loan::findOne($id);
        $_dueDate = $model->due_date;
        $date1 = date_create($_dueDate);
        $tan = date('Y-m-d');
        $date2 = date_create($tan);
        if($date2 < $date1){
            $denda = 0;
        }
        else{
            $result=date_diff($date1,$date2);
            $denda= $result->format("%a") * 200;
        }
        $copian = $model->copy_id ;
        $book_copy = BookCopy::findOne($copian);
        $book_copy->availability = 1;
        $book_copy->save();
        $model->return_date = $tan;
        $model->fines = $denda;
        $model->save();

        return $this->redirect(['index']);
    }

    public function actionReject($id){
         $model = Loan::findOne($id);
         $model->start_date = '0000-00-00';
         $model->due_date = '0000-00-00';
         $model->return_date = '0000-00-00';
         $model->save();
        return $this->redirect(['index']);
    }
}
