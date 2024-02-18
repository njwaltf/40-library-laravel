<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Apply search
        if ($request->filled('search_keyword')) {
            $keyword = $request->input('search_keyword');
            $query->search($keyword);
        }

        // Get paginated results
        $categories = $query->orderBy('name', 'asc')->paginate(10); // Assuming you want to paginate with 10 categories per page

        return view('dashboard.admin.category.index', [
            'categories' => $categories,
            'title' => 'Manajemen Kategori',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.category.create', [
            'title' => 'Manajemen Kategori',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'description' => ['required'],
        ], [
            'name.required' => 'Judul harus diisi.',
            'name.min' => 'Judul minimal harus memiliki 3 karakter.',
            'name.max' => 'Judul maksimal harus memiliki 100 karakter.',
            'description.required' => 'Deskripsi harus diisi.',
        ]);
        Category::create($validatedData);
        return redirect('/categories-management')->with('success', 'Data kategori berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $categories_management)
    {
        return view('dashboard.admin.category.show', [
            'title' => 'Manajemen Kategori',
            'category' => $categories_management,
            // 'date_now' => $date_now,
            // 'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            // 'favorites' => Favorite::where('user_id', auth()->user()->id)->get(),
            // 'comments' => Comment::where('book_id', $book->id)->latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $categories_management)
    {
        return view('dashboard.admin.category.edit', [
            'title' => 'Manajemen Kategori',
            'category' => $categories_management,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $categories_management)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'description' => ['required'],
        ], [
            'name.required' => 'Judul harus diisi.',
            'name.min' => 'Judul minimal harus memiliki 3 karakter.',
            'name.max' => 'Judul maksimal harus memiliki 100 karakter.',
            'description.required' => 'Deskripsi harus diisi.',
        ]);

        // Update the book record
        $categories_management->update($validatedData);
        return redirect('/categories-management')->with('successEdit', "Kategori berhasil diperbarui!");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $categories_management)
    {
        Category::destroy($categories_management->id);
        return redirect('/categories-management')->with('successDelete', 'Kategori Buku berhasil dihapus!');
    }
}
