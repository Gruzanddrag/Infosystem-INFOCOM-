<?php

namespace app\controllers;

use yii\web\Response;
use Yii;
use app\models\Umk;
use app\models\StudentRequirementType;
use kartik\mpdf\Pdf;

class ReportController extends \yii\web\Controller
{ 
    public function actionUmk($id) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $umk = Umk::findOne($id);
        $content = $this->renderPartial('umk', [
            'umk' => $umk,
            'requirements' => StudentRequirementType::find()->all()
        ]);
        $pdf = Yii::$app->pdf;
        $pdf->content = $content;
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    public function actionUmkLib() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $umk = Umk::find()->all();
        $content = $this->renderPartial('umk-lib', [
            'umks' => $umk,
        ]);
        $pdf = Yii::$app->pdf;
        $pdf->content = $content;
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    
    public function actionViewUmk($id) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $umk = Umk::findOne($id);
        return $this->render('umk', [
            'umk' => $umk,
            'requirements' => StudentRequirementType::find()->all()
        ]); 
    }

}
