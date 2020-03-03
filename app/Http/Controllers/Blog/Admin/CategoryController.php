<?php

namespace App\Http\Controllers\Blog\Admin;


use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;


class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(15);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $item = new BlogCategory();

        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit',
        compact('item', 'categoryList'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }
        // Создает объект но не добавлят в БД
        $item = new BlogCategory($data);
        dd($item);
        $item->save();

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {



        $item = BlogCategory::findOrFail($id);
       // dd(collect($item)->pluck('id'));
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit',
        compact('item',  'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        /*
        $rules = [
            'title'         =>  'required|min:5|max:200',
            'slug'          =>  'max:200',
            'description'   =>  'string|max:500|min:3',
            'parent_id'     =>  'required|integer|exists:blog_categories,id',
        ];
           */

       // $validatedData = $this->validate($request, $rules);
       // $validatedData = $request->validate($rules);
   // dd($validatedData);
   /*
    $validator = \Validator::make($request->all(), $rules);
    $validateData[] = $validator->passes();
   // $validateData[] = $validator->validate();
        $validateData[] = $validator->valid();
        $validateData[] = $validator->failed();
        $validateData[] = $validator->errors();
        $validateData[] = $validator->fails();
       // dd($validateData);
*/

        $item = BlogCategory::find($id);
// dd($item);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }
        $data = $request->all();
//dd($request);
        $result = $item
            ->fill($data)
            ->save();

        if ($result) {
            return redirect()

                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        }else{
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }


}
