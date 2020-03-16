<?php

namespace App\Http\Controllers\Admin;

use App\ConstManager\ConstManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CategoryRequest;
use App\Model\Category;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\Models\Media;

class CategoryController extends Controller
{

    protected $model;

    public function __construct(Category $model)
    {
        $this->middleware('auth');
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('list-category')) {
            $data = $this->model->paginate(ConstManager::PAGINATE);
            return view('backend.categories.index', compact('data'));
        } else {
            return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('add-category')) {
            return view('backend.categories.create');
        } else {
            return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            if (auth()->user()->can('add-category')) {
                $this->model->create($request->all());
                $message = sprintf('%s has been crated successfully', $request->title);
                DB::commit();
                return redirect()->route('admin.category.index')->withSuccess($message);
            } else {
                DB::rollBack();
                return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
            }
        } catch (Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            if (auth()->user()->can('list-category')) {
                $data = $this->model->findOrFail($id);
                return view('backend.categories.edit', compact('data'));
            } else {
                return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
            }
        } catch (Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            DB::beginTransaction();
            if (auth()->user()->can('update-category')) {
                $media = Media::whereModelType(Category::class)->whereModelId($category->id)->first();
                if (exists_and_blank($media)) {
                    $media->delete();
                }
                $category->update($request->all());
                $category->addMedia(public_path(ConstManager::UPLOAD_FOLDER) . $request->get('logo'))
                    ->preservingOriginal()
                    ->toMediaCollection();
                DB::commit();
                return redirect()->route('admin.category.index')->withSuccess($request->title . __('core.update_success'));
            } else {
                DB::rollBack();
                return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
            }
        } catch (Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();
            if (auth()->user()->can('destroy-category')) {
                $name = $category->title;
                $category->delete();
                DB::commit();
                return redirect()->route('admin.category.index')->withSuccess($name . __('core.delete_success'));
            } else {
                DB::rollBack();
                return redirect()->route('admin.dashboard')->withInfo('Permission denied!');
            }
        } catch (Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
