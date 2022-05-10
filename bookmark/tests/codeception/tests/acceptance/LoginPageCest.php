<?php

class LoginPageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function pageLoads(AcceptanceTester $I)
    {
        # Action
        $I->amOnPage('/login');

        # Assertion
        $I->see('Login');
        $I->seeElement('#email');
    }

        /**
     *
     */
    public function userCanLogIn(AcceptanceTester $I)
    {
        # Action
        $I->amOnPage('/login');

        # Interact with form elements
        $I->fillField('[name=email]', 'jill@harvard.edu');
        $I->fillField('[name=password]', 'asdfasdf');
        $I->click('button');

        # Assert expected results
        $I->see('Jill Harvard');

        # Assert the existence of text within a specific element on the page
        $I->see('Logout', 'nav');
    }

    public function badCredentials(AcceptanceTester $I)
    {
        # Action
        $I->amOnPage('/login');

        # Interact with form elements
        $I->fillField('[name=email]', 'jill@harvard.edu');
        $I->fillField('[name=password]', 'badpass');
        $I->click('button');

        # Assert expected results
        $I->see('These credentials do not match our records.');
    }
}