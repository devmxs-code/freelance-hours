<x-layouts.app>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-black">Projetos Disponíveis</h1>
        <p class="mt-2 text-gray-600">Encontre projetos e envie suas propostas</p>
    </div>

    <!-- Filtros e Busca -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-300 p-6 mb-6">
        <form method="GET" action="{{ route('projects.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Busca -->
                <div>
                    <label for="search" class="block text-sm font-medium text-black mb-1">Buscar</label>
                    <input type="text" 
                           id="search" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Título ou descrição..."
                           class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black bg-white text-black">
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-black mb-1">Status</label>
                    <select id="status" 
                            name="status"
                            class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black bg-white text-black">
                        <option value="">Todos</option>
                        <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Aberto</option>
                        <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Fechado</option>
                    </select>
                </div>

                <!-- Tecnologia -->
                <div>
                    <label for="tech" class="block text-sm font-medium text-black mb-1">Tecnologia</label>
                    <select id="tech" 
                            name="tech"
                            class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black bg-white text-black">
                        <option value="">Todas</option>
                        <option value="Laravel" {{ request('tech') === 'Laravel' ? 'selected' : '' }}>Laravel</option>
                        <option value="React" {{ request('tech') === 'React' ? 'selected' : '' }}>React</option>
                        <option value="Vue.js" {{ request('tech') === 'Vue.js' ? 'selected' : '' }}>Vue.js</option>
                        <option value="Node.js" {{ request('tech') === 'Node.js' ? 'selected' : '' }}>Node.js</option>
                        <option value="Python" {{ request('tech') === 'Python' ? 'selected' : '' }}>Python</option>
                        <option value="React Native" {{ request('tech') === 'React Native' ? 'selected' : '' }}>React Native</option>
                    </select>
                </div>

                <!-- Ordenação -->
                <div>
                    <label for="sort" class="block text-sm font-medium text-black mb-1">Ordenar</label>
                    <select id="sort" 
                            name="sort"
                            class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black bg-white text-black">
                        <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Mais Recentes</option>
                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Mais Antigos</option>
                        <option value="proposals" {{ request('sort') === 'proposals' ? 'selected' : '' }}>Mais Propostas</option>
                        <option value="deadline" {{ request('sort') === 'deadline' ? 'selected' : '' }}>Prazo</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-black hover:bg-gray-800 text-white font-medium py-2 px-6 rounded transition-colors">
                    Filtrar
                </button>
                <a href="{{ route('projects.index') }}" class="bg-gray-300 hover:bg-gray-400 text-black font-medium py-2 px-6 rounded transition-colors">
                    Limpar
                </a>
            </div>
        </form>
    </div>

    @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden border border-gray-300">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <h2 class="text-xl font-semibold text-black line-clamp-2 flex-1">
                                <a href="{{ route('projects.show', $project->id) }}" class="hover:text-gray-700 transition-colors">
                                    {{ $project->title }}
                                </a>
                            </h2>
                            <div class="flex items-center gap-2 ml-2">
                                @auth
                                    <form action="{{ route($project->isFavoritedBy(auth()->user()) ? 'favorites.destroy' : 'favorites.store', $project) }}" 
                                          method="POST" 
                                          class="inline">
                                        @csrf
                                        @if($project->isFavoritedBy(auth()->user()))
                                            @method('DELETE')
                                        @endif
                                        <button type="submit" class="text-black hover:text-gray-700">
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endauth
                                <span class="px-2 py-1 text-xs font-medium rounded
                                    {{ $project->status->value === 'open' ? 'bg-black text-white' : 'bg-gray-300 text-black' }}">
                                    {{ $project->status->label() }}
                                </span>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ strip_tags($project->description) }}
                        </p>

                        @if($project->tech_stack && count($project->tech_stack) > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach(array_slice($project->tech_stack, 0, 3) as $tech)
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 border border-gray-300 text-xs rounded">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                                @if(count($project->tech_stack) > 3)
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 border border-gray-300 text-xs rounded">
                                        +{{ count($project->tech_stack) - 3 }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <div>
                                <span class="font-medium">Prazo:</span>
                                {{ $project->ends_at->format('d/m/Y') }}
                            </div>
                            <div>
                                <span class="font-medium">{{ $project->proposals->count() }}</span>
                                {{ $project->proposals->count() === 1 ? 'proposta' : 'propostas' }}
                            </div>
                        </div>

                        <div class="text-xs text-gray-400 mb-4">
                            Criado por: {{ $project->creator->name ?? 'N/A' }}
                        </div>

                        <a href="{{ route('projects.show', $project->id) }}" 
                           class="mt-4 block w-full text-center bg-black hover:bg-gray-800 text-white font-medium py-2 px-4 rounded transition-colors">
                            Ver Detalhes
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $projects->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm p-12 text-center border border-gray-300">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-black">Nenhum projeto encontrado</h3>
            <p class="mt-2 text-gray-600">Não há projetos disponíveis com os filtros selecionados.</p>
        </div>
    @endif
</x-layouts.app>
