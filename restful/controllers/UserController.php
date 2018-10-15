<?php
namespace restful\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class UserController extends ActiveController
{
	public function behaviors()
	{
	    $behaviors = parent::behaviors();
	    $behaviors['authenticator'] = [
	        'class' => HttpBearerAuth::className(),
	        // 可以不验证的action
			// 'optional' => ['index']
	    ];
	    return $behaviors;
	}
	public $modelClass = 'common\models\User';
}
