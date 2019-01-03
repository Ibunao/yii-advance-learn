<?php
namespace backend\modules\document;

use Yii;
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\document\controllers';
    public $debugHost;

    public function init()
    {
    	if ($this->debugHost) {
    		$this->debugHost = Yii::$app->request->getHostInfo() . Yii::$app->request->getBaseUrl();
    	}
        parent::init();
    }
}
