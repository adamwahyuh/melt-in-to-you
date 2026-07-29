<x-layout title="Profil - {{ $user->name }}">
    <div class="mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <!-- Bagian Profil Info -->
        <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-6 md:p-8 mb-8 flex flex-col sm:flex-row items-center sm:items-start gap-6">
            <!-- Initials (Bentuk Lingkaran/Foto Profil) -->
            <div class="w-24 h-24 rounded-full bg-indigo-600 text-white flex items-center justify-center text-3xl font-bold uppercase shadow-md shrink-0">
                {{ $user->initials }}
            </div>
            
            <!-- Detail User -->
            <div class="text-center sm:text-left mt-2 sm:mt-0">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                <p class="text-gray-500 mt-1 font-medium">{{ $user->email }}</p>
            </div>
        </div>

        <!-- Bagian Daftar Alamat -->
        <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-6 md:p-8">
            <!-- Header Alamat & Tombol Tambah -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4 border-b border-gray-100 pb-4">
                <h2 class="text-xl font-bold text-gray-800">Daftar Alamat</h2>
                
                <a href="{{ route('page.address.create', $user->username) }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Alamat
                </a>
            </div>

            <!-- Grid Kartu Alamat -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse ($user->addresses as $address)
                    <div class="relative border rounded-xl p-5 transition duration-200 hover:shadow-md {{ $address->is_active ? 'border-indigo-500 bg-indigo-50/30' : 'border-gray-200 bg-white' }}">
                        
                        <!-- Badge Aktif -->
                        @if ($address->is_active)
                            <span class="absolute top-4 right-4 bg-indigo-100 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full border border-indigo-200">
                                Utama
                            </span>
                        @endif

                        <!-- Detail Alamat -->
                        <div class="mb-5 pr-16">
                            <p class="text-gray-800 font-semibold mb-1">{{ $address->alamat }}</p>
                            <p class="text-gray-600 text-sm mb-0.5">RT {{ $address->rt }} / RW {{ $address->rw }}</p>
                            <p class="text-gray-600 text-sm mb-0.5">{{ $address->kelurahan }}, {{ $address->kecamatan }}</p>
                            <p class="text-gray-600 text-sm">{{ $address->kota }} - {{ $address->kode_pos }}</p>
                        </div>

                        <!-- Aksi (Edit & Set Utama) -->
                        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between gap-3">
                            <a href="{{ route('page.address.edit', $address->id) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                                Edit Alamat
                            </a>

                            <!-- Tombol Jadikan Utama (Hanya muncul jika belum aktif) -->
                            @if (!$address->is_active)
                                <form action="{{ route('put.address.change_active_address', $address->id) }}" method="POST" class="m-0">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 hover:text-gray-900 py-1.5 px-3 rounded-lg transition-colors">
                                        Jadikan Utama
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <!-- Tampilan jika tidak ada alamat -->
                    <div class="col-span-1 md:col-span-2 text-center py-10 bg-gray-50 border border-dashed border-gray-200 rounded-xl">
                        <p class="text-gray-500 mb-2">Belum ada alamat yang tersimpan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>s