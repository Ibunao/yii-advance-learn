<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
/**
 * 测试接口文档
 */
class Apidoc2Controller extends Controller
{
	/**
	 * 注册步骤一：手机号获取验证码
	 * 
	 * @name	获取注册验证码
	 * @uses	用户注册是拉取验证码
	 * @method	get
	 * @param	string $phone 手机号
	 * @author	echoding
	 */
	public function actionIndex()
	{
		return [];
	}
	/**
	 * [actionTest description]
	 * @return [type] [description]
	 */
	public function actionTest()
	{
		return [];
	}
}