<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
 use App\Repositories\BlogCategoryRepository;
 use Illuminate\Support\Str;


/**
 * Class CategoryController
 * @package App\Http\Controllers\Blog\Admin
 */

class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository|\Illuminate\Contracts\Foundation\Application
     */
    private $blogCategoryRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function __construct()
    {
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    public function index()
    {
      //  $paginator = BlogCategory::paginate(15);
       $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);

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

        $categoryList
            = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
        compact('item', 'categoryList'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = str::slug($data['title']);
        }

        // Создает объект но не добавлят в БД
//        $item = new BlogCategory($data);
//        $item->save();
        // Создает объект но не добавлят в БД
        $item = (new BlogCategory())->create($data);

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
     * @param int $id
     * @param BlogCategoryRepository $categoryReposytory
     * @param $categoryRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
   //   $item = BlogCategory::findOrFail($id);
    //   $categoryList = BlogCategory::all();

        $item = $categoryRepository->getEdit($id);
        if(empty($item)) {
          abort(404);
        }
        $categoryList = $categoryRepository->getForComboBox();

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


        $item = BlogCategory::find($id);
// dd($item);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }
        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = str::slug($data['title']);
        }
//dd($request);
        $result = $item->update($data);


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
