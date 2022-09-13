<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function storeList()
    {
        $products = Store::all();
        $store = Store::with( 'products')->get();

        return response()->json(['store' =>  $store]);

    }


	

    public function Store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
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
            $store = new Store([
               'name' => $request->get('name'),
               'description' => $request->get('description')
            ]);
            $store->save();

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




    public function Update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
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
            $store = Store::find($request->get('id'));
            $store->update([
                'name' => $request->get('name'),
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
            $store = store::find($request->get('id'));
            $store->delete();

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
