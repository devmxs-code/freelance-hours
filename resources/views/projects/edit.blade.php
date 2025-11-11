<x-layouts.app>
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-black hover:text-gray-700 font-medium transition-colors">
            ← Voltar para dashboard
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-300 p-8">
        <h1 class="text-3xl font-bold text-black mb-6">Editar Projeto</h1>

        <form action="{{ route('projects.update', $project->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-black mb-1">
                    Título do Projeto <span class="text-gray-600">*</span>
                </label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       required
                       value="{{ old('title', $project->title) }}"
                       class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black bg-white text-black @error('title') border-gray-600 @enderror">
                @error('title')
                    <p class="mt-1 text-sm text-gray-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-black mb-1">
                    Descrição <span class="text-gray-600">*</span>
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="8"
                          required
                          class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black bg-white text-black @error('description') border-gray-600 @enderror">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-gray-700">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="ends_at" class="block text-sm font-medium text-black mb-1">
                        Data de Término <span class="text-gray-600">*</span>
                    </label>
                    <input type="datetime-local" 
                           id="ends_at" 
                           name="ends_at" 
                           required
                           value="{{ old('ends_at', $project->ends_at->format('Y-m-d\TH:i')) }}"
                           class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black bg-white text-black @error('ends_at') border-gray-600 @enderror">
                    @error('ends_at')
                        <p class="mt-1 text-sm text-gray-700">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-black mb-1">
                        Status <span class="text-gray-600">*</span>
                    </label>
                    <select id="status" 
                            name="status"
                            required
                            class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black bg-white text-black @error('status') border-gray-600 @enderror">
                        <option value="open" {{ old('status', $project->status->value) === 'open' ? 'selected' : '' }}>Aberto</option>
                        <option value="closed" {{ old('status', $project->status->value) === 'closed' ? 'selected' : '' }}>Fechado</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-gray-700">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-black mb-2">
                    Stack Tecnológica <span class="text-gray-600">*</span>
                </label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @php
                        $availableTechs = ['Laravel', 'PHP', 'MySQL', 'Vue.js', 'React', 'Node.js', 'TypeScript', 'MongoDB', 'PostgreSQL', 'Python', 'Django', 'Flutter', 'React Native', 'Next.js', 'Tailwind CSS', 'Redis', 'Docker', 'Kubernetes', 'Firebase', 'WordPress', 'JavaScript', 'Express', 'FastAPI', 'Prisma'];
                        $currentTechs = old('tech_stack', $project->tech_stack ?? []);
                    @endphp
                    @foreach($availableTechs as $tech)
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" 
                                   name="tech_stack[]" 
                                   value="{{ $tech }}"
                                   {{ in_array($tech, $currentTechs) ? 'checked' : '' }}
                                   class="rounded border-gray-400 text-black focus:ring-black">
                            <span class="text-sm text-gray-700">{{ $tech }}</span>
                        </label>
                    @endforeach
                </div>
                @error('tech_stack')
                    <p class="mt-1 text-sm text-gray-700">{{ $message }}</p>
                @enderror
                @error('tech_stack.*')
                    <p class="mt-1 text-sm text-gray-700">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-black mb-2">
                    Categorias
                </label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @php
                        $projectCategories = $project->categories->pluck('id')->toArray();
                        $selectedCategories = old('categories', $projectCategories);
                    @endphp
                    @foreach($categories as $category)
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" 
                                   name="categories[]" 
                                   value="{{ $category->id }}"
                                   {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}
                                   class="rounded border-gray-400 text-black focus:ring-black">
                            <span class="text-sm text-gray-700">{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('categories')
                    <p class="mt-1 text-sm text-gray-700">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" 
                        class="bg-black hover:bg-gray-800 text-white font-medium py-3 px-6 rounded transition-colors">
                    Salvar Alterações
                </button>
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-black font-medium py-3 px-6 rounded transition-colors">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
