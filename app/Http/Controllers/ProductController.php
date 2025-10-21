<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Route as FacadesRoute;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private string $title;
    private $model;
    public function __construct()
    {
        $this->model = new Product();
        $routeName = FacadesRoute::currentRouteName();
        $arr = explode(".", $routeName);
        $arr = array_map('ucfirst', $arr);
        $this->title = implode(' ', $arr);
        View::share('title', $this->title);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function api()
    {
        return Datatables()->of($this->model->with(['category', 'manufacturer']))
            ->editColumn('cost_price', function ($product) {
                return '$' . number_format($product->cost_price, 2);
            })
            ->editColumn('sale_price', function ($product) {
                return '$' . number_format($product->sale_price, 2);
            })
            ->addColumn('category_name', function ($product) {
                return $product->category ? $product->category->name : 'Không xác định';
            })
            ->addColumn('manufacturer_name', function ($product) {
                return $product->manufacturer ? $product->manufacturer->name : 'Không xác định';
            })
            ->editColumn('created_at', function ($product) {
                return $product->created_at ? $product->created_at->format('d/m/Y H:i') : '';
            })
            ->addColumn('edit', function ($product) {
                return '<a href="' . route('products.edit', $product->id) . '" class="btn btn-primary">Edit</a>';
            })
            ->addColumn('destroy', function ($product) {
                return '<form action="' . route('products.destroy', $product->id) . '" method="POST" onsubmit="return confirm(\'Are you sure?\');">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger">Delete</button>'
                    . '</form>';
            })
            ->rawColumns(['edit', 'destroy', 'category_name', 'manufacturer_name']) // Cho phép hiển thị HTML
            ->make(true);
    }
    public function index()
    {
        return view('products.index');
    }
    public function create()
    {
        $categories = Category::query()->get();
        $manufacturers = Manufacturer::query()->get();
        return view('products.create', compact('categories', 'manufacturers'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        // Nếu có upload ảnh (tùy bạn có dùng hay không)
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        
        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, $id)
    {
        $product = $this->model->findOrFail($id);

        $data = $request->validated(); // Lấy dữ liệu hợp lệ
        dd($data);
        $product->update($data); // Cập nhật sản phẩm

        return redirect()->route('products.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = $this->model->findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
