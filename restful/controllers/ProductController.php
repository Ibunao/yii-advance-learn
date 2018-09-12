<?php
namespace restful\controllers;

use Yii;
use yii\rest\ActiveController;

class ProductController extends ActiveController
{
	public $modelClass = 'restful\models\ProductModel';
}