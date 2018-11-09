<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use moonland\phpexcel\Excel;
use backend\models\LevelModel;
use backend\models\ColorModel;
/**
 * yii-excel 测试
 */
class ExcelController extends Controller
{
	/**
	 * 一表单sheet下载
	 * @return [type] [description]
	 */
	public function actionIndex()
	{
		$models = LevelModel::find()->all();
		Excel::widget([
			'models' => $models,
			'fileName' => '下载', // 设置下载文件名
			// 'savePath' => 'D:\ding\wamp64\www\yii\advance\yii-learn\backend\runtime', // 生成在服务器  
			'mode' => 'export', // 导出
			'columns' => ['level_id','level_name','p_order'], // 列，通过 $model['level_id'] 来取对应的值
			'headers' => ['level_id' => 'Header Column 1','level_name' => 'Header Column 2', 'p_order' => 'Header Column 3'], // 列对应的header ，title行的数据
		]);
	}
	/**
	 * 一表单sheet下载
	 * @return [type] [description]
	 */
	public function actionData()
	{
		$models = [
			['level_id' => 1, 'level_name' => 'ding', 'p_order' => 21],
			['level_id' => 2, 'level_name' => 'ding', 'p_order' => 21],
			// 生成空行
			['level_id' => '', 'level_name' => '', 'p_order' => ''],
			// 巧妙设置统计信息
			['level_id' => '总额：', 'level_name' => '128'],
		];
		Excel::widget([
			'models' => $models,
			'fileName' => '下载', // 设置下载文件名
			// 'savePath' => 'D:\ding\wamp64\www\yii\advance\yii-learn\backend\runtime', // 生成在服务器  
			'mode' => 'export', // 导出
			'columns' => ['level_id','level_name','p_order'], // 列，通过 $model['level_id'] 来取对应的值
			'headers' => ['level_id' => 'Header Column 1','level_name' => 'Header Column 2', 'p_order' => 'Header Column 3'], // 列对应的header ，title行的数据
		]);
	}
	/**
	 * 一表多sheet 下载
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
	public function actionMultiple()
	{
		$model1 = LevelModel::find()->all();
		$model2 = ColorModel::find()->all();
		Excel::widget([
			'isMultipleSheet' => true,
			'models' => [
				'sheet1' => $model1, 
				'sheet2' => $model2, 
			],
			'mode' => 'export', //default value as 'export'
			'columns' => [
				'sheet1' => ['level_id','level_name','p_order'],
				'sheet2' => ['color_no','color_name','scheme_id'],
			],
			'headers' => [
				'sheet1' => ['level_id' => 'Header Column 1','level_name' => 'Header Column 2', 'p_order' => 'Header Column 3'], 
				'sheet2' => ['color_no' => 'Header Column 1','color_name' => 'Header Column 2', 'scheme_id' => 'Header Column 3'], 
			],
		]);
	}
	/**
	 * 读取单文件
	 * @return [type] [description]
	 */
	public function actionImport()
	{
		$fileName = 'exports2.xls';
		$data = Excel::widget([
			'mode' => 'import', // 导入模式
			'fileName' => $fileName, // 文件名
			'setFirstRecordAsKeys' => false, // 是否使用第一行的title字段作为行数据的key
			'setIndexSheetByName' => false,  // 是否使用sheet名作为sheet数组的key
			// 'getOnlySheet' => '单元1', // 读取那个sheet的name ，如果不设置则读取所有的sheet
		]);
		echo json_encode($data);
	}
	/**
	 * 读取多文件
	 * @return [type] [description]
	 */
	public function actionImporttwo()
	{
		$fileName1 = 'exports2.xls';
		$fileName2 = 'exports1.xls';
		$data = Excel::widget([
			'mode' => 'import', // 导入模式
			'fileName' => [
				'file1' => $fileName1,
				'file2' => $fileName2,
			],
			'setFirstRecordAsKeys' => true, 
			'setIndexSheetByName' => true, 
			// 'getOnlySheet' => '单元1', // 读取那个sheet的name ，如果不设置则读取所有的sheet
		]);
		echo json_encode($data);
	}
}