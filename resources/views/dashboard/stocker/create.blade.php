<x-dlayout title="Tambah Produk Baru">
    <div class="">

        <!-- Card Utama -->
        <div class="rounded-2xl overflow-hidden">

            <!-- Card Header -->
            <div class="px-8 py-5">
                <h2 class="text-xl font-bold text-gray-800">Tambah Data Produk</h2>
                <p class="text-sm text-gray-500 mt-1">Isi informasi, foto, dan harga awal untuk produk baru.</p>
            </div>

            <div class="max-w-3xl">
                <form action="{{ route('post.product.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                    @csrf

                    <!-- Input Teks -->
                    <div class="space-y-5">
                        <x-form.input name="name" value="{{ old('name') }}" label="Nama Produk" />
                        <x-form.input name="deskripsi" value="{{ old('deskripsi') }}" label="Deskripsi Produk" />
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
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Produk</label>
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

                        <!-- Preview Foto -->
                        <div id="preview-container" class="bg-blue-50/50 p-4 rounded-xl border border-blue-200 hidden transition-all duration-300 max-w-xs">
                            <label class="block text-sm font-semibold text-blue-700 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Preview Foto
                            </label>
                            <div class="relative w-full aspect-[4/3] rounded-lg overflow-hidden bg-white border border-blue-200 shadow-inner">
                                <img id="foto-preview" src="#" alt="Preview" class="object-cover w-full h-full">
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    <!-- Harga Awal -->
                    <div class="space-y-5">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Harga Produk</h3>
                            <p class="text-sm text-gray-500 mb-4">Masukkan harga awal produk ini.</p>
                        </div>
                        <x-form.input name="harga" value="{{ old('harga') }}" label="Harga (Rp)" type="number" />
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                        <button type="button" onclick="history.back()" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-gray-100 transition-colors">
                            Kembali
                        </button>
                        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-colors shadow-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Produk
                        </button>
                    </div>
                </form>
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