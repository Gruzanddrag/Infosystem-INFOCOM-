<?php

namespace app\modules\umk\controllers;

use yii\web\Response;
use Yii;
use app\models\Umk;
use kartik\mpdf\Pdf;

class ReportController extends \yii\web\Controller
{
    
    public function actionReport() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('index');
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Krajee Report Header'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

}
