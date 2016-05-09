<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Book;
use frontend\models\Member;
use frontend\models\Loan;
use frontend\models\BookCopy;
use frontend\models\BookSearch;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;


/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
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
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {

        $bookCopy = new BookCopy();
        $book = Book::find()->where(['id'=>$id])->one();
        $bookCopys = BookCopy::find()->where(['book_id'=>$book->id]);

        $DataProvider = new ActiveDataProvider(
            [
                'query'=>$bookCopys,
                'pagination'=>[
                    'pageSize' => 10
                ]
            ]
        );

        return $this->render('view', [
            'model' => $book,
            'bookCopy'=>$bookCopy,
            'dataProvider'=>$DataProvider 
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Book model.
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
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     public function actionBorrow($id, $book_id) {
        //if (Yii::$app->user->can('member')) {
            $user_id = Yii::$app->user->id;

            $member = Member::findOne(['account_id' => $user_id]);

            $count = Loan::find()->where(['borrower_id' => $member['id'], 'return_date' => NULL])->count();
            
            if ($count > 2) {
            
                return $this->redirect(Url::to(['loan/index', 'status' => 'toomany']));
            } else {
                //list book copy dengan book_id yang sama
                $book_copy = Yii::$app->db->createCommand('SELECT id FROM book_copy where book_id=' . $book_id)
                        ->queryColumn();
                //set in untuk query in
                $in = '(';
                for ($i = 0; $i < sizeof($book_copy); $i++) {
                    if ($i == (sizeof($book_copy) - 1)) {
                        $in = $in . $book_copy[$i] . ')';
                    } else {
                        $in = $in . $book_copy[$i] . ', ';
                    }
                }
                $similiar = Yii::$app->db->createCommand('SELECT COUNT(*) FROM loan where copy_id IN '
                                . $in . ' AND borrower_id= ' . $member['id'] . ' AND return_date IS NULL')
                        ->queryScalar();
                if ($similiar >= 1) {
                    return $this->redirect(Url::to(['loan/index', 'status' => 'similiar']));
                } else {
                    //save loan
                    $loan = new Loan();
                    $loan->borrower_id = $member['id'];
                    $loan->copy_id = $id;
                    $loan->start_date = '0000-00-00';
                    $loan->save();
                    //update availability book_copy
                    $update_copy = BookCopy::findOne($id);
                    $update_copy->availability = 0;
                    $update_copy->save();
                    return $this->redirect(Url::to(['loan/index', 'status' => 'success']));
                }
            }
        //} else {
        //    throw new ForbiddenHttpException;
        //}
    }
}
