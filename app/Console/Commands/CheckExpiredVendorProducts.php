<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon as Carbon;
use App\Models\Product;


class CheckExpiredVendorProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vendor:expired-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will check the vendor products are expired or not, if expired than in active the product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $vendorProducts = Product::whereNotNull('vendor_id')->get();
        foreach ($vendorProducts as $product) {
            if (Carbon::parse($product->expiry_date)->format('Y-m-d') < Carbon::now()->format('Y-m-d')) {
                $product->flags = 0;
                $product->save();
            }
        }

        echo 'vendor products are updated successfully';
        
        return true;
    }
}
