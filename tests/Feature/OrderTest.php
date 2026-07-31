<?php

namespace Tests\Feature;

use App\Models\Cup;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_menandai_sedang_diproses(){
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $user->peran()->sync([1,2,3]);

        $this->actingAs($user);

        $product = Product::factory()->create();

        $order = Order::factory()->create(['user_id' => $user->id, 'address_id' => $user->activeAddress->id]);

        $response = $this->put(route('put.dashboard.kasir.order.tandai_diproses', $order->id));

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'diproses_pada' => now(),
        ]);
    }

    public function test_menandai_sedang_dikirim(){
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $user->peran()->sync([1,2,3]);

        $this->actingAs($user);

        $product = Product::factory()->create();

        $order = Order::factory()->create(['user_id' => $user->id,'address_id' => $user->activeAddress->id]);

        $response = $this->put(route('put.dashboard.kasir.order.tandai_dikirim', $order->id));

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'dikirim_pada' => now(),
        ]);
    }
    public function test_menandai_order_selesai(){
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $user->peran()->sync([1,2,3]);

        $this->actingAs($user);

        $product = Product::factory()->create();

        $order = Order::factory()->create([
            'user_id' => $user->id,
            'dipesan_pada' => now(),
            'dikirim_pada'=> now(),
            'diproses_pada' => now(),
            'address_id' => $user->activeAddress->id
        ]);

        $response = $this->put(route('put.order.tandai_selesai', $order->id));

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'diterima_pada' => now(),
        ]);
    }
}
