<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::query();

        // Apply search
        if ($request->filled('search_keyword')) {
            $keyword = $request->input('search_keyword');
            $query->search($keyword);
        }

        // Apply category filter
        if ($request->filled('category')) {
            $categoryId = $request->input('category');
            $query->FilterByCategory($categoryId);
        }

        // Get paginated results
        $books = $query->orderBy('title', 'asc')->paginate(10); // Assuming you want to paginate with 10 books per page

        return view('dashboard.admin.book.index', [
            'books' => $books,
            'title' => 'Manajemen Buku',
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.book.create', [
            'title' => 'Manajemen Buku',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'min:3', 'max:100'],
            'desc' => ['nullable'],
            'category_id' => ['required'],
            'stock' => ['required'],
            'publisher' => ['required'],
            'writer' => ['required'],
            'publish_date' => ['required'],
            'image' => ['image', 'file', 'required', 'max:10240'], // 10 MB in kilobytes (10 * 1024)
        ], [
            'title.required' => 'Judul harus diisi.',
            'title.min' => 'Judul minimal harus terdiri dari :min karakter.',
            'title.max' => 'Judul maksimal harus terdiri dari :max karakter.',
            'category_id.required' => 'Tipe harus dipilih.',
            'stock.required' => 'Stok harus diisi.',
            'publisher.required' => 'Penerbit harus diisi.',
            'writer.required' => 'Penulis harus diisi.',
            'publish_date.required' => 'Tanggal terbit harus diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.file' => 'File harus berupa gambar.',
            'image.required' => 'Gambar harus diunggah.',
            'image.max' => 'Ukuran gambar maksimal adalah 10 MB.'
        ]);
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('book-images');
        }
        Book::create($validatedData);
        return redirect('/books-management')->with('success', 'Data buku berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Book $books_management)
    // {
    //     return dd($books_management);
    // }

    public function show(Book $books_management)
    {
        return view('dashboard.admin.book.show', [
            'title' => 'Manajemen Buku',
            'book' => $books_management,
            // 'date_now' => $date_now,
            // 'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            // 'favorites' => Favorite::where('user_id', auth()->user()->id)->get(),
            // 'comments' => Comment::where('book_id', $book->id)->latest()->get()
        ]);
        // return dd($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $books_management)
    {
        return view('dashboard.admin.book.edit', [
            'title' => 'Manajemen Buku',
            'book' => $books_management,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $books_management)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'min:3', 'max:100'],
            'desc' => ['nullable', 'required'],
            'category_id' => ['required'],
            'stock' => ['required'],
            'publisher' => ['required'],
            'writer' => ['required'],
            'publish_date' => ['required'],
            'image' => ['image', 'file']
        ], [
            'title.required' => 'Judul harus diisi.',
            'title.min' => 'Judul minimal memiliki 3 karakter.',
            'title.max' => 'Judul maksimal memiliki 100 karakter.',
            'desc.required' => 'Deskripsi harus diisi.',
            'category_id.required' => 'Kategori harus dipilih.',
            'stock.required' => 'Stok harus diisi.',
            'publisher.required' => 'Nama penerbit harus diisi.',
            'writer.required' => 'Nama penulis harus diisi.',
            'publish_date.required' => 'Tanggal terbit harus diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.file' => 'File harus berupa gambar.'
        ]);

        // Check if a new image is being uploaded
        if ($request->file('image')) {
            // Delete the old image
            if ($books_management->image) {
                Storage::delete($books_management->image);
            }

            // Store the new image
            $validatedData['image'] = $request->file('image')->store('book-images');
        }

        // Update the book record
        $books_management->update($validatedData);

        return redirect('/books-management')->with('successEdit', "Buku $request->title berhasil diperbarui!");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $books_management)
    {
        Book::destroy($books_management->id);
        return redirect('/books-management')->with('successDelete', 'Buku berhasil dihapus!');
    }
}
