<?php

namespace Tests\Unit;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_application_redirects_guests_to_the_login_page(): void
    {
        $this->get('/')
            ->assertRedirect(route('login'));
    }
}