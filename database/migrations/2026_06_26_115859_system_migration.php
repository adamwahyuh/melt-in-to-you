<?php

use App\Models\Peran;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedSmallInteger('rt');
            $table->unsignedSmallInteger('rw');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('alamat');
            $table->string('kode_pos');

            $table->boolean('is_active')->default(false);

            $table->timestamps();

            // rt rw kecamatan kota alamat kelurahan kode pos
        });
        Schema::create('peran', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('peran_users', function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('peran_id')->constrained('peran');
            $table->timestamps();
        });

        $roles = ['kasir', 'stocker', 'owner'];

        foreach($roles as $role){
            Peran::create([
                'name' => $role
            ]);
        }

        Schema::create('products', function(Blueprint $table){
            $table->ulid('id')->primary();
            $table->string('name');
            $table->string('foto')->nullable();
            $table->boolean('is_default')->nullable()->default(false);
            $table->string('deskripsi');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_prices', function(Blueprint $table){
            $table->id();

            $table->foreignUlid('product_id')->constrained('products');
            $table->unsignedMediumInteger('harga_dalam_rupiah');

            $table->timestamps();
        });

        Schema::create('cups', function(Blueprint $table){
            $table->ulid('id')->primary();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });

        Schema::create('cup_details', function(Blueprint $table){
            $table->id();

            $table->foreignUlid('cup_id')->constrained('cups');
            $table->foreignUlid('product_id')->constrained('products');
            
            $table->unsignedBigInteger('quantity')->default(1);
            $table->timestamps();
        });

        Schema::create('orders', function(Blueprint $table){
            $table->ulid('id')->primary();
            $table->foreignId('user_id')->constrained('users');

            $table->timestamp('dipesan_pada')->nullable();
            $table->timestamp('diproses_pada')->nullable();
            $table->timestamp('dikirim_pada')->nullable();
            $table->timestamp('diterima_pada')->nullable();

            $table->foreignId('address_id')->constrained('addresses');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('order_details', function(Blueprint $table){
            $table->id();

            $table->foreignUlid('order_id')->constrained('orders');
            $table->foreignUlid('product_id')->constrained('products');

            $table->unsignedBigInteger('quantity')->default(1);
            $table->unsignedBigInteger('harga_dalam_rupiah');

            $table->timestamps();
        });

        $semuaPeran = Peran::pluck('id')->toArray();
        $user = User::where('username', 'adam')->first();
        $user->peran()->sync($semuaPeran);

        $products = [
            [
                'name' => 'Ice Cream Coklat',
                'deskripsi' => 'Es krim coklat premium dengan rasa coklat yang kaya dan lembut.',
                'harga' => 1000,
                'image' => 'images/products/chocolate.jpg'
            ],
            [
                'name' => 'Ice Cream Vanila',
                'deskripsi' => 'Es krim vanila klasik dengan aroma vanila yang harum dan lembut.',
                'harga' => 1000,
                'image' => 'images/products/vanila.jpg'
            ],
            [
                'name' => 'Ice Cream Stroberi',
                'deskripsi' => 'Es krim stroberi dengan rasa buah yang segar dan manis.',
                'harga' => 1000,
                'image' => 'images/products/strowberry.jpg'
            ],
            [
                'name' => 'Ice Cream Matcha',
                'deskripsi' => 'Es krim matcha dengan cita rasa teh hijau khas Jepang.',
                'harga' => 1000,
                'image' => 'images/products/matcha.jpg'
            ],
            [
                'name' => 'Ice Cream Stowberry',
                'deskripsi' => 'Es krim stroberi yang lembut dengan rasa manis yang menyegarkan.',
                'harga' => 1000,
                'image' => 'images/products/strowberry.jpg'
            ],
            [
                'name' => 'Ice Cream Durian',
                'deskripsi' => 'Es krim durian dengan aroma khas dan rasa yang creamy.',
                'harga' => 1000,
                'image' => 'images/products/durian.jpg'
            ],
            [
                'name' => 'Ice Cream Greentea',
                'deskripsi' => 'Es krim greentea dengan perpaduan rasa teh hijau yang autentik.',
                'harga' => 1000,
                'image' => 'images/products/greentea.jpg'
            ],
            [
                'name' => 'Ice Cream Blueberry',
                'deskripsi' => 'Es krim blueberry dengan perpaduan rasa manis dan sedikit asam.',
                'harga' => 1000,
                'image' => 'images/products/blue-berry.jpg'
            ],
            [
                'name' => 'Ice Cream Kelapa',
                'deskripsi' => 'Es krim kelapa dengan rasa gurih, manis, dan aroma kelapa segar.',
                'harga' => 1000,
                'image' => 'images/products/kelapa.jpg'
            ],
            [
                'name' => '4 Ice Cream Matcha Chocolate Vanila Stowberry',
                'deskripsi' => 'Paket berisi empat varian es krim: Matcha, Chocolate, Vanila, dan Stroberi.',
                'harga' => 8000,
                'image' => 'images/products/4-m-c-v.jpg'
            ],
        ];

        foreach ($products as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'deskripsi' => $item['deskripsi'],
                'foto' => $item['image'],
                'is_default' => true,
            ]);

            $product->prices()->create([
                'harga_dalam_rupiah' => $item['harga'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('cup_details');
        Schema::dropIfExists('cups');
        Schema::dropIfExists('product_prices');
        Schema::dropIfExists('products');
    }
};
