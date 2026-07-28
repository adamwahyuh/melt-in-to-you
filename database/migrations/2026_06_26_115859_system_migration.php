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
            ['name' => 'Ice Cream Coklat', 'deskripsi' => 'Es krim coklat premium dengan rasa manis yang lembut.', 'harga' => 5000],
            ['name' => 'Ice Cream Vanila', 'deskripsi' => 'Es krim vanila klasik dengan aroma yang harum.', 'harga' => 5500],
            ['name' => 'Ice Cream Stroberi', 'deskripsi' => 'Es krim stroberi segar dengan rasa buah asli.', 'harga' => 6000],
            ['name' => 'Ice Cream Matcha', 'deskripsi' => 'Es krim matcha dengan cita rasa teh hijau Jepang.', 'harga' => 7000],
            ['name' => 'Ice Cream Oreo', 'deskripsi' => 'Es krim lembut dengan taburan biskuit Oreo.', 'harga' => 6500],
            ['name' => 'Ice Cream Tiramisu', 'deskripsi' => 'Es krim tiramisu dengan sentuhan kopi yang nikmat.', 'harga' => 8000],
            ['name' => 'Ice Cream Mint', 'deskripsi' => 'Es krim mint yang menyegarkan di setiap gigitan.', 'harga' => 7000],
            ['name' => 'Ice Cream Blueberry', 'deskripsi' => 'Es krim blueberry dengan perpaduan manis dan asam.', 'harga' => 7500],
            ['name' => 'Ice Cream Karamel', 'deskripsi' => 'Es krim karamel dengan rasa yang kaya.', 'harga' => 7500],
            ['name' => 'Ice Cream Durian', 'deskripsi' => 'Es krim durian dengan aroma khas yang menggoda.', 'harga' => 9000],
            ['name' => 'Ice Cream Mangga', 'deskripsi' => 'Es krim mangga dari buah mangga pilihan.', 'harga' => 6500],
            ['name' => 'Ice Cream Alpukat', 'deskripsi' => 'Es krim alpukat yang lembut dan creamy.', 'harga' => 7000],
            ['name' => 'Ice Cream Kopi', 'deskripsi' => 'Es krim kopi dengan aroma robusta yang kuat.', 'harga' => 7500],
            ['name' => 'Ice Cream Hazelnut', 'deskripsi' => 'Es krim hazelnut dengan rasa kacang premium.', 'harga' => 8500],
            ['name' => 'Ice Cream Pistachio', 'deskripsi' => 'Es krim pistachio dengan cita rasa khas.', 'harga' => 9000],
            ['name' => 'Ice Cream Lemon', 'deskripsi' => 'Es krim lemon yang segar dan sedikit asam.', 'harga' => 6500],
            ['name' => 'Ice Cream Kelapa', 'deskripsi' => 'Es krim kelapa dengan rasa tropis.', 'harga' => 6000],
            ['name' => 'Ice Cream Red Velvet', 'deskripsi' => 'Es krim red velvet dengan rasa yang unik.', 'harga' => 8500],
            ['name' => 'Ice Cream Bubble Gum', 'deskripsi' => 'Es krim bubble gum favorit anak-anak.', 'harga' => 7000],
            ['name' => 'Ice Cream Cookies', 'deskripsi' => 'Es krim dengan potongan cookies renyah.', 'harga' => 7500],
            ['name' => 'Ice Cream Mocha', 'deskripsi' => 'Es krim perpaduan kopi dan coklat.', 'harga' => 8000],
            ['name' => 'Ice Cream Lychee', 'deskripsi' => 'Es krim leci dengan rasa buah yang segar.', 'harga' => 7000],
            ['name' => 'Ice Cream Anggur', 'deskripsi' => 'Es krim anggur dengan aroma yang manis.', 'harga' => 6500],
            ['name' => 'Ice Cream Melon', 'deskripsi' => 'Es krim melon yang menyegarkan.', 'harga' => 6500],
            ['name' => 'Ice Cream Semangka', 'deskripsi' => 'Es krim semangka dengan rasa buah alami.', 'harga' => 6000],
            ['name' => 'Ice Cream Kiwi', 'deskripsi' => 'Es krim kiwi dengan sensasi asam manis.', 'harga' => 7500],
            ['name' => 'Ice Cream Raspberry', 'deskripsi' => 'Es krim raspberry dengan rasa buah premium.', 'harga' => 8500],
            ['name' => 'Ice Cream Blackcurrant', 'deskripsi' => 'Es krim blackcurrant yang kaya rasa.', 'harga' => 8500],
            ['name' => 'Ice Cream Cheese', 'deskripsi' => 'Es krim keju dengan tekstur lembut.', 'harga' => 8000],
            ['name' => 'Ice Cream Salted Caramel', 'deskripsi' => 'Es krim salted caramel dengan perpaduan manis dan gurih.', 'harga' => 9000],
        ];

        foreach ($products as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'deskripsi' => $item['deskripsi'],
                'foto' => 'images/products/coklat.jpeg',
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
