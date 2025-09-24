<x-app-layout>
    <div class="container">
        <h1>Editar Filme</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('movies.update', $movie->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control"
                       value="{{ old('title', $movie->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="director" class="form-label">Diretor</label>
                <input type="text" name="director" id="director" class="form-control"
                       value="{{ old('director', $movie->director) }}" required>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Ano</label>
                <input type="number" name="year" id="year" class="form-control"
                       value="{{ old('year', $movie->year) }}" required>
            </div>

            <div class="mb-3">
                <label for="review" class="form-label">Avaliação (opcional)</label>
                <input type="number" name="review" id="review" class="form-control"
                       value="{{ old('review', $movie->review) }}" min="1" max="10">
            </div>

            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
</x-app-layout>
