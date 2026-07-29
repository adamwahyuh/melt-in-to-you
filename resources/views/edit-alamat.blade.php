<x-layout title="Alamat Edit">
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Card Container -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
            
            <!-- Header Section -->
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                <h2 class="text-xl font-bold text-gray-800">Detail Alamat</h2>
                <p class="text-sm text-gray-500 mt-1">Silakan lengkapi informasi alamat pengiriman di bawah ini.</p>
            </div>

            <!-- Form Section -->
            <div class="p-6 sm:p-8">
                <form action="{{ route('put.address.update', Auth::id()) }}" method="POST" class="space-y-6">
                    @method('PUT')
                    @csrf
                    <!-- Grid untuk field pendek (RT & RW) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <x-form.input value="{{ $address->rt }}" type="number" name="rt" label="RT" class="w-full" />
                        <x-form.input value="{{ $address->rw }}" type="number" name="rw" label="RW" class="w-full" />
                    </div>

                    <!-- Grid untuk wilayah administratif -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <x-form.input value="{{ $address->kelurahan }}" name="kelurahan" label="Kelurahan / Desa" class="w-full" />
                        <x-form.input value="{{ $address->kecamatan }}" name="kecamatan" label="Kecamatan" class="w-full" />
                    </div>

                    <!-- Grid untuk Kota dan Kode Pos -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <x-form.input value="{{ $address->kota }}" name="kota" label="Kota / Kabupaten" class="w-full" />
                        <x-form.input value="{{ $address->kode_pos }}" name="kode_pos" label="Kode Pos" class="w-full" />
                    </div>

                    <!-- Full width untuk address lengkap -->
                    <div>
                        <x-form.input value="{{ $address->alamat }}" name="alamat" label="Alamat Lengkap (Nama Jalan, Gedung, No. Rumah)" class="w-full" />
                    </div>

                    <!-- Action Button -->
                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition-all duration-200 ease-in-out">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                            </svg>
                            Simpan Alamat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>