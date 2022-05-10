<?php

class RegisterPageCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/test/refresh-database');
    }

    // tests
    public function register(AcceptanceTester $I)
    {
        $I->amOnPage('/register');
        $I->fillField('#name', 'Mel');
        $I->fillField('#email','mel@harvard.edu');
        $I->fillField('#password', 'asdfasdf');
        $I->fillField('#password-confirm', 'asdfasdf');
        $I->click('button');
        $I->see('Hello Mel!');
        $I->click("#logout");
    }

    public function registerInvalid(AcceptanceTester $I)
    {
        $I->amOnPage('/register');
        $I->fillField('#name', 'Mel');
        $I->click('button');
        $I->see('The email field is required.');
    }
}