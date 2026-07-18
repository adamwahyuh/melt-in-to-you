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

        $product = Product::create([
            'name' => 'Ice Cream Coklat',
            'deskripsi' => 'Dengan coklat premium manis sepanjang hari',
            'foto' =>  'images/products/coklat.jpeg',
            'is_default' => true,
        ]);

        $product->prices()->create(['harga_dalam_rupiah' => 5000]);
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
