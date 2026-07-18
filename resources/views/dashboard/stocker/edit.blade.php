<x-dlayout title="Edit Produk - {{ $product->name }}"> 
    <div class="">
        
        <!-- Card Utama -->
        <div class="rounded-2xl overflow-hidden">
            
            <!-- Card Header -->
            <div class="px-8 py-5">
                <h2 class="text-xl font-bold text-gray-800">Edit Data Produk</h2>
                <p class="text-sm text-gray-500 mt-1">Perbarui informasi, foto, dan harga produk <span class="font-semibold text-gray-700">{{ $product->name }}</span>.</p>
            </div>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-gray-100">
                
                <!-- KOLOM KIRI: Form Edit Produk (Lebar 7 Kolom) -->
                <div class="lg:col-span-7">
                    <form action="{{ route('put.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                        @csrf
                        @method('PUT')
                        
                        <!-- Input Teks -->
                        <div class="space-y-5">
                            <x-form.input name="name" value="{{ $product->name }}" label="Nama Produk" />
                            <x-form.input name="deskripsi" value="{{ $product->deskripsi }}" label="Deskripsi Produk" />
                        </div>

                        <hr class="border-gray-100">

                        <!-- Manajemen Foto -->
                        <div class="space-y-5">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Foto Produk</h3>
                                <p class="text-sm text-gray-500 mb-4">Format didukung: JPG, JPEG, PNG.</p>
                            </div>
                            
                            <!-- Input Upload -->
                            <div>
                                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Baru (Opsional)</label>
                                <input type="file" name="foto" id="foto" accept=".png, .jpg, .jpeg" 
                                    class="block w-full text-sm text-gray-600
                                    file:mr-4 file:py-2.5 file:px-4
                                    file:rounded-lg file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100
                                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                    transition-all cursor-pointer border border-gray-300 rounded-lg bg-gray-50"
                                    onchange="previewImage(event)">
                                
                                @error('foto')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Grid Perbandingan Foto -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                                <!-- Foto Saat Ini -->
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Foto Saat Ini
                                    </label>
                                    <div class="relative w-full aspect-[4/3] rounded-lg overflow-hidden bg-white border border-gray-200 shadow-inner flex items-center justify-center">
                                        @if($product->foto)
                                            <img src="{{ $product->foto_url }}" alt="Foto {{ $product->name }}" class="object-cover w-full h-full">
                                        @else
                                            <div class="text-center text-gray-400">
                                                <svg class="mx-auto h-8 w-8 mb-1 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                <p class="text-xs">Belum ada foto.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Preview Foto Baru -->
                                <div id="preview-container" class="bg-blue-50/50 p-4 rounded-xl border border-blue-200 hidden transition-all duration-300">
                                    <label class="block text-sm font-semibold text-blue-700 mb-3 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Preview Baru
                                    </label>
                                    <div class="relative w-full aspect-[4/3] rounded-lg overflow-hidden bg-white border border-blue-200 shadow-inner">
                                        <img id="foto-preview" src="#" alt="Preview" class="object-cover w-full h-full">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit Produk -->
                        <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                            <button type="button" onclick="history.back()" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-gray-100 transition-colors">
                                Kembali
                            </button>
                            <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-colors shadow-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>

                <!-- KOLOM KANAN: Manajemen Harga (Lebar 5 Kolom) -->
                <div class="lg:col-span-5 bg-gray-50/30 p-8 space-y-8">
                    
                    <!-- Form Update Harga -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                        <div class="mb-5 border-b border-gray-100 pb-4">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Update Harga
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">Sesuaikan harga produk saat ini.</p>
                        </div>

                        <form action="{{ route('post.product.update_price', $product->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <x-form.input value="{{ $product->current_price }}" name="harga" label="Harga Baru (Rp)" type="number" />
                            
                            <button type="submit" class="w-full justify-center px-4 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 transition-colors shadow-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Perbarui Harga
                            </button>
                        </form>
                    </div>

                    <!-- Riwayat Harga -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                        <h3 class="text-base font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Riwayat Harga
                        </h3>
                        
                        <div class="space-y-3 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
                            {{-- Catatan: Menggunakan sortByDesc agar tidak error collection laravel --}}
                            @forelse ($product->prices->sortByDesc('created_at') as $price)
                                <div class="flex justify-between items-center p-3 rounded-lg border border-gray-100 bg-gray-50/50 hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                        <p class="font-bold text-gray-800">{{ $price->harga_dalam_rupiah }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs font-medium text-gray-500">{{ $price->created_at->format('d M Y') }}</p>
                                        <p class="text-xs text-gray-400">{{ $price->created_at->format('H:i') }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 px-4 border-2 border-dashed border-gray-200 rounded-lg">
                                    <p class="text-sm text-gray-500">Belum ada riwayat perubahan harga.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Script Preview Gambar -->
    <script>
        function previewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('foto-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    previewContainer.classList.add('block');
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.classList.add('hidden');
                previewContainer.classList.remove('block');
                previewImage.src = "#";
            }
        }
    </script>
</x-dlayout>