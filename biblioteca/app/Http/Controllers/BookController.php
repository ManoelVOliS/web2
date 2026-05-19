<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class BookController extends Controller
{

    public function storeWithId(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'pages' => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $validated['cover_image'] = $path; // [cite: 1107]
        }

        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso usando ID.');
    }

    public function storeWithSelect(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'pages' => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Validação da imagem [cite: 1104]
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $validated['cover_image'] = $path;
        }

        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso usando Select.');
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'pages' => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $path = $request->file('cover_image')->store('covers', 'public');
            $validated['cover_image'] = $path;
        }

        $book->update($validated); 
        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso.');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete(); 
        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso.');
    }

    public function index()
    {
        $books = Book::with('author')->paginate(20); 
        return view('books.index', compact('books'));
    }

    public function createWithSelect()
    {

        $publishers = Publisher::all(); 
        $authors = Author::all();
        $categories = Category::all();

        return view('books.create-select', compact('publishers', 'authors', 'categories'));
    }
}