<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    public function test_registrasi_user(){

        $response = $this->post(route('post.register'), [
            'name' => 'Dara',
            'username' => 'dara',
            'email' => 'dara@dara.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('login'));
    }

    public function test_user_login(){
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post(route('post.login'), [
            'username' => 'dara',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('page.address.create', $user->username));
    }

    public function test_user_logout(){
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $this->actingAs($user);

        $response = $this->post(route('post.logout'));

        $response->assertRedirect(route('login'));
    }

    public function test_admin_login(){
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $user->peran()->sync([1]);

        $response = $this->post(route('post.login'), [
            'username' => 'dara',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('page.dashboard.index'));

    }
}
