<?php

namespace common\models;

use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "apple".
 *
 * @property integer $id
 * @property string $color
 * @property integer $created_at
 * @property integer $fall_at
 * @property string $status
 * @property string $size
 */
class Apple extends \yii\db\ActiveRecord
{
    static $statusArr=[
        'hanging'=>'висит на дереве',
        'fall'=>'упало/лежит на земле',
        'rotten'=>'гнилое яблоко',
    ];

    public function __construct($color=false) {
        if($color) $this->color=$color;
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%apple}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'fall_at'], 'integer'],
            [['status'], 'in','range'=>['hanging','fall','rotten']],
            [['size'], 'number'],
            [['color'], 'string', 'max' => 50],

            //Default Values
            ['status', 'default','value'=>'hanging'],
            ['size', 'default','value'=>1.00],
            ['created_at', 'default','value'=>mt_rand(1, time())],
            ['color', 'default','value'=>sprintf('#%06X', mt_rand(0, 0xFFFFFF))],
        ];
    }

    public function beforeSave($insert)
    {
        if($this->status=="fall"){
            $this->fall_at=time();
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterFind()
    {
        if($this->status=="fall" && time()-$this->fall_at>5*3600){
            $this->status="rotten";
        }
        parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'created_at' => 'Дата появления',
            'fall_at' => 'Дата падения',
            'status' => 'Статус',
            'size' => 'Размер яблока',
        ];
    }

    /**
     * Function for set new size
     *
     * @param int $percent the percent of size
     *
     * @return void
     */
    function eat(int $percent){
        if($percent>100) {
            throw new Exception('Указан процент больше 100');
        } elseif($percent<0) {
            throw new Exception('Указан процент меньше 0');
        } elseif(!$this->canEat()){
            throw new Exception('Когда висит на дереве или испорчено, то съесть не получится.');
        }
        $newSize=$percent/100;
        if($newSize>$this->size){
            $this->size=0.00;
        } else {
            $this->size -= $percent / 100;
        }
    }

    /**
     * Check abot eating apple
     *
     * @return bool
     */
    function canEat(){
        if($this->status=="hanging" || $this->status=="rotten"){
            return false;
        } else {
            return true;
        }
    }
    /**
     * Function for fall To Ground
     *
     * @return void
     */
    function fallToGround(){
        $this->status="fall";
    }
}
