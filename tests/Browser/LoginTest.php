<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations; 

    public function testLogin(): void
    {

        User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $this->browse(function (Browser $browser) :void {
            $browser->visit('/login')
                    ->type('email', 'test@example.com')
                    ->type('password', '12345678')
                    ->press('Login')
                    ->assertPathIs('/books')
                    ->assertSee('Login berhasil.')
                    ->assertSee('Daftar Buku');
        });
    }
}