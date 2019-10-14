<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property int $id
 * @property int $id_post
 * @property int $id_usuario
 * @property string $contenido
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_post', 'id_usuario', 'contenido'], 'required'],
            [['id_post', 'id_usuario'], 'integer'],
            [['contenido'], 'string', 'max' => 256],
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
            'id_usuario' => 'Id Usuario',
            'contenido' => 'Contenido',
        ];
    }
}
