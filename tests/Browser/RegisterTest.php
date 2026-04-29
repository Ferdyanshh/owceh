<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     */
    public function testRegistrasi(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit('/register')
                ->type('name', 'Ocha')
                ->type('email', 'test@gmail.com')
                ->type('password', '12345678')
                ->type('password_confirmation', '12345678')
                ->press('Register')
                ->assertPathIs('/books')
                ->assertSee('Registrasi berhasil')
                ->assertSee('Daftar Buku');
        });
    }
}