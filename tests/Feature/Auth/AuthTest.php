<?php

it(' can display the login form',function(){

    $response = $this->get('admin/login');
    $response->assertSee('Se connecter');
    $response->assertSeeInOrder(['<form', 'Email', 'Mot de passe', '<button', 'Se connecter'], true);
});
