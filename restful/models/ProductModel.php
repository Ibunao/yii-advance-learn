<?php

namespace restful\models;

use Yii;

/**
 * This is the model class for table "meet_product".
 *
 * @property string $product_id
 * @property string $purchase_id 订货会
 * @property string $product_sn 商品的货号(442127150653002)
 * @property string $style_sn 款号(442127150653)
 * @property string $model_sn 型号(44212715)
 * @property string $serial_num 流水号
 * @property string $name 商品名称
 * @property string $img_url 图片地址
 * @property string $color_id 颜色
 * @property string $size_id 尺码
 * @property string $brand_id 品牌
 * @property string $cat_b 大类
 * @property string $cat_m 中类
 * @property string $cat_s 小类
 * @property string $season_id 季节
 * @property string $level_id 等级
 * @property string $wave_id 波段
 * @property string $scheme_id 色系
 * @property string $cost_price 销售价
 * @property string $price_level_id 价格带
 * @property string $memo 描述
 * @property int $type_id
 * @property string $disabled 是否实现
 * @property string $is_error
 * @property int $is_down 是否下架 0 上架，1下架
 * @property string $order 排序
 */
class ProductModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meet_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purchase_id', 'product_sn', 'style_sn', 'model_sn', 'serial_num', 'name', 'color_id', 'size_id', 'brand_id', 'cat_b', 'cat_m', 'cat_s', 'season_id', 'level_id', 'wave_id', 'scheme_id', 'cost_price', 'price_level_id'], 'required'],
            [['purchase_id', 'serial_num', 'color_id', 'size_id', 'brand_id', 'cat_b', 'cat_m', 'cat_s', 'season_id', 'level_id', 'wave_id', 'scheme_id', 'price_level_id', 'type_id', 'is_down', 'order'], 'integer'],
            [['cost_price'], 'number'],
            [['disabled', 'is_error'], 'string'],
            [['product_sn', 'style_sn', 'model_sn'], 'string', 'max' => 30],
            [['name', 'img_url'], 'string', 'max' => 128],
            [['memo'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'purchase_id' => 'Purchase ID',
            'product_sn' => 'Product Sn',
            'style_sn' => 'Style Sn',
            'model_sn' => 'Model Sn',
            'serial_num' => 'Serial Num',
            'name' => 'Name',
            'img_url' => 'Img Url',
            'color_id' => 'Color ID',
            'size_id' => 'Size ID',
            'brand_id' => 'Brand ID',
            'cat_b' => 'Cat B',
            'cat_m' => 'Cat M',
            'cat_s' => 'Cat S',
            'season_id' => 'Season ID',
            'level_id' => 'Level ID',
            'wave_id' => 'Wave ID',
            'scheme_id' => 'Scheme ID',
            'cost_price' => 'Cost Price',
            'price_level_id' => 'Price Level ID',
            'memo' => 'Memo',
            'type_id' => 'Type ID',
            'disabled' => 'Disabled',
            'is_error' => 'Is Error',
            'is_down' => 'Is Down',
            'order' => 'Order',
        ];
    }
}
