<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Http\Requests\StoreManufacturerRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route as FacadesRoute;
class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private string $title;
    private $model;
    public function __construct()
    {
        $this->model = new Manufacturer();
        $routeName = FacadesRoute::currentRouteName();
        $arr = explode(".", $routeName);
        $arr = array_map('ucfirst', $arr);
        $this->title = implode(' ', $arr);
        View::share('title', $this->title);
    }

    public function api()
    {
        return DataTables::of($this->model->with('products'))

            ->addColumn('created_at', function ($object) {
                return $object->created_at ? $object->created_at->format('Y-m-d H:i:s') : '';
            })
            ->addColumn('edit', function ($object) {
                return '<a href="' . route('manufacturers.edit', $object->id) . '" class="btn btn-primary">Edit</a>';
            })
            ->addColumn('destroy', function ($object) {
                return '<form action="' . route('manufacturers.destroy', $object->id) . '" method="POST" onsubmit="return confirm(\'Are you sure?\');">'
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
        return view('manufacturers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manufacturers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreManufacturerRequest $request)
    {
        $this->model::create($request->validated());
        return redirect()->route('manufacturers.index')->with('success', 'Thêm nhà cung cấp thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $manufacturers = $this->model::findOrFail($id);
        return view('manufacturers.edit', ['manufacturer' => $manufacturers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreManufacturerRequest $request, $id)
    {
        $manufacturer = $this->model::findOrFail($id);
        $manufacturer->update($request->validated());

        return redirect()
            ->route('manufacturers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $manufacturer = $this->model::findOrFail($id);
        $manufacturer->delete();

        return redirect()
            ->route('manufacturers.index');
    }
}
