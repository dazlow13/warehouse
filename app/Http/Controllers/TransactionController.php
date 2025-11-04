<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Product;
use App\Models\TransactionDetail;
use App\Http\Requests\StoreTransactionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private string $title;
    private $model;
    public function __construct()
    {
        $this->model = new Transaction();
        $routeName = FacadesRoute::currentRouteName();
        $arr = explode(".", $routeName);
        $arr = array_map('ucfirst', $arr);
        $this->title = implode(' ', $arr);
        View::share('title', $this->title);
    }

    public function api()
    {
        return DataTables::of($this->model->with(['user', 'details.product'])->select('transactions.*'))
            ->addColumn('user', function ($row) {
                return $row->user ? $row->user->name : 'N/A';
            })
            ->addColumn('product_name', function ($row) {
                return $row->details->map(fn($d) => $d->product_name)->implode(', ');
            })
            ->addColumn('total_items', function ($row) {
                return $row->details->sum('quantity');
            })
            ->addColumn('total_amount_formatted', function ($row) {
                return '$' . number_format($row->total_amount);
            })
            ->addColumn('type_label', function ($row) {
                return $row->type === 'import'
                    ? '<span class="badge bg-success">Nhập kho</span>'
                    : '<span class="badge bg-danger">Xuất kho</span>';
            })
            ->addColumn('created_at_formatted', function ($row) {
                return $row->created_at->format('d/m/Y H:i');
            })
            ->addColumn('action', function ($row) {
                $viewUrl = route('transactions.show', $row->id);
                $printUrl = route('transactions.print', $row->id);
                
            return '
                <a href="' . $viewUrl . '" class="btn btn-sm btn-info" title="Xem">
                    Xem
                </a>
                <a href="' . $printUrl . '" target="_blank" class="btn btn-sm btn-secondary" title="In">
                    In
                </a>
            ';
            })
            ->rawColumns(['type_label', 'action']) // Cho phép hiển thị HTML
            ->make(true);
    }
    public function print(Transaction $transaction)
    {
        $transaction->load('user', 'details.product.manufacturer');
        $pdf = Pdf::loadView('transactions.print', compact('transaction'));
        return $pdf->stream('phieu-' . $transaction->code . '.pdf');
    }

    public function index()
    {
        return view('transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::with(['category','manufacturer'])->get();
        return view('transactions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        return DB::transaction(function () use ($request) {
        // 1. Tạo phiếu
        $transaction = Transaction::create([
            'code' => Transaction::generateUniqueCode($request->type),
            'user_id' => Auth::id(),
            'type' => $request->type,
            'note' => $request->note,
            'quantity' => 0,
            'total_amount' => 0,
        ]);

        $totalQty = 0;
        $totalAmount = 0;

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);

            // Kiểm tra tồn kho (xuất kho)
            if ($request->type === 'export' && $product->quantity < $item['quantity']) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'items' => "Sản phẩm '{$product->name}' chỉ còn {$product->quantity} trong kho!"
                ]);
            }

            // Tạo chi tiết
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'manufacturer_id' => $product->manufacturer_id,
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
            ]);

            $totalQty += $item['quantity'];
            $totalAmount += $item['quantity'] * $item['unit_price'];

            // Cập nhật tồn kho
            $request->type === 'import'
                ? $product->increment('quantity', $item['quantity'])
                : $product->decrement('quantity', $item['quantity']);
        }

        // Cập nhật tổng
        $transaction->update([
            'quantity' => $totalQty,
            'total_amount' => $totalAmount,
        ]);

        return redirect()
            ->route('transactions.show', $transaction)
            ->with('success', 'Tạo phiếu thành công!');
    });
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load('user', 'details.product.manufacturer');
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
