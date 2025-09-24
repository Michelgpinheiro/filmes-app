<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Meus Filmes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alertas de sucesso/erro --}}
            @if(session('success'))
                <div id="success_message" class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(() => {
                        let message_appear = document.querySelector('#success_message');
                        if (meessage_appear) message_appear.display = 'none';
                    }, 5000);
                </script>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Filtro --}}
            <form method="GET" action="{{ route('movies.index') }}" class="mb-4 flex gap-2">
                <input type="text" name="search" placeholder="Buscar filme" 
                       value="{{ request('search') }}" class="border px-2 py-1 rounded">
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Buscar</button>
            </form>

            {{-- Botão adicionar --}}
            <a href="{{ route('movies.create') }}" class="mb-4 inline-block bg-green-500 text-white px-4 py-2 rounded">
                + Adicionar Filme
            </a>

            {{-- Lista de filmes --}}
            <table class="w-full border-collapse border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-2 py-1">Título</th>
                        <th class="border px-2 py-1">Diretor</th>
                        <th class="border px-2 py-1">Ano</th>
                        <th class="border px-2 py-1">Avaliação</th>        
                        <th class="border px-2 py-1">Assistido</th>        
                        <th class="border px-2 py-1">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movies as $movie)
                        <tr>
                            <td class="border px-2 py-1">{{ $movie->title }}</td>
                            <td class="border px-2 py-1">{{ $movie->director }}</td>
                            <td class="border px-2 py-1">{{ $movie->year }}</td>
                            <td class="border px-2 py-1">{{ $movie->review }}</td>
                            <td class="border px-2 py-1">
                                {{ $movie->watched ? '✅' : '❌' }}
                            </td>
                            <td class="border px-2 py-1 flex gap-1">
                                <a href="{{ route('movies.edit', $movie) }}" class="bg-yellow-400 px-2 py-1 rounded">Editar</a>

                                <form action="{{ route('movies.destroy', $movie) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Excluir</button>
                                </form>

                                <form action="{{ route('movies.toggleWatched', $movie) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">
                                        Marcar {{ $movie->watched ? 'Não Assistido' : 'Assistido' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border px-2 py-1 text-center">Nenhum filme cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
