<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Meus Filmes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div id="success_message" class="mb-4 p-4 bg-green-100 text-green-800 rounded transition-opacity duration-500 ease-in-out">
                    {{ session('success') }}
                </div>
                <script>
                    const successMessage = document.querySelector('#success_message');
                    if (successMessage) {
                        setTimeout(() => { successMessage.classList.add('opacity-0'); }, 4500);
                        setTimeout(() => { successMessage.style.display = 'none'; }, 5000);
                    }
                </script>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form method="GET" action="{{ route('movies.index') }}" class="mb-4 flex gap-2">
                <input type="text" name="search" placeholder="Buscar filme" 
                       value="{{ request('search') }}" class="border-gray-300 rounded">
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Buscar</button>
            </form>

            <a href="{{ route('movies.create') }}" class="mb-4 inline-block bg-green-500 text-white px-4 py-2 rounded">
                + Adicionar Filme
            </a>

            <div class="overflow-x-auto shadow-md rounded-lg">
                <table class="w-full">
                    <thead class="bg-gray-700 text-gray-300">
                        <tr>
                            <th class="px-4 py-2 text-left">Título</th>
                            <th class="px-4 py-2 text-left">Diretor</th>
                            <th class="px-4 py-2 text-left">Ano</th>
                            <th class="px-4 py-2 text-left">Avaliação</th>
                            <th class="px-4 py-2 text-center">Assistido</th>
                            <th class="px-4 py-2 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800">
                        @forelse($movies as $movie)
                            <tr class="border-b border-gray-700">
                                <td class="px-4 py-2 text-gray-200">{{ $movie->title }}</td>
                                <td class="px-4 py-2 text-gray-200">{{ $movie->director }}</td>
                                <td class="px-4 py-2 text-gray-200">{{ $movie->year }}</td>
                                <td class="px-4 py-2 text-gray-200">{{ $movie->review }}</td>
                                <td class="px-4 py-2 text-center">
                                    {{ $movie->watched ? '✅' : '❌' }}
                                </td>
                                <td class="px-4 py-2 flex gap-2 justify-center">
                                    <a href="{{ route('movies.edit', $movie) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">Editar</a>

                                    <form action="{{ route('movies.destroy', $movie) }}" method="POST" onsubmit="return confirm('Tem certeza?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded">Excluir</button>
                                    </form>

                                    <form action="{{ route('movies.toggleWatched', $movie) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded whitespace-nowrap">
                                            Marcar {{ $movie->watched ? 'Não Assistido' : 'Assistido' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-gray-400">Nenhum filme cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
