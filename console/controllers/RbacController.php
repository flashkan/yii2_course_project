<?php


namespace console\controllers;
use common\models\User;
use yii\console\Controller;
class RbacController extends Controller
{
    /**
     * @throws \Exception
     */
    public function actionInit()
    {
        $role = \Yii::$app->authManager->createRole('admin');
        $role->description = 'admin';
        \Yii::$app->authManager->add($role);
        $role = \Yii::$app->authManager->createRole('simple');
        $role->description = 'simple';
        \Yii::$app->authManager->add($role);
        $permission = \Yii::$app->authManager->createPermission('getMyActivity');
        \Yii::$app->authManager->add($permission);
    }
    /**
     * @throws \yii\base\Exception
     */
    public function actionAddAdmin()
    {
        $model = User::find()->where(['username' => 'admin'])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = 'admin';
            $user->email = 'admin@admin.ru';
            $user->setPassword('admin');
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'good';
            }
        }
        $adminRole = \Yii::$app->authManager->getRole('admin');
        \Yii::$app->authManager->assign($adminRole, $user->id);
    }
}