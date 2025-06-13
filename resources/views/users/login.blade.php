<form method="POST" action="{{ route('login') }}"
    class="bg-white shadow-lg rounded-xl overflow-hidden w-full max-w-md mx-auto">
    @csrf

    <div class="p-8">
        <div class="text-center mb-3">
            <div class="mb-0 transform hover:scale-105 transition-transform duration-300">
                <img src="{{ Vite::asset('resources\image\logo-dmi.jpg') }}" alt="Logo DMI"
                    class="w-32 h-32 mx-auto drop-shadow-lg rounded-full object-cover">
            </div>
            <h2 class="mt-5 text-3xl font-bold text-gray-800 bg-gradient-to-r from-green-600 to-green-800 bg-clip-text">
                Selamat Datang
            </h2>
            <p class="text-gray-600 mt-1 text-lg">
                Silahkan masukan username & password
            </p>
            <div class="mt-4 w-70 h-0.5 bg-green-500 mx-auto rounded-full"></div>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm notification"
                data-duration="5000">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-lg text-sm notification"
                data-duration="5000">
                {{ session('success') }}
            </div>
        @endif

        <style>
            .notification {
                animation: fadeInOut 5s ease-in-out forwards;
            }

            @keyframes fadeInOut {
                0% {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                10% {
                    opacity: 1;
                    transform: translateY(0);
                }

                80% {
                    opacity: 1;
                    transform: translateY(0);
                }

                100% {
                    opacity: 0;
                    transform: translateY(-10px);
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const notifications = document.querySelectorAll('.notification');

                notifications.forEach(notification => {
                    const duration = notification.dataset.duration || 5000;

                    setTimeout(() => {
                        notification.style.opacity = '0';
                        notification.style.transform = 'translateY(-10px)';

                        setTimeout(() => {
                            notification.remove();
                        }, 500);
                    }, duration);
                });
            });
        </script>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="login">
                    Username atau Email
                </label>
                <input
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-colors"
                    name="login" id="login" type="text" value="{{ old('login') }}" required autofocus />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="password">
                    Password
                </label>
                <input
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-colors"
                    name="password" id="login-password" type="password" required autocomplete="current-password" />

                <div class="flex items-center mt-2">
                    <input id="show-password" type="checkbox"
                        class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                        onclick="togglePasswordVisibility()">
                    <label for="show-password" class="ml-2 text-sm text-gray-600">
                        Tampilkan Password
                    </label>
                </div>
            </div>

            <script>
                function togglePasswordVisibility() {
                    const passwordInput = document.getElementById('login-password');
                    const showPasswordCheckbox = document.getElementById('show-password');
                    passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
                }
            </script>
            <button
                class="w-full py-2.5 px-4 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                type="submit">
                Masuk
            </button>
        </div>
    </div>

    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100">
        <div class="text-center text-sm">
            <span class="text-gray-600">Belum Memiliki Akun?</span>
            <button onclick="showRegisterPopup()" class="ml-2 text-green-600 hover:text-green-700 font-medium">
                Daftar Sekarang
            </button>
        </div>
    </div>
</form>