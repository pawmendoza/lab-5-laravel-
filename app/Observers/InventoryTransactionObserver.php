<?php

namespace App\Observers;

use App\Models\InventoryTransaction;
use App\Models\User;
use App\Notifications\LowStockNotification;

class InventoryTransactionObserver
{
    public function created(InventoryTransaction $transaction): void
    {
        $product = $transaction->product;

        if (! $product) {
            return;
        }

        $qtyChange = $transaction->quantity;

        if ($transaction->type === 'stock_in') {
            $product->quantity += $qtyChange;
        } elseif ($transaction->type === 'stock_out') {
            $product->quantity -= $qtyChange;
        } elseif ($transaction->type === 'adjustment') {
            $product->quantity = $qtyChange;
        }

        $product->save();

        if ($product->quantity <= $product->reorder_level) {
            $admins = User::all();
            foreach ($admins as $admin) {
                $admin->notify(new LowStockNotification($product));
            }
        }
    }
}