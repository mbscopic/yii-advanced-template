<?php

namespace backend\controllers;

use phpDocumentor\Reflection\Types\This;
use Yii;
use backend\models\Branches;
use backend\models\BranchesSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * BranchesController implements the CRUD actions for Branches model.
 */
class BranchesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Branches models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BranchesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branches model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @return array|string
     */
    /*public function actionCreate()
    {
        $model = new Branches();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->created_date = date('Y-m-d H:i:s');
            //$model->save();
            //return $this->redirect(['view', 'id' => $model->id]);
            if ($model->save()) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    public function actionCreate()
    {
        $model = new Branches();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->created_date = date('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    public function actionValidation() {
        $model = new Branches();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * Updates an existing Branches model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Branches model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Branches model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Branches the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Branches::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLists($id) {
        $branches_number = Branches::find()->where(['id_company' => $id])->count();
        $branches = Branches::find()->where(['id_company' => $id])->all();

        if ($branches_number > 0) {
            foreach ($branches as $branch) {
                echo "<option value='$branch->id'>$branch->name</option>";
            }
        } else {
            echo "<option></option>";
        }
    }

    public function actionImportExcel() {
        $inputFile = 'uploads'. DIRECTORY_SEPARATOR . 'branches.xlsx';

        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $file = \PHPExcel_IOFactory::load($inputFile);
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        $sheet = $file->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 1; $row <= $highestRow; $row++){
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);
            if ($row == 1){
                continue;
            }

            $branch = new Branches();
            $id = $rowData[0][0];
            $branch->name = $rowData[0][1];
            $branch->address = $rowData[0][2];
            $branch->id_company = $rowData[0][4];
            $branch->status = $rowData[0][6];
            $branch->save();

            print_r($branch->getErrors());
        }

        die('ok');
    }

    public function actionUpload()
    {
        $fileName = 'file';
        $uploadPath = 'uploads';

        if (isset($_FILES[$fileName])) {
            $file = UploadedFile::getInstanceByName($fileName);
            if ($file->saveAs($uploadPath . '/' . $file->name)) {
                echo Json::encode($file);
            }
        } else {
            return $this->render('upload');
        }
        return false;
    }

    public function actionSetCookie() {
        $cookie = new Cookie([
            'name' => 'test',
            'value' => 'Test cookie value'
        ]);

        Yii::$app->getResponse()->getCookies()->add($cookie);
    }

    public function actionGetCookie() {
        if (Yii::$app->getRequest()->getCookies()->has('test')) {
            print_r(Yii::$app->getRequest()->getCookies()->getValue('test'));
        }
    }
}
