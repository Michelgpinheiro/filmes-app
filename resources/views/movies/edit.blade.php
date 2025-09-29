<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Filme
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">

                    @if ($errors->any())
                        <div class="mb-4 bg-red-900 border border-red-400 text-red-200 px-4 py-3 rounded-lg">
                            <strong class="font-bold">Opa!</strong>
                            <span class="block sm:inline">Houve alguns problemas com os seus dados.</span>
                            <ul class="mt-3 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('movies.update', $movie->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Título</label>
                            <input type="text" name="title" id="title"
                                   class="bg-gray-700 border border-gray-600 text-gray-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   value="{{ old('title', $movie->title) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="director" class="block mb-2 text-sm font-medium text-gray-300">Diretor</label>
                            <input type="text" name="director" id="director"
                                   class="bg-gray-700 border border-gray-600 text-gray-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   value="{{ old('director', $movie->director) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-300">Ano</label>
                            <input type="number" name="year" id="year"
                                   class="bg-gray-700 border border-gray-600 text-gray-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   value="{{ old('year', $movie->year) }}"
                                   required min="1888" max="{{ date('Y') + 1 }}"
                                   oninput="if(this.value.length > 4) this.value = this.value.slice(0, 4);">
                        </div>

                        <div class="mb-4">
                            <label for="review" class="block mb-2 text-sm font-medium text-gray-300">Avaliação (opcional, 1 a 10)</label>
                            <input type="number" name="review" id="review"
                                   class="bg-gray-700 border border-gray-600 text-gray-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   value="{{ old('review', $movie->review) }}" min="1" max="10">
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                                Atualizar Filme
                            </button>
                            <a href="{{ route('movies.index') }}"
                               class="bg-gray-600 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
