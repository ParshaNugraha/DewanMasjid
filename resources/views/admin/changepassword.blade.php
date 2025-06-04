@extends('layouts.password')

@section('title', 'Ganti Kata Sandi')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-8 mt-8">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Ganti Kata Sandi</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('password.change') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Password Lama --}}
        <div class="relative">
            <label for="current_password" class="block text-lg font-semibold mb-2">Password Lama</label>
            <div class="flex items-center">
                <input 
                    type="password" 
                    id="current_password" 
                    name="current_password" 
                    required 
                    autocomplete="current-password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-green-600 @error('current_password') border-red-500 @enderror"
                >
                <button type="button" onclick="togglePassword('current_password')" class="absolute right-3 bottom-1 transform -translate-y-1/2 text-gray-600 opacity-50 hover:opacity-90 focus:outline-none" tabindex="-1" aria-label="Toggle password visibility">
                    <svg id="icon-current_password" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            @error('current_password')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Baru --}}
        <div class="relative">
            <label for="password" class="block text-lg font-semibold mb-2">Password Baru</label>
            <div class="flex items-center">
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    minlength="8"
                    autocomplete="new-password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-green-600 @error('password') border-red-500 @enderror"
                >
                <button type="button" onclick="togglePassword('password')" class="absolute right-3 bottom-1 transform -translate-y-1/2 text-gray-600 opacity-50 hover:opacity-90 focus:outline-none" tabindex="-1" aria-label="Toggle password visibility">
                    <svg id="icon-password" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Konfirmasi Password Baru --}}
        <div class="relative">
            <label for="password_confirmation" class="block text-lg font-semibold mb-2">Konfirmasi Password Baru</label>
            <div class="flex items-center">
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required 
                    minlength="8"
                    autocomplete="new-password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-green-600"
                >
                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 bottom-1 transform -translate-y-1/2 text-gray-600 opacity-50 hover:opacity-90 focus:outline-none" tabindex="-1" aria-label="Toggle password visibility">
                    <svg id="icon-password_confirmation" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
        </div>

        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-lg transition duration-200">
            Simpan Perubahan
        </button>
    </form>
</div>

<script>
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        const icon = document.getElementById('icon-' + fieldId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.223-3.472M9.88 9.88a3 3 0 104.24 4.24" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
            `;
        } else {
            input.type = 'password';
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }
    }
</script>
@endsection