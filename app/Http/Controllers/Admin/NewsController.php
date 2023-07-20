<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $news = app(News::class);

       /* dd(
            DB::table('news')
            ->join('categories', 'categories.id', '=', 'news.category_id')
            ->select('news.*', 'categories.title as categoryTitle')
            ->get()
        ); */

        dd(
            DB::table('news')
                ->whereNotBetween('id', [3,6])
                /*->where('id', '=', 3)
                ->Orwhere('title', 'like', '%'. $request->query('q') .'%')*/
                ->get()
        );

        return view('admin.news.index', [
            'newsList' => $news->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

       return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($this->getNews(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
