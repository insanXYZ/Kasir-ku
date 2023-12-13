<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\tes;
use App\Models\History;
use App\Models\Product;
use App\Services\Impl\HistoryServiceImpl;
use App\Services\Impl\ProductServiceImpl;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public $productService;
    public $historyService;
    public function __construct(ProductServiceImpl $productServiceImpl, HistoryServiceImpl $historyServiceImpl){
        $this->productService = $productServiceImpl;
        $this->historyService = $historyServiceImpl;
    }
    public function create(ProductRequest $productRequest){
        $valid = $productRequest->validated();
        $valid["name"] = Str::slug($valid["name"]);
        $product = $this->productService->create($valid);
        $this->historyService->create("Tambah",$valid["barqode"]);
        return $product;
    }
    public function getAll(){
        return $this->productService->get();
    }  
    public function delete($id){
        $product = $this->productService->delete($id);
        $this->historyService->create("Hapus",$product["barqode"]);
        return $product;
    }
    public function update($id , ProductRequest $productRequest){
        $valid = $productRequest->validated();
        $product = $this->productService->update($id,$valid);
        Log::info($valid);
        $this->historyService->create("Perbarui",$valid["barqode"]);
        return $product;
    }
    public function cashier(Request $request){
        foreach ($request->product as $item) {
            $product = Product::where("barqode",$item["barqode"])->first();
            $product->update([
                "qty" => $product["qty"] - $item["amount"]
            ]);
        }

        $data = [
            "numberTransaction" => $request->numberTransaction,
            "product" => $request->desc,
            "price"=> $request->total,
            "money" => $request->money,
            "profit" => $request->profit,
        ];
        
        $this->historyService->create("Beli",null,$data);
    }
    public function dashboard(Request $request){

        $db = DB::table("histories")->where("type","Beli");

        if($request->getting == "day"){
            $histories = $db->whereBetween("created_at",[Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s') , Carbon::now()])->get();
            return response()->json([
                "income" => $histories->sum("price"),
                "profit" => $histories->sum("profit"),
                "histories"=> $histories,
                "total" => $histories->count(),
                "labels" => []
            ]);
        }

        if($request->getting == "week"){
            $histories = $db->whereBetween("created_at", [Carbon::now()->startOfWeek(), Carbon::now()])->oldest("created_at")->get();
            $grouped = $histories->groupBy(function($item, $key) {
                return Carbon::parse($item->created_at)->format('d-m');
            });  
            return response()->json([
                "income" => $histories->sum("price"),
                "profit" => $histories->sum("profit"),
                "histories"=> $histories,
                "total" => $histories->count(),
                "labels" => $grouped->keys(),
                "value" => $grouped->map(function($item) {
                    return $item->sum('price');
                })->values()
            ]);
        }

        if($request->getting == "month"){
            $histories = $db->whereBetween("created_at",[Carbon::now()->startOfMonth() , Carbon::now()])->oldest("created_at")->get();
            $grouped = $histories->groupBy(function($item, $key) {
                return Carbon::parse($item->created_at)->format('d-m');
            });  
            return response()->json([
                "income" => $histories->sum("price"),
                "profit" => $histories->sum("profit"),
                "histories"=> $histories,
                "total" => $histories->count(),
                "labels" => $grouped->keys(),
                "value" => $grouped->map(function($item) {
                    return $item->sum('price');
                })->values()
            ]);
        }

        if($request->has('start') && $request->has('end')){
            $histories = $db->whereBetween('created_at',[Carbon::parse($request->start)->setTime(0,0,0),Carbon::parse($request->end)->setTime(23,59,59)])->oldest("created_at")->get();
            $grouped = $histories->groupBy(function($item, $key) {
                return Carbon::parse($item->created_at)->format('d-m');
            });  
            return response()->json([
                "income" => $histories->sum("price"),
                "profit" => $histories->sum("profit"),
                "histories"=> $histories,
                "total" => $histories->count(),
                "labels" => $grouped->keys(),
                "value" => $grouped->map(function($item) {
                    return $item->sum('price');
                })->values()
            ]);
        }

        if($request->has("date")){
            $histories = $db->whereBetween('created_at',[Carbon::parse($request->date)->setTime(0,0),Carbon::parse($request->date)->setTime(23,59,59)])->get();
            return response()->json([
                "income" => $histories->sum("price"),
                "profit" => $histories->sum("profit"),
                "histories"=> $histories,
                "labels" => [],
                "total" => $histories->count()
            ]);
        }

        $histories = $db->whereBetween("created_at",[Carbon::now()->startOfMonth() , Carbon::now()])->oldest("created_at")->get();
        $grouped = $histories->groupBy(function($item, $key) {
            return Carbon::parse($item->created_at)->format('d-m');
        });     
        Log::info($grouped);
        return response()->json([
            "income" => $histories->sum("price"),
            "profit" => $histories->sum("profit"),
            "histories"=> $histories,
            "total" => $histories->count(),
            "labels" => $grouped->keys(),
            "value" => $grouped->map(function($item) {
                return $item->sum('price');
            })->values()
        ]);

    }
}
