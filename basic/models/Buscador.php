<?php

namespace app\models;
use Yii;
use yii\base\model;


class Buscador extends model{
 
    public $tag;
    public $pregunta;
    public $categoria;
 
    public function  rules()
    {
        return [
            [['categoria','tag','pregunta'],'my_manejador', 'skipOnEmpty' => false, 'skipOnError' => false],
        ];
    }


    public function my_manejador($attribute, $params)

    {

        if ($this->tag =="" && $this->pregunta =="" && $this->categoria =="") {

            $this->addError( $attribute, ('Por favor completa al menos un campo'));
        }

    }
    
}