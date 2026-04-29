<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class UpdateTest extends DuskTestCase
{
    use DatabaseMigrations;
    public function testUpdatePenulisNegatif(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/books')
                ->clickLink('Tambah Buku')
                ->type('title', 'Buku Untuk Diupdate')
                ->type('author', 'Penulis Asli')
                ->select('category', 'Teknologi')
                ->type('published_year', '2023')
                ->type('stock', '10')
                ->type('summary', 'Ringkasan Buku Baru')
                ->press('Simpan Buku')
                ->assertSee('Buku berhasil ditambahkan.')
                ->clickLink('Edit Buku')
                ->pause(1000)
                ->type('author', 'Penulis 123')
                ->press('Perbarui Buku') 
                ->pause(1000)
                ->assertSee('Penulis tidak boleh mengandung angka.')
                ->visit('/books')
                ->assertSee('Penulis Asli') 
                ->assertDontSee('Penulis 123'); 
        });
    }
}