<?php

namespace backend\controllers;

use common\models\AppleGenerateForm;
use Yii;
use common\models\Apple;
use common\models\AppleSearch;
use yii\db\Exception;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

/**
 * AppleController implements the CRUD actions for Apple model.
 */
class AppleController extends Controller
{


public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ],
    ];
}

    /**
     * Lists all Apple models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AppleSearch();
        $appleGenerateForm=new AppleGenerateForm();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'appleGenerateForm'=>$appleGenerateForm
        ]);
    }

    /**
     * Change Size for Apple
     * @return json
     */
    public function actionChangeSize(){
        if($_POST['editableKey']){
            $model=Apple::findOne(['id'=>$_POST['editableKey']]);
            try {
                $model->eat($_POST['Apple'][$_POST['editableIndex']]['size']);
                $model->save();
                echo Json::encode(['output'=>number_format($model->size,2)]);
            } catch (\Exception $e){
                echo Json::encode(['message'=>$e->getMessage()]);
            }
        }
    }

    /**
     * Fall To Ground Apple.
     * @return mixed
     */
    public function actionFallToGround(int $id){
        $model=Apple::findOne(['id'=>$id]);
        if(!$model) throw new HttpException(404,'Apple is not exist');
        $model->status="fall";
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Generate Apple models.
     * If generate is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionGenerate()
    {
        $model=new AppleGenerateForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            for($i=0;$i<$model->quantity;$i++){
                $apple=new Apple();
                $apple->save();
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Apple model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Apple model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Apple the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Apple::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
