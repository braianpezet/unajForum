<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $id_subcategoria
 * @property string $nombre
 * @property string $contenido
 * @property string $des_corta
 *
 * @property Subcategoria $subcategoria
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_subcategoria', 'nombre', 'contenido','des_corta'], 'required'],
            [['id_subcategoria'], 'integer'],
            [['nombre', 'contenido','des_corta'], 'string', 'max' => 256],
            [['id_subcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategoria::className(), 'targetAttribute' => ['id_subcategoria' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_subcategoria' => 'Id Subcategoria',
            'nombre' => 'Nombre',
            'contenido' => 'Contenido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategoria()
    {
        return $this->hasOne(Subcategoria::className(), ['id' => 'id_subcategoria']);
    }
}
