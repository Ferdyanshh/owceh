<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class ReadTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testLihatDetailBuku(): void 
    {
        $this->seed(\Database\Seeders\BookSeeder::class);
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/books')
                ->clickLink('Detail') 
                ->assertSee('Laravel Testing Handbook') 
                ->assertSee('Dimas Pratama');
        });
    }
}