<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends \Illuminate\Routing\Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Movie::where('user_id', auth()->id());

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $movies = $query->orderBy('created_at', 'desc')->get();

        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'nullable|string|max:255',
            'year' => ['nullable', 'integer', 'min:1888', 'max:' . (date('Y') + 1)],
            'review' => 'nullable|numeric|min:0|max:10',
        ]);

        $validated['user_id'] = auth()->id();

        Movie::create($validated);

        return redirect()->route('movies.index')->with('success', 'Filme adicionado com sucesso!');
    }


    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {

        $request->validate([
            'title' => 'required',
            'director' => 'required',
            'year' => ['required', 'integer', 'min:1888', 'max:' . (date('Y') + 1)],
        ]);

        $movie->update($request->all());

        return redirect()->route('movies.index')->with('success', 'Filme atualizado com sucesso!');
    }

    public function destroy(Movie $movie) {

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Filme excluído com sucesso!');
    }

    public function toggleWatched(Movie $movie)
    {
        $movie->watched = !$movie->watched;
        $movie->save();

        return redirect()->route('movies.index')->with('success', 'Status do filme atualizado!');
    }
}
