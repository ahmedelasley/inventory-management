<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "creating" event.
     */
    public function creating(Product $product): void
    {
        $product->created_id = auth()->guard('admin')->user()->id ?? null; // Ensure this is not null
        // $product->save();
    }

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $product->created_id = auth()->guard('admin')->user()->id ?? null; // Ensure this is not null
        $product->save();
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
