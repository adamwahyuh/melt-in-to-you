<?php

namespace Tests\Feature;

use App\Models\Cup;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CupTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();
    }

    public function test_menambahkan_ke_cup(){
        $this->withoutMiddleware('');
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $user->peran()->sync([1,2,3]);

        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post(route('post.cup.store_to_cup'), [
            'product_id' => $product->id,
            'quantity' => 100,
        ]);

        $this->assertDatabaseHas('cups', [
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('cup_details', [
            'product_id' => $product->id,
            'quantity' => 100,
        ]);
    }

    public function test_hapus_item_dari_cup(){
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $user->peran()->sync([1,2,3]);

        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post(route('post.cup.store_to_cup'), [
            'product_id' => $product->id,
            'quantity' => 100,
        ]);

        $cup = Cup::with('details')->where('user_id', $user->id)->first();

        $cupDetail = $cup->details[0];

        $response = $this->delete(route('delete.cup.delete_cup_detail', $cupDetail->id));

        $response->assertRedirectBack();

    }

    public function test_memesan_dari_cup(){
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $user->peran()->sync([1,2,3]);

        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post(route('post.cup.store_to_cup'), [
            'product_id' => $product->id,
            'quantity' => 100,
        ]);

        $response->assertRedirectBack();

        $this->assertDatabaseHas('cups', [
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('cup_details', [
            'product_id' => $product->id,
            'quantity' => 100,
        ]);

        $cup = Cup::with('details')->where('user_id', $user->id)->first();

        $cupDetail = $cup->details[0];

        $response = $this->post(route('post.order.transfer_cup_to_order'));
    }
}
