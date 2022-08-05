<?php

namespace common\models;

use mihaildev\elfinder\Controller;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalog".
 *
 * @property int $id
 * @property int|null $car_id
 * @property string|null $models
 * @property string|null $car_grid_id
 * @property int|null $engine_type
 * @property int|null $drive
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Cars $car
 */
class Catalog extends \yii\db\ActiveRecord
{
    public $car_grid_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_id', 'engine_type', 'drive', 'status', 'created_at', 'updated_at'], 'integer'],
            [['models', 'car_grid_id'], 'string', 'max' => 255],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cars::className(), 'targetAttribute' => ['car_id' => 'id']],
        ];
    }

    public static function engineType(){
        $param = [
            1  => Yii::t('app', 'Бензин'),
            2  => Yii::t('app', 'Бензин'),
            3  => Yii::t('app', 'Бензин')
            ];
        return $param;
    }
    public static function drive(){
        $param = [
            1  => Yii::t('app', 'Полный'),
            2  => Yii::t('app', 'Передний')
            ];
        return $param;
    }
    public static function cars(){
        return ArrayHelper::map(Cars::find()->all(), 'id', 'brand');
    }

    public function titleParam($params){
            if ($params){
                $params = $params["CatalogSearch"];
                if ((isset($params['car_grid_id']) && $params['car_grid_id']!= '') || (isset($params['models']) && $params['car_grid_id']!= '')){
                    return $params['car_grid_id'].' '.$params['models'];
                }
            }
            return Yii::t('app', 'Модель');
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => Yii::t('app', 'Марка автомобиля'),
            'models' => Yii::t('app', 'Модель'),
            'engine_type' => Yii::t('app', 'Тип двигателя'),
            'drive' => Yii::t('app', 'Привод'),
//            'status' => 'Status',
//            'created_at' => 'Created At',
//            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Car]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Cars::className(), ['id' => 'car_id']);
    }
}
