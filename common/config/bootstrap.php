<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
// 添加的模块要在这里设置一下别名,为了自动加载
Yii::setAlias('@restful', dirname(dirname(__DIR__)) . '/restful');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
