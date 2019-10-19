<?php

namespace app\models;

use Yii;
use yii\base\InvalidParamException;
use yii\base\model;
use app\models\User;
 
/**
 * Change password form for current user only
 */
class FormPostFoto extends Model
{
    public $file;
    public $profile_picture;
    /**
     * @var app\models\User
     */
    public $_user;
 
    /**
     * Creates a form model given a token.
     *
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['profile_picture','string','max'=>100],
            [['file'], 'file','maxSize' => 2097152,  'skipOnEmpty' => true, 'extensions' => 'png, jpg' ,],
        ];
    }

   
    public function attributeLabels()
    {
        return [
            'file' => 'profile_picture',
        ];
    }
}
