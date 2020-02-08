<?php


namespace backend\components;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\web\Application;

class CheckIfLoggedIn extends Behavior
{
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'changeLanguage',
        ];
    }

    public function checkIfLoggedIn() {
        if (\Yii::$app->user->isGuest) {
            echo 'You are a guest';
        } else {
            echo  'You are logged in';
        }
    }

    public function changeLanguage() {
        if (\Yii::$app->getRequest()->getCookies()->has('lang')) {
            \Yii::$app->language = \Yii::$app->getRequest()->getCookies()->getValue('lang');
        }
    }

}