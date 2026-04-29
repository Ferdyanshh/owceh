<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class DeleteTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testSuccessfulDeleteBook(): void
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/books')
                ->clickLink('Tambah Buku')
                ->type('title', 'Buku Untuk Dihapus')
                ->type('author', 'Penulis Sementara')
                ->select('category', 'Teknologi')
                ->type('published_year', '2024')
                ->type('stock', '5')
                ->type('summary', 'Ini buku yang akan jadi korban.')
                ->press('Simpan Buku')
                ->assertSee('Buku berhasil ditambahkan.')
                ->clickLink('Kembali')
                ->assertSee('Buku Untuk Dihapus')
                ->click('td form button')
                ->waitForDialog()
                ->acceptDialog()
                ->pause(1000)
                ->assertSee('Buku berhasil dihapus.')
                ->assertDontSee('Buku Untuk Dihapus');
        });
    }
}