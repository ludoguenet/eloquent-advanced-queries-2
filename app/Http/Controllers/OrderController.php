<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Order::find(1)->orderItems->sum(fn(OrderItem $orderItem) => $orderItem->price * $orderItem->quantity)

        // Prix par quantité avec withSum
        // dd(Order::withSum(
        //     'orderItems', DB::raw('order_items.price * order_items.quantity')
        // )->get());

        // Pré-chargé une Sum avec contraintes
        // $itemPrice = Order::find(1)->item_price;

        // dd($itemPrice);
        // $itemPrice = Order::first()->loadSum([
        //     'orderItems' => fn ($q) => $q->where('price', '>', 7000)
        // ], 'price');

        // AddSelect: si dans le cas où on veut faire un calcul et qu'un helper Laravel n'est pas prévu!
        //  Where ? WhereColumn : dd pour montrer
        // dd(
        //     Order::addSelect([
        //         'total_order_items' => OrderItem::selectRaw('count(id)')
        //             ->whereColumn('order_items.order_id', 'orders.id')
        //     ])->get()
        // );

        // Récupérer uniquement les colonnes utilisées en fonctions d'agrégat.
        $orders = Order::select([
            'id',
            'label',
            DB::raw("DATE_FORMAT(orders.created_at, '%Y-%m') AS date_month"),
            DB::raw("COUNT(orders.id) AS orders_count"),
            DB::raw("SUM(orders.total_paid_amount) AS total_paid_amounts"),
        ])
        ->addSelect(['total_order_items_price' => OrderItem::selectRaw('SUM(price*quantity)')->whereColumn('order_items.order_id', 'orders.id')])
        ->groupBy('date_month')
        ->groupBy('label')
        ->orderByDesc('date_month')
        ->get();

        // dd($orders);

        // [
        //     'janv' => [
        //         'Gro' => ...,
        //         'Ant' => ...,
        //     ],
        //     'fev' => [
        //         'Gro' => ...,
        //         'Ant' => ...,
        //     ],
        // ]

        // dd($orders);

        $grouped = [];

        $orders->map(function (Order $order) use (&$grouped) {
            $grouped[$order->date_month][$order->label] = [
                'orders_count' => $order->orders_count,
                'total_paid_amounts' =>$order->total_paid_amounts
            ];
        });

        dd($grouped);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
