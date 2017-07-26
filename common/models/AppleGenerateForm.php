<?php

namespace common\models;

use yii\base\Model;

/**
 * This is the model class for generate Apple Models
 *
 * @property integer $number
 */
class AppleGenerateForm extends Model
{

    public $quantity;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity'], 'required'],
            [['quantity'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'quantity' => 'Введите количество'
        ];
    }
}
