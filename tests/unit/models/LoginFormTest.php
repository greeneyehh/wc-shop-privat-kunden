<?php

namespace tests\unit\models;

use app\models\KundenloginForm;

class LoginFormTest extends \Codeception\Test\Unit
{
    private $model;

    protected function _after()
    {
        \Yii::$app->user->logout();
    }

    public function testLoginNoUser()
    {
        $this->model = new KundenloginForm([
            'personal_email' => 'not_existing_username',
            'personal_password' => 'not_existing_password',
        ]);

        expect_not($this->model->login());
        expect_that(\Yii::$app->user->isGuest);
    }

    public function testLoginWrongPassword()
    {
        $this->model = new KundenloginForm([
            'personal_email' => 'green_eye@chillaz.org',
            'personal_password' => 'asdsad',
        ]);

        expect_not($this->model->login());
        expect_that(\Yii::$app->user->isGuest);
        expect($this->model->errors)->hasKey('personal_password');
    }

    public function testLoginCorrect()
    {
        $this->model = new KundenloginForm([
            'personal_email' => 'green_eye@chillaz.org',
            'personal_password' => 'personal_passwordConfirmation',
        ]);

        expect_that($this->model->login());
        expect_not(\Yii::$app->user->isGuest);
        expect($this->model->errors)->hasntKey('personal_password');
    }

}
