<x-layouts.app>
    <div class="mb-6">
        <a href="{{ route('projects.index') }}" class="text-black hover:text-gray-700 font-medium transition-colors">
            ← Voltar para projetos
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-300">
        <div class="p-8">
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-black mb-2">{{ $project->title }}</h1>
                    <div class="flex items-center gap-4 text-sm text-gray-600">
                        <span>Criado por: <strong class="text-black">{{ $project->creator->name ?? 'N/A' }}</strong></span>
                        <span>•</span>
                        <span>Prazo: <strong class="text-black">{{ $project->ends_at->format('d/m/Y H:i') }}</strong></span>
                        <span>•</span>
                        <span class="px-2 py-1 rounded text-xs font-medium
                            {{ $project->status->value === 'open' ? 'bg-black text-white' : 'bg-gray-300 text-black' }}">
                            {{ $project->status->label() }}
                        </span>
                    </div>
                </div>
                @auth
                    @if($project->created_by === auth()->id() || auth()->user()->isAdmin())
                        <a href="{{ route('projects.edit', $project->id) }}" 
                           class="bg-black hover:bg-gray-800 text-white font-medium py-2 px-4 rounded transition-colors">
                            Editar Projeto
                        </a>
                    @endif
                @endauth
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-black mb-3">Descrição</h2>
                <div class="prose max-w-none text-gray-700">
                    {!! $project->description !!}
                </div>
            </div>

            @if($project->tech_stack && count($project->tech_stack) > 0)
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-black mb-3">Stack Tecnológico</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->tech_stack as $tech)
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 border border-gray-300 text-sm font-medium rounded">
                                {{ $tech }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($project->isOpen())
                <div class="border-t border-gray-300 pt-6 mt-6">
                    <h2 class="text-lg font-semibold text-black mb-4">Enviar Proposta</h2>
                    <form action="{{ route('proposals.store', $project->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-black mb-1">
                                Seu Email
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   required
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black @error('email') border-gray-600 @enderror bg-white text-black">
                            @error('email')
                                <p class="mt-1 text-sm text-gray-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="hours" class="block text-sm font-medium text-black mb-1">
                                Horas Estimadas
                            </label>
                            <input type="number" 
                                   id="hours" 
                                   name="hours" 
                                   required
                                   min="1"
                                   max="1000"
                                   value="{{ old('hours') }}"
                                   class="w-full px-4 py-2 border border-gray-400 rounded focus:ring-2 focus:ring-black focus:border-black @error('hours') border-gray-600 @enderror bg-white text-black">
                            @error('hours')
                                <p class="mt-1 text-sm text-gray-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" 
                                class="w-full bg-black hover:bg-gray-800 text-white font-medium py-3 px-6 rounded transition-colors">
                            Enviar Proposta
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-300">
        <div class="p-8">
            <h2 class="text-xl font-semibold text-black mb-4">
                Propostas ({{ $project->proposals->count() }})
            </h2>

            @if($project->proposals->count() > 0)
                <div class="space-y-4">
                    @foreach($project->proposals as $proposal)
                        <div class="border border-gray-300 rounded p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-black">{{ $proposal->email }}</p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Enviada em {{ $proposal->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-semibold text-black">{{ $proposal->hours }}h</p>
                                    <p class="text-xs text-gray-600">horas estimadas</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center py-8">Nenhuma proposta ainda.</p>
            @endif
        </div>
    </div>
</x-layouts.app>
