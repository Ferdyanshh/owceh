<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     */
    public function testcreate(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/books')
                    ->clickLink('Tambah Buku')
                    ->assertPathIs('/books/create')
                    ->assertSee('Daftar Buku')
                    ->type('title', 'Buku Baru')
                    ->type('author', 'Penulis Baru')
                    ->select('category', 'Novel')
                    ->type('published_year', '2023')
                    ->type('stock', '10')
                    ->type('summary', 'Ringkasan Buku Baru')
                    ->press('Simpan Buku')
                    ->assertSee('Buku berhasil ditambahkan.')
                    ->assertSee('Buku Baru');
        });
    }
}