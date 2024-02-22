


<?php
function skuToGetProductLowestPrivce($product_id, $parent_id)
{
    //$result = \App\Models\Product::select('regular_price','sale_price')->where('sku', '=',$sku)->orderBy('sale_price','asc')->first();

    if ($parent_id == 0) {
        $result = \App\Models\Product::select('regular_price', 'sale_price')->where('id', '=', $product_id)->orderBy('sale_price', 'asc')->first();
        //    $result = \App\Models\Product::select('id','regular_price','sale_price')
        //         ->where(function ($query) use ($product_id) {
        //             $query->where('id', '=', $product_id)
        //                 ->orWhere('parent_id', '=', $product_id);
        //         })
        //     ->where('sale_price', '>', 0)
        //     ->orderBy('sale_price','asc')->first();
    } else {
        $result = \App\Models\Product::select('regular_price', 'sale_price')
            ->where(function ($query) use ($parent_id) {
                $query->where('id', '=', $parent_id)
                    ->orWhere('parent_id', '=', $parent_id);
            })
            ->where('sale_price', '>', 0)
            ->orderBy('sale_price', 'asc')->first();
    }
    return $result;
}

function ProcessingFeeCalculate($sub_total)
{
    $processiong = 0;
    if ($sub_total > 0) {
        $getShippingFee = \App\Models\Setting::select('*')->where('key', '=', 'fixed_shipping')->first();
        $stringValue = str_replace('"', '', $getShippingFee->value);
        $getShippingFees =  (int)$stringValue;
        if ($getShippingFees > 0) {
            $processiong = ($sub_total * $getShippingFees) / 100;
        }
    }
    return $processiong;
}

function thousand_format($number)
{
    $number = (int) preg_replace('/[^0-9]/', '', $number);
    if ($number >= 1000) {
        $rn = round($number);
        $format_number = number_format($rn);
        $ar_nbr = explode(',', $format_number);
        $x_parts = array('K', 'M', 'B', 'T', 'Q');
        $x_count_parts = count($ar_nbr) - 1;
        $dn = $ar_nbr[0] . ((int) $ar_nbr[1][0] !== 0 ? '.' . $ar_nbr[1][0] : '');
        $dn .= $x_parts[$x_count_parts - 1];

        return $dn;
    }
    return $number;
}

function checkProductIsOutOfStok($product_id)
{
    $totalsumProduct = \App\Models\ProductSize::where('product_id', $product_id)->where('flags', 1)->sum('quantity');
    $TotalChildProductsId = \App\Models\Product::where('parent_id', '=', $product_id)->pluck('id');
    $totalsumChildProduct = \App\Models\ProductSize::whereIn("product_id", $TotalChildProductsId)->where('flags', 1)->sum('quantity');
    $total_quantity = ($totalsumProduct + $totalsumChildProduct);
    return $total_quantity;
}


function delete_size_not_exits()
{
    $deletdProductsize = \App\Models\Size::where(function ($query) {
        $query->where('brand_id', '=', 0)
            ->orWhere('shop_category_id', '=', 0)
            ->orWhere('gender', '=', 0);
    })->pluck('id');
    // Size::query()->where('brand_id', '=', 0)->where('shop_category_id', '=', 0)->where('gender', '=', 0)->delete();
    \App\Models\Size::where(function ($query) {
        $query->where('brand_id', '=', 0)
            ->orWhere('shop_category_id', '=', 0)
            ->orWhere('gender', '=', 0);
    })->delete();
    \App\Models\ProductSize::whereIn('size_id', $deletdProductsize)->delete();
    return '';
}





function pre($array)
{
    echo '<pre>';
    print_r($array);
    die;
}


?>

