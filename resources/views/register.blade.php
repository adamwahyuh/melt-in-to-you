<x-layout title="Registrasi">

    <form action="{{ route('post.register') }}" method="POST">
        @csrf
        <x-form.input name="email" required label="Email" />
        <button>Daftar</button>
    </form>
</x-layout>