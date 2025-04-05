<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\MenuEntry;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class TakeOrdersController extends Controller
{
    public function create(Table $table)
    {
//        dd(MenuEntry::get()->toJson());

        return view('take-orders.create', [
            'tables' => Table::get(),
            'selectedTable' => $table->load('orders.menuEntry'),
            'menuEntries' => MenuEntry::get(),
        ]);
    }

    public function store(Table $table, Request $request)
    {
        $order = Order::create([
            'table_id' => $table->id,
            'menu_entry_id' => $request->input('menu_entry_id'),
            'quantity' => $request->input('quantity'),
            'notes' => "",
            'status' => OrderStatus::PENDING
        ]);

        return $order->load('menuEntry');

    }

    public function update(Order $order, Request $request)
    {
        $order->update([
            'quantity' => $request->input('quantity', $order->quantity),
            'notes' => $request->input('notes', $order->note),
        ]);

        if($order->quantity <= 0) {
            $order->delete();
        }

        return $order;
    }
}
