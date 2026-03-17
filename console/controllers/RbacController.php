<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * Инициализация RBAC: создание ролей и разрешений
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); // очистка старых данных

        // Создаём разрешения
        $manageBooks = $auth->createPermission('manageBooks');
        $manageBooks->description = 'Управление книгами (добавление, редактирование, удаление)';
        $auth->add($manageBooks);

        $manageAuthors = $auth->createPermission('manageAuthors');
        $manageAuthors->description = 'Управление авторами (добавление, редактирование, удаление)';
        $auth->add($manageAuthors);

        // Создаём роль user
        $user = $auth->createRole('user');
        $auth->add($user);

        // Назначаем разрешения роли user
        $auth->addChild($user, $manageBooks);
        $auth->addChild($user, $manageAuthors);

        $this->stdout("RBAC успешно инициализирован.\n");
    }
}