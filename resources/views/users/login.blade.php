@vite(['resources/css/app.css', 'resources/js/app.js'])


<div class="flex justify-center items-center min-h-screen">
    <form method="POST" action="{{ route('login') }}" 
          class="bg-white shadow-2xl rounded-2xl overflow-hidden border-4 border-green-400 dark:border-green-800 max-w-md mx-auto">
        @csrf
        
        <div class="px-8 py-10 md:px-10">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-center text-zinc-800 dark:text-black">
                Selamat Datang
            </h2>
            <p class="text-center text-zinc-900 dark:text-zinc-400 mt-3 text-base md:text-lg lg:text-xl">
                Silahkan masukan username & password
            </p>
            
            <!-- Tambahkan pesan error -->
            @if($errors->any())
                <div class="mt-4 p-3 bg-red-100 text-red-700 rounded">
                    {{ $errors->first() }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="mt-10">
                <div class="relative">
<label class="block mb-3 text-sm md:text-base lg:text-lg font-medium text-zinc-900"
    for="login">Username atau Email</label>
<input
    class="block w-full px-4 py-3 mt-2 text-zinc-800 bg-white border-2 rounded-lg dark:border-zinc-600 dark:bg-zinc-200 dark:text-zinc-800 focus:border-green-500 dark:focus:green-blue-400 focus:ring-opacity-50 focus:outline-none focus:ring focus:ring-green-400"
    name="login" 
    id="login" 
    type="text"
    value="{{ old('login') }}"
    required
    autofocus />
                </div>
                <div class="mt-6">
                    <label class="block mb-3 text-sm md:text-base lg:text-lg font-medium text-zinc-900"
                        for="password">Password</label>
                    <input
                        class="block w-full px-4 py-3 mt-2 text-zinc-800 bg-white border-2 rounded-lg dark:border-zinc-600 dark:bg-zinc-200 dark:text-zinc-800 focus:border-green-500 dark:focus:border-green-400 focus:ring-opacity-50 focus:outline-none focus:ring focus:ring-green-400"
                        name="password" 
                        id="password" 
                        type="password" 
                        required
                        autocomplete="current-password" />
                    <div class="flex items-center mt-3">
                        <input id="show-password" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded" onclick="togglePasswordVisibility()">
                        <label for="show-password" class="ml-2 block text-sm text-gray-900">
                            Tampilkan Password
                        </label>
                    </div>
                </div>
                <script>
                    function togglePasswordVisibility() {
                        var passwordInput = document.getElementById('password');
                        var showPasswordCheckbox = document.getElementById('show-password');
                        if (showPasswordCheckbox.checked) {
                            passwordInput.type = 'text';
                        } else {
                            passwordInput.type = 'password';
                        }
                    }
                </script>
                <div class="mt-10">
                    <button
                        class="w-full px-4 py-3 tracking-wide text-white transition-colors duration-200 transform bg-gradient-to-r from-green-600 to-cyan-600 rounded-lg hover:from-green-700 hover:to-cyan-700 focus:outline-none focus:ring-4 focus:ring-green-400 dark:focus:ring-green-800"
                        type="submit">
                        Masuk
                    </button>
                </div>
            </div>
        </div>
        <div class="px-8 py-4 bg-green-200 dark:bg-zinc-600">
            <div class="text-sm md:text-base lg:text-lg text-green-900 dark:text-green-300 text-center">
                <div class="flex items-center justify-center">
                    <span class="mr-2">Belum Memiliki Akun ?</span>
                    <a href='{{ url('/daftar') }}' class="inline-block">
                        <button
                            class="w-full md:w-auto relative flex items-center px-4 py-1.5 overflow-hidden font-medium transition-all bg-green-700 rounded-md group"
                            type="button">
                            <span
                                class="absolute top-0 right-0 inline-block w-3 h-3 transition-all duration-500 ease-in-out bg-green-500 rounded group-hover:-mr-3 group-hover:-mt-3">
                                <span
                                    class="absolute top-0 right-0 w-4 h-4 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                            </span>
                            <span
                                class="absolute bottom-0 rotate-180 left-0 inline-block w-3 h-3 transition-all duration-500 ease-in-out bg-green-500 rounded group-hover:-ml-3 group-hover:-mb-3">
                                <span
                                    class="absolute top-0 right-0 w-4 h-4 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                            </span>
                            <span
                                class="absolute bottom-0 left-0 w-full h-full transition-all duration-500 ease-in-out delay-200 -translate-x-full bg-green-600 rounded-md group-hover:translate-x-0"></span>
                            <span
                                class="relative w-full text-center text-white transition-colors duration-200 ease-in-out group-hover:text-white">Daftar</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>