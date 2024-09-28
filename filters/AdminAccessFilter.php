<?php

namespace app\filters;

use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class AdminAccessFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        // Check if the user is logged in and has the 'admin' role
        if (\Yii::$app->user->isGuest || \Yii::$app->user->identity->role !== 'admin') {
            // You can customize the error message
            throw new ForbiddenHttpException('You are not allowed to access this page.');
        }
        
        // If the user is an admin, allow the action to proceed
        return parent::beforeAction($action);
    }
}
