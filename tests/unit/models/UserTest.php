<?php

namespace tests\unit\models;

use app\models\Account;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = Account::findIdentity(1000));
        expect($user->personal_email)->equals('green_eye@chillaz.org');

        expect_not(Account::findIdentity(999));
    }

    public function testFindUserByAccessToken()
    {
        expect_that($user = Account::findIdentityByAccessToken('8-fuCJQbl3DrnyH6uftx73Iqtc2zpY05xrNJQhrvoz_qSCpK89R4AC-MQncJfbum-eLWdkxVvWUewZMfeu_2aOJFDuSDAbfViHD0Ijz47Z3HfR0RfHEXnoYR'));
        expect($user->personal_email)->equals('green_eye@chillaz.org');

        expect_not(Account::findIdentityByAccessToken('non-existing'));        
    }

    public function testFindUserByUsername()
    {
        expect_that($user = Account::findByUsername('green_eye@chillaz.org'));
        expect_not(Account::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = Account::findByUsername('green_eye@chillaz.org');
        expect_that($user->validateAuthKey('cvd-WzNU6a5P3ZRKQvfwLBXvfa0ML2-cwincmJR_xvAExwcY8b9PeEw-EJ1gvws7RvDMu9vqw4Uci9LbqN2sKQKv3RFEQTZsRYXCt1OUYTy-z1GRzzUp1LVW'));
        expect_not($user->validateAuthKey('test102key'));
        expect_that($user->validatePassword('personal_passwordConfirmation'));
        expect_not($user->validatePassword('123456'));        
    }

}
