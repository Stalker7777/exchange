<?php

namespace app\controllers;

use yii\rest\Controller;
use yii\data\ActiveDataProvider;
use app\models\Currency;
use yii\filters\auth\HttpBearerAuth;

class CurrencyController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }
    
    /**
     * @return ActiveDataProvider
     */
    public function actionIndex()
    {
        $this->serializer = [
            'class' => 'yii\rest\Serializer',
            'collectionEnvelope' => 'items',
        ];
        
        return new ActiveDataProvider([
            'query' => Currency::find(),
        ]);
    }
    
    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $this->serializer = [
            'class' => 'yii\rest\Serializer',
        ];
    
        return new ActiveDataProvider([
            'query' => Currency::find()->where(['id' => $id]),
        ]);
    }
    
}


