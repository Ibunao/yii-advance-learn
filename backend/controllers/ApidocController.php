<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
/**
 * 测试接口文档
 */
class ApidocController extends Controller
{
	public $enableCsrfValidation = false;
	/**
	 * 注册步骤一：手机号获取验证码
	 * 
	 * @name	获取注册验证码
	 * @uses	用户注册是拉取验证码
	 * @method	post
	 * @param	string $phone 手机号
	 * @param	string $sign 签名
	 * @author	echoding
	 */
	public function actionIndex()
	{
		Yii::$app->response->format = 'json';
		return Yii::$app->request->post();
	}
	/**
	 * 注册步骤一：手机号获取验证码
	 * 
	 * @name	获取注册验证码
	 * @uses	用户注册是拉取验证码
	 * @method	get
	 * @param	string $phone 手机号
	 * @param	string $sign 签名
	 * @author	echoding
	 */
	public function actionIndexIndex()
	{
	  
	}
	public function actionTest()
	{
		return [];
	}
}