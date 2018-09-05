<?php

namespace app\modules\test;

/**
 * test module definition class
 */
class Test extends \yii\base\Module
{
    /**
     * 设置控制器命名空间路径
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\test\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
