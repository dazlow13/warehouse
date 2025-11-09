<?php

namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\Support\Facades\View;
use App\Models\Product;
class InventoryController extends Controller
{
    private $model;
    public $title;
    public function __construct()
    {
        $this->model = new Product();
        $routeName = FacadesRoute::currentRouteName();
        $arr = explode(".", $routeName);
        $arr = array_map('ucfirst', $arr);
        $this->title = implode(' ', $arr);
        View::share('title', $this->title);
    }
    public function api()
    {
        return Datatables::of($this->model->with(['category', 'manufacturer'])->select('products.*'))
            ->editColumn('created_at', function ($product) {
                return $product->created_at ? $product->created_at->format('d/m/Y H:i') : '';
            })
            ->addColumn('category_name', function ($product) {
                return $product->category ? $product->category->name : 'Không xác định';
            })
            ->addColumn('manufacturer_name', function ($product) {
                return $product->manufacturer ? $product->manufacturer->name : 'Không xác định';
            })
            ->addColumn('quantity_status', function ($row) {
                if ($row->quantity <= 0)
                    return '<span class="badge bg-danger">Hết hàng</span>';
                elseif ($row->quantity <= 10)
                    return '<span class="badge bg-warning text-dark">' . $row->quantity . '</span>';
                else
                    return '<span class="badge bg-success">' . $row->quantity . '</span>';
            })
            ->editColumn('sale_price', fn($row) => '$' . number_format($row->sale_price, 0, ',', '.'))
            ->rawColumns(['quantity_status'])
            ->make(true);
    }
    public function index()
    {
        return view('inventory.index');
    }
}
