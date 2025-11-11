<x-layouts.app>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-black">Notificações</h1>
            <p class="mt-2 text-gray-600">Suas notificações e atualizações</p>
        </div>
        @if($notifications->where('read', false)->count() > 0)
            <form action="{{ route('notifications.read-all') }}" method="POST">
                @csrf
                <button type="submit" class="bg-black hover:bg-gray-800 text-white font-medium py-2 px-4 rounded transition-colors">
                    Marcar todas como lidas
                </button>
            </form>
        @endif
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-300">
        @forelse($notifications as $notification)
            <div class="border-b border-gray-200 p-6 {{ !$notification->read ? 'bg-gray-50' : '' }}">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <h3 class="font-semibold text-black">{{ $notification->title }}</h3>
                            @if(!$notification->read)
                                <span class="w-2 h-2 bg-black rounded-full"></span>
                            @endif
                        </div>
                        <p class="text-gray-700 mb-2">{{ $notification->message }}</p>
                        @if($notification->project)
                            <a href="{{ route('projects.show', $notification->project_id) }}" class="text-sm text-black hover:underline">
                                Ver projeto →
                            </a>
                        @endif
                        <p class="text-xs text-gray-500 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    @if(!$notification->read)
                        <form action="{{ route('notifications.read', $notification) }}" method="POST" class="ml-4">
                            @csrf
                            <button type="submit" class="text-xs text-gray-600 hover:text-black">
                                Marcar como lida
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <p class="text-gray-600">Nenhuma notificação.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
</x-layouts.app>
