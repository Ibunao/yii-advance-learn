<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
/**
 * Goods controller
 */
class GoodsController extends Controller
{
	/**
     * {@inheritdoc}
     */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     'actions' => ['index'],
    //                     'allow' => true,
    //                     'roles' => ['role1'],
    //                     'roleParams' => ['a', 'b', 'c'],
    //                 ],
    //             ],
    //         ],
    //     ];
    // }
	public function actionIndex()
	{
		return $this->render('/test/index', ['name' => 'index']);
	}
	public function actionUpdate()
	{
		echo 'update';
	}
	public function actionDelete()
	{
		echo 'delete';
	}
	public function actionInsert()
	{
		echo 'Insert';
	}
	public function actionView()
	{
		echo 'view';
	}
}
