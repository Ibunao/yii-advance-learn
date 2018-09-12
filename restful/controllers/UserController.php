<?php
namespace restful\controllers;

use Yii;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
	public $modelClass = 'common\models\User';
}