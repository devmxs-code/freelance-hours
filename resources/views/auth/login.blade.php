<x-layouts.app>
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-sm border border-gray-300 p-8">
        <h1 class="text-2xl font-bold text-black mb-6">Entrar</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-black mb-1">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black bg-white text-black">
                @error('email')
                    <p class="mt-1 text-sm text-gray-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-black mb-1">Senha</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required
                       class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black bg-white text-black">
                @error('password')
                    <p class="mt-1 text-sm text-gray-700">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" 
                       id="remember" 
                       name="remember"
                       class="rounded border-gray-400 text-black focus:ring-black">
                <label for="remember" class="ml-2 text-sm text-gray-700">Lembrar-me</label>
            </div>

            <button type="submit" 
                    class="w-full bg-black hover:bg-gray-800 text-white font-medium py-3 px-6 rounded transition-colors">
                Entrar
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Não tem conta? <a href="{{ route('register') }}" class="text-black font-medium hover:underline">Registre-se</a>
        </p>
    </div>
</x-layouts.app>
