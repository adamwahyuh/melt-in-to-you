<x-layout title="Login">
    <div class="flex flex-col  min-h-screen  justify-center items-center">
        <h3>Halaman Login</h3>
        <form action="{{ route('post.login') }}" class="flex flex-col" method="POST">
            @csrf
            <div class="">
                <label for="username">Username</label>
                <input id="username" type="text" name="username">
            </div>

            <div class="">
                <label for="password">Password</label>
                <input id="password" type="password" name="password">
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</x-layout>