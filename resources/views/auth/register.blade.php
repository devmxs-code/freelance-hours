<x-layouts.app>
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-sm border border-gray-300 p-8">
        <h1 class="text-2xl font-bold text-black mb-6">Registrar</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-black mb-1">Nome</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black bg-white text-black">
                @error('name')
                    <p class="mt-1 text-sm text-gray-700">{{ $message }}</p>
                @enderror
            </div>

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

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-black mb-1">Confirmar Senha</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       required
                       class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black bg-white text-black">
            </div>

            <button type="submit" 
                    class="w-full bg-black hover:bg-gray-800 text-white font-medium py-3 px-6 rounded transition-colors">
                Registrar
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Já tem conta? <a href="{{ route('login') }}" class="text-black font-medium hover:underline">Entrar</a>
        </p>
    </div>
</x-layouts.app>
