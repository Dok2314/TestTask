<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withTrashed()->paginate(5);

        return view('CRUD.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('CRUD.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     */
    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $category = Category::create([
                'title'  => $request->input('title'),
                'slug'   => Str::slug($request->input('title'))
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage())
                ->withInput();
        }

        DB::commit();

        return redirect()->route('categories.index')
            ->with('success',
                sprintf('Категория "%s" успешно создана!',
                    $category->title
                ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('CRUD.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('CRUD.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $title = $request->input('title');

        $category->update([
            'title' => $title,
            'slug'  => Str::slug($title)
        ]);

        return  redirect()->route('categories.index')->with('success', 'Категория успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return  redirect()->route('categories.index')->with('success', 'Категория успешно удалена!');
    }

    public function restore($id)
    {
        Category::withTrashed()
            ->find($id)
            ->restore();

        return redirect()->back()->with('success', 'Категория успешно востановлена!');
    }
}
