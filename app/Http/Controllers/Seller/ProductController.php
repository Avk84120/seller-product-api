<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Validation\ValidationException;
// use Barryvdh\DomPDF\Facade\Pdf;


class ProductController extends Controller
{
public function index()
{
    return Product::with('brands')
        ->where('seller_id',auth()->id())
        ->paginate(10);
}


    public function store(Request $request)
{
    $request->validate([
        'name'=>'required',
        'description'=>'required',
        'brands'=>'required|array'
    ]);

    DB::transaction(function() use ($request) {
        $product = Product::create([
            'seller_id'=>auth()->id(),
            'name'=>$request->name,
            'description'=>$request->description
        ]);

        foreach ($request->brands as $brand) {
            Brand::create([
                'product_id'=>$product->id,
                'name'=>$brand['name'],
                'detail'=>$brand['detail'],
                'image'=>$brand['image'],
                'price'=>$brand['price'],
            ]);
        }
    });

    return response()->json(['message'=>'Product added'],201);
}

public function destroy($id)
{
    $product = Product::where('seller_id',auth()->id())->findOrFail($id);
    $product->delete();

    return response()->json(['message'=>'Product deleted']);
}


public function pdf($id)
{
    $product = Product::with('brand')->findOrFail($id);

    // Correct relation
    $price = $product->brand->price ?? 0;

    // Absolute path for DomPDF
    $image = null;
    if ($product->image && file_exists(public_path('storage/' . $product->image))) {
        $imagePath = public_path('storage/' . $product->image);
    }

    $pdf = Pdf::loadView('products.product_pdf', compact(
        'product',
        'price',
        'image'
    ));

    return $pdf->download('product.pdf');
}


}
