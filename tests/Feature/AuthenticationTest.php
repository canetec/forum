<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function test_a_user_can_log_in_with_valid_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('correct horse battery staple'),
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'correct horse battery staple',
        ])->assertRedirect(RouteServiceProvider::HOME);

        $this->assertAuthenticatedAs($user);
    }

    public function test_a_user_can_log_out()
    {
        $user = factory(User::class)->create();

        $this->be($user);

        $this->post(route('logout'));

        $this->assertGuest();
    }

    public function test_a_user_can_not_log_in_with_invalid_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('correct horse battery staple'),
        ]);

        $this->assertInvalidCredentials([
            'email' => $user->email,
            'password' => 'correct mule battery staple',
        ]);
    }

    public function test_a_user_can_register()
    {
        $this->post(route('register'), [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'correct horse battery staple',
            'password_confirmation' => 'correct horse battery staple',
        ]);

        $this->assertSame(1, User::count());
    }
}
