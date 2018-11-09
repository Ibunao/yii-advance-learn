<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "meet_level".
 *
 * @property string $level_id 主键，自增，类型id
 * @property string $level_name 等级名称
 * @property string $p_order 排序
 */
class LevelModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meet_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level_name'], 'required'],
            [['p_order'], 'integer'],
            [['level_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'level_id' => 'Level ID',
            'level_name' => 'Level Name',
            'p_order' => 'P Order',
        ];
    }
}
