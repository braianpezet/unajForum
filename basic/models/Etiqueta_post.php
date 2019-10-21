<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "etiqueta_post".
 *
 * @property int $id_etiqueta
 * @property int $id_post
 *
 * @property Etiqueta $etiqueta
 * @property Post $post
 */
class Etiqueta_post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'etiqueta_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_etiqueta', 'id_post'], 'required'],
            [['id_etiqueta', 'id_post'], 'integer'],
            [['id_etiqueta'], 'exist', 'skipOnError' => true, 'targetClass' => Etiqueta::className(), 'targetAttribute' => ['id_etiqueta' => 'id']],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['id_post' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_etiqueta' => 'Id Etiqueta',
            'id_post' => 'Id Post',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtiqueta()
    {
        return $this->hasOne(Etiqueta::className(), ['id' => 'id_etiqueta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'id_post']);
    }
}
