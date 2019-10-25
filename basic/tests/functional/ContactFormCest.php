<?php

class ContactFormCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site/contact']);
    }

    public function openContactPage(\FunctionalTester $I)
    {
        $I->see('Contact', 'h1');        
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('#contact-form', []);
        $I->expectTo('see validations errors');
        $I->see('Contact', 'h1');
        $I->see('Nombre no puede estar en blanco.');
        $I->see('Correo no puede estar en blanco.');
        $I->see('Asunto no puede estar en blanco.');
        $I->see('El mensaje no puede estar en blanco.');
        $I->see('El codigo de berigficacion es incorrecto.');
    }

    public function submitFormWithIncorrectEmail(\FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester.email',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->expectTo('see that email address is wrong');
        $I->dontSee('Nombre no puede estar en blanco', '.help-inline');
        $I->see('El correo no es valido por favor esribe uno valido.');
        $I->dontSee('Asunto no puede estar en blanco', '.help-inline');
        $I->dontSee('Mensaje no puede estar en blanco', '.help-inline');
        $I->dontSee('El codigo de verificacion es incorrecto', '.help-inline');        
    }

    public function submitFormSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->seeEmailIsSent();
        $I->dontSeeElement('#contact-form');
        $I->see('Thank you for contacting us. We will respond to you as soon as possible.');        
    }
}
