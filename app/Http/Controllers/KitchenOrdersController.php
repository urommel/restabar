<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;

class KitchenOrdersController extends Controller
{
    //
    public function index(Request $request)
    {

        $pendingOrders = Order::with(['menuEntry', 'table'])
            ->where('status', OrderStatus::PENDING)
            ->get();
        if ($request ->wantsJson()){
            return  $pendingOrders;
        }


        return view('kitchen.index', [
            'pendingOrders' => $pendingOrders,
            'inProgressOrders' => Order::with(['menuEntry', 'table'])
                ->where('status', OrderStatus::IN_PROGRESS)
                ->get(),
            'completedOrders' => Order::with(['menuEntry', 'table'])
                ->where('status', OrderStatus::COMPLETED)
                ->get(),
            'orderStatus' => OrderStatus::toArray(),
        ]);
    }
}
