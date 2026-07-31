<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_membuat_product_baru(){
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $user->peran()->sync([1,2,3]);

        $this->actingAs($user);

        $response = $this->post(route('post.product.store'), [
            'name' => 'Es Coklat Manis',
            'deskripsi' => 'Es coklat enak',
            'foto' => UploadedFile::fake()->image('coklat.png'),
            'harga' => 1000,
        ]);

        $response->assertRedirect(route('page.dashboard.stocker.index'));
        
    }

    public function test_delete_product(){
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $user->peran()->sync([1,2,3]);

        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->delete(route('delete.product.delete', $product->id));

        $response->assertRedirectBack();

        $this->assertSoftDeleted('products', [
            'name' => $product->name,
        ]);
    }

    public function test_update_product(){
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $user->peran()->sync([1,2,3]);

        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->put(route('put.product.update', $product->id), [
            'name' => 'Es Coklat Manis',
            'deskripsi' => 'Es coklat enak',
            'foto' => UploadedFile::fake()->image('coklat.png'),
        ]);

        $response->assertRedirectBack();

        $this->assertDatabaseHas('products', [
            'name' => 'Es Coklat Manis',
            'deskripsi' => 'Es coklat enak',
        ]);
    }

    public function test_update_harga(){
        $user = User::factory()->create([
            'username' => 'dara',
            'password' => Hash::make('password'),
        ]);

        $user->peran()->sync([1,2,3]);

        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post(route('post.product.update_price', $product->id), [
            'harga' => 4000,
        ]);

        $response->assertRedirectBack();

        $this->assertDatabaseHas('product_prices', [
            'product_id' => $product->id,
            'harga_dalam_rupiah' => 4000
        ]);
    }
}
