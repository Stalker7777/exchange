<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\LoginForm;

class AuthorizationController extends Controller
{
    public function actionGetToken()
    {
        $username = Yii::$app->request->authUser;
        $password = Yii::$app->request->authPassword;
    
        $model = new LoginForm();
    
        $model->username = $username;
        $model->password = $password;
    
        if($model->login()) {
    
            $user = $model->getUser();
            
            return json_encode(['access_token' => $user->accessToken]);
        }
        
        return json_encode(['access_token' => 'Not Authorization!']);
    }
}