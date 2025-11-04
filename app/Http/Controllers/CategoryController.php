<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Route as FacadesRoute;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private string $title;
    private $model;
    public function __construct()
    {
        $this->model = new Category();
        $routeName = FacadesRoute::currentRouteName();
        $arr = explode(".", $routeName);
        $arr = array_map('ucfirst', $arr);
        $this->title = implode(' ', $arr);
        View::share('title', $this->title);
    }

    public function api()
    {
        return Datatables::of($this->model->withCount('products'))
            ->addColumn('created_at', function ($object) {
                return $object->created_at ? $object->created_at->format('d/m/Y H:i') : '';
            })
            ->addColumn('product_count', function ($object) {
                return $object->products_count;
            })
            ->addColumn('edit', function ($object) {
                return '<a href="' . route('categories.edit', $object->id) . '" class="btn btn-primary">Edit</a>';
            })
            ->addColumn('destroy', function ($object) {
                return '<form action="' . route('categories.destroy', $object->id) . '" method="POST" onsubmit="return confirm(\'Are you sure?\');">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger">Delete</button>'
                    . '</form>';
            })
            ->rawColumns(['edit', 'destroy']) // Cho phép hiển thị HTML
            ->make(true);
    }
    public function index()
    {
        return view('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $path = $request->file('image')->store('categories', 'public');
        $this->model::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $path,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = $this->model::findOrFail($id);
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, $id)
    {
        $category = $this->model::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path('storage/' . $category->image))) {
                unlink(public_path('storage/' . $category->image));
            }
            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('categories', 'public');
        } else {
            // Giữ nguyên ảnh cũ nếu không upload mới
            $imagePath = $category->image;
        }
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'image' => $imagePath,
        ]);
        return redirect()
            ->route('categories.index')
            ->with('success', 'Cập nhật danh mục thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = $this->model::findOrFail($id);
        $category->delete();

        return redirect()
            ->route('categories.index');
    }
}
