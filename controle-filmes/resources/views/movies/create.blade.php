<x-app-layout>
    <div class="container">
        <h1>Adicionar Filme</h1>

        <form action="{{ route('movies.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="director" class="form-label">Diretor</label>
                <input type="text" name="director" id="director" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Ano</label>
                <input type="number" name="year" id="year" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="review" class="form-label">Avaliação (opcional)</label>
                <input type="number" name="review" id="review" class="form-control" min="1" max="10">
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</x-app-layout>
