<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends \Illuminate\Routing\Controller
{
    // Aplica middleware auth para todas as rotas
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Lista todos os filmes do usuário logado
    public function index(Request $request)
    {
        $query = Movie::where('user_id', auth()->id());

        // Filtro por título
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $movies = $query->orderBy('created_at', 'desc')->get();

        return view('movies.index', compact('movies'));
    }

    // Mostra formulário de criação
    public function create()
    {
        return view('movies.create');
    }

    // Salva novo filme
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'nullable|string|max:255',
            'year' => 'nullable|integer',
            'review' => 'nullable|numeric|min:0|max:10',
        ]);

        $validated['user_id'] = auth()->id();

        Movie::create($validated);

        return redirect()->route('movies.index')->with('success', 'Filme adicionado com sucesso!');
    }


    // Mostra formulário de edição
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    // Atualiza o filme
    public function update(Request $request, Movie $movie)
    {

        $request->validate([
            'title' => 'required',
            'director' => 'required',
            'year' => 'required|integer',
        ]);

        $movie->update($request->all());

        return redirect()->route('movies.index')->with('success', 'Filme atualizado com sucesso!');
    }

    // Deleta o filme
    public function destroy(Movie $movie) {

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Filme excluído com sucesso!');
    }

    // Alterna entre assistido e não assistido
    public function toggleWatched(Movie $movie)
    {
        $movie->watched = !$movie->watched;
        $movie->save();

        return redirect()->route('movies.index')->with('success', 'Status do filme atualizado!');
    }
}
