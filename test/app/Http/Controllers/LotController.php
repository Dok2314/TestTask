<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lots = Lot::withTrashed()->paginate(5);

        return view('CRUD.lots.index', compact('lots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('CRUD.lots.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $lot = Lot::firstOrCreate([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);

            $lot->categories()->sync($request->categories);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('lots.index')
            ->with('success',
                sprintf('Лот "%s" успешно создан!',
                    $lot->title
                ));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lot = Lot::findOrFail($id);

        return view('CRUD.lots.show', compact('lot'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lot        = Lot::findOrFail($id);
        $categories = Category::all();

        return view('CRUD.lots.edit', compact('lot', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lot = Lot::findOrFail($id);

        $lot->update([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);

        $lot->categories()->sync($request->input('categories'));

        return redirect()->route('lots.index')->with('success', 'Лот успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lot = Lot::findOrFail($id);

        $lot->delete();

        return redirect()->route('lots.index')->with('success', 'Лот успешно удален!');
    }

    public function restore($id)
    {
        Lot::withTrashed()
            ->find($id)
            ->restore();

        return redirect()->back()->with('success', 'Лот успешно востановлен!');
    }
}
