<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property string $create_at
 * @property string $update_at
 * @property integer $count
 * @property double $sum
 * @property integer $status
 * @property integer $user_id
 */
class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }

    public function rules()
    {
        return [
            [[ 'user_id'], 'required'],
            [['create_at', 'update_at'], 'safe'],
            [['count', 'status', 'user_id'], 'integer'],
            [['sum'], 'number'],
        ];
    }

    public function getOrderItems(){
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at', 'update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'count' => 'Count',
            'sum' => 'Sum',
            'status' => 'Status',
            'user_id' => 'User ID',
        ];
    }
}
