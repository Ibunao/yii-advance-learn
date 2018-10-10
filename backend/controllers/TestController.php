<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Goods controller
 */
class TestController extends Controller
{
	public function actionIndex()
	{
		// echo $temp = Yii::$app->security->encryptByPassword("security","bunao");
		// echo "<br/>";
		// echo Yii::$app->security->decryptByPassword($temp,"bunao");
		// echo "<br/>";


		// // 进行base64编码，防止乱码
		// echo $temp = base64_encode(Yii::$app->security->encryptByPassword("security","bunao"));
		// echo "<br/>";
		// echo Yii::$app->security->decryptByPassword(base64_decode($temp),"bunao");

		return $this->render('index', ['name' => 'index']);
	}
	public function actionIndex2()
	{
		// $userId = 30;
		// echo $temp = Yii::$app->security->encryptByKey("security", "bunao", $userId);
		// echo "<br/>";
		// echo Yii::$app->security->decryptByKey($temp, "bunao", $userId);
		// echo "<br/>";


		// // 进行base64编码，防止乱码
		// echo $temp = base64_encode(Yii::$app->security->encryptByKey("security", "bunao", $userId));
		// echo "<br/>";
		// echo Yii::$app->security->decryptByKey(base64_decode($temp), "bunao", $userId);

		return $this->render('index', ['name' => 'index1']);
	}
	public function actionIndex3()
	{
		// $userId = 30;
		// echo $temp = Yii::$app->security->hashData("security", "bunao");
		// echo "<br/>";
		// echo Yii::$app->security->validateData($temp, "bunao");
		// echo "<br/>";

		return $this->render('index', ['name' => 'index3']);
	}
}