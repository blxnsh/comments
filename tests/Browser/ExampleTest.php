<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->maximize()
                    ->assertSee('Коментарии')
                    ->value('#comment-form', 'ffs')
                    ->click('@comment-add-0')
                    ->pause(1000)
                    ->assertSee('ffs');
        });
    }
}
