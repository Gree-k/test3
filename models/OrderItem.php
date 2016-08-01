<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property string $id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $name
 * @property double $price
 * @property integer $count
 * @property double $sum
 */
class OrderItem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'order_item';
    }

    public function fill($item, $id, $order)
    {
        $this->order_id = $order;
        $this->product_id = $id;
        $this->name = $item['name'];
        $this->price = $item['price'];
        $this->count = $item['count'];
        $this->sum = $item['price'] * $item['count'];

    }

    public function getOrder(){
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    public function rules()
    {
        return [
            [['order_id', 'product_id', 'name', 'price', 'count', 'sum'], 'required'],
            [['order_id', 'product_id', 'count'], 'integer'],
            [['price', 'sum'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'name' => 'Name',
            'price' => 'Price',
            'count' => 'Count',
            'sum' => 'Sum',
        ];
    }
}
