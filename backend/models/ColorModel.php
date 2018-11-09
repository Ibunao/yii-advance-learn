<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "meet_color".
 *
 * @property string $color_id 主键，自增，类型id
 * @property string $color_no 颜色代码
 * @property string $color_name 颜色名称
 * @property int $scheme_id
 * @property string $p_order 排序
 */
class ColorModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meet_color';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color_no', 'color_name'], 'required'],
            [['scheme_id', 'p_order'], 'integer'],
            [['color_no'], 'string', 'max' => 5],
            [['color_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'color_id' => 'Color ID',
            'color_no' => 'Color No',
            'color_name' => 'Color Name',
            'scheme_id' => 'Scheme ID',
            'p_order' => 'P Order',
        ];
    }
}
