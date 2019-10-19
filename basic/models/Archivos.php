<?php

namespace app\models;

use Yii;



/**
 * This is the model class for table "archivos".
 *
 * @property int $id
 * @property int $id_post
 * @property string $url
 */

class Archivos extends \yii\db\ActiveRecord
{
    public $file;
    public $archivos;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archivos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_post', 'url'], 'required'],
            [['id_post'], 'integer'],
            [['url'], 'string', 'max' => 50],
            ['archivos','string','max'=>100],
            [['file'], 'file','maxSize' => 2097152,  'skipOnEmpty' => true, 'maxFiles' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_post' => 'Id Post',
            'url' => 'Url',
        ];
    }
}
