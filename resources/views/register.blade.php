<x-layout title="Daftar">
    <div class="justify-center items-center flex flex-col px-4 py-4">
        <div class="bg-white shadow-xl rounded-2xl p-8 w-full border border-amber-200">
            <div class="text-center mb-8">
                <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-amber-800 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-amber-900">Daftar Akun</h3>
                <p class="text-amber-700 text-sm mt-1">Buat akun baru untuk memulai</p>
            </div>

            <form action="{{ route('post.register') }}" method="POST" class="flex flex-col gap-5">
                @csrf
                <div class="flex gap-2">
                <x-form.input name="name" label="Nama Anda" required />
                <x-form.input name="username" label="Username" required />
                </div>
                <x-form.input name="email" label="Email" required />
                <x-form.input name="password" type="password" label="Password" required />
                <x-form.input name="password_confirmation" type="password" label="Masukan password sekali lagi" required />

                <button
                    type="submit"
                    class="mt-2 bg-amber-800 hover:bg-amber-900 active:bg-amber-950 text-white font-semibold
                           py-2.5 rounded-lg transition shadow-md hover:shadow-lg"
                >
                    Daftar
                </button>
            </form>

            <p class="text-center text-sm text-amber-700 mt-6">
                Sudah punya akun?
                <a href="{{ route('page.login') }}" class="text-amber-900 font-semibold hover:underline">Login di sini</a>
            </p>
        </div>
    </div>
</x-layout>