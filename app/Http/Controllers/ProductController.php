<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function productList()
    {
        $products = Product::all();

        return $products;


        return response()->json([
            'products' => $products
         ]);

    //     $role = Store::find(1);	
 
    //    dd($role->products);
    }


    public function Store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Məlumatı daxil etmək mümkün olmadı.',
                'code' => 400,
                'errors' => $validator->errors()
            ], 400);
        }
        try {
            $product = new Product([
               'name' => $request->get('name'),
               'type' => $request->get('type'),
               'price' => $request->get('price'),
                'description' => $request->get('description')
            ]);
            $product->save();

            return response()->json([
               'message' => 'əlavə olundu.',
               'code' => 201
            ], 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'message' => $ex->getMessage(),
                'code' => 400,
            ], 400);
        }
    }


    public function Update(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Məlumatı daxil etmək mümkün olmadı.',
                'code' => 400,
                'errors' => $validator->errors()
            ], 400);
        }
        try {
            $product = Product::find($request->get('id'));
            $product->update([
                'name' => $request->get('name'),
                'type' => $request->get('type'),
                'price' => $request->get('price'),
                'description' => $request->get('description'),
            ]);

            return response()->json([
               'message' => ' məlumatları yeniləndi.',
               'code' => 202
            ], 202);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'message' => $ex->getMessage(),
                'code' => 400,
            ], 400);
        }
    }



    public function Delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Məlumat silinə bilmədi',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $product = Product::find($request->get('id'));
            $product->delete();

            return response()->json([
                'message' => 'Məlumat silindi'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }

    }
} 