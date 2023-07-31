<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\Create;
use App\Http\Requests\Admin\News\Edit;
use App\Models\Category;
use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('admin.news.index', [
            'newsList' => News::query()
                ->status()
                ->with('category')
                ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.news.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Create $request)
    {
       $news = new News($request->validated());

       if ($news->save()) {
           return redirect()->route('admin.news.index')->with('success', __('News was saved successfully'));
       }

       return back()->with('error', __('We can not save item, pleas try again'));
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return response()->json($this->getNews(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        return view('admin.news.edit', [
            'categories' => $categories,
            'news' => $news,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Edit $request, News $news)
    {
        $news = $news->fill($request->validated());

        if ($news->save()) {
            return redirect()->route('admin.news.index')->with('success', __('News was saved successfully'));
        }

        return back()->with('error', __('We can not save item, pleas try again'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): JsonResponse
    {
        try{
            $news->delete();

            return response()->json('ok');

        } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return response()->json('error', 400);
        }
    }
}
