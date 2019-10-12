<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subcategoria".
 *
 * @property int $id
 * @property int $id_categoria
 * @property string $contenido
 * @property string $dec_contenido
 *
 * @property Categoria $categoria
 */
class Subcategoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subcategoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categoria', 'contenido', 'dec_contenido'], 'required'],
            [['id_categoria'], 'integer'],
            [['contenido'], 'string', 'max' => 250],
            [['dec_contenido'], 'string', 'max' => 50],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['id_categoria' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_categoria' => 'Id Categoria',
            'contenido' => 'Contenido',
            'dec_contenido' => 'Dec Contenido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'id_categoria']);
    }
}
