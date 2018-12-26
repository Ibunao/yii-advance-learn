<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\behaviors\IpRateLimiter;
/**
 * Goods controller
 */
class RateController extends Controller
{
	public function behaviors()
    {
        return [
            'ipRateLimiter' => [
                'class' => IpRateLimiter::className(),
                'enabled' => true
            ],
        ];
    }
	public function actionIndex()
	{
		echo 'index';
	}

}
