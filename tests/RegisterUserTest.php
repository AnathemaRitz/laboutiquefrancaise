<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterUserTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $client->request('GET', '/inscription');
        $client->submitForm('Valider', [
            'register_user[email]'=> "mail4@mail.com",
            'register_user[plainPassword][first]'=> '1234',
            'register_user[plainPassword][second]' =>'1234',
            'register_user[firstname]'=> 'Luke',
            'register_user[lastname]' => 'Cage'
        ]);
        $this->assertResponseRedirects('/connexion');
        $client->followRedirect();
        
        $this->assertSelectorExists('div:contains("Votre compte a bien été créé. Vous pouvez vous connecter.")');
    }
}
