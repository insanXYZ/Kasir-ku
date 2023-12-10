<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProductRequest;
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
    public function dashboard(){
        $data = DB::table("histories");
        return response()->json([
            "income_today" => $data->get()->whereBetween('created_at', [Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s'), Carbon::now()->setTime(23,59,59)->format('Y-m-d H:i:s')])->sum("price"),
            "income_yesterday" => $data->get()->whereBetween('created_at', [Carbon::yesterday()->setTime(0,0)->format('Y-m-d H:i:s'), Carbon::yesterday()->setTime(23,59,59)->format('Y-m-d H:i:s')])->sum("price"),
            "transaction_today" => $data->get()->where("type","Beli")->whereBetween('created_at', [Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s'), Carbon::now()->setTime(23,59,59)->format('Y-m-d H:i:s')])->count(),
            "histories" => $data->where("type","Beli")->whereBetween('created_at', [Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s'), Carbon::now()->setTime(23,59,59)->format('Y-m-d H:i:s')])->orderBy("id","desc")->lazy(5)
        ]);
    }
    public function transaction(Request $request){

        $db = DB::table("histories")->where("type","Beli")->get();

        if($request->getting == "day"){
            $histories = $db->whereBetween("created_at",[Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s') , Carbon::now()]);
            return response()->json([
                "income" => $histories->sum("price"),
                "profit" => $histories->sum("profit"),
                "histories"=> $histories,
                "total" => $histories->count()
            ]);
        }

        if($request->getting == "week"){
            $histories = $db->whereBetween("created_at",[Carbon::now()->startOfWeek() , Carbon::now()]);
            return response()->json([
                "income" => $histories->sum("price"),
                "profit" => $histories->sum("profit"),
                "histories"=> $histories,
                "total" => $histories->count()
            ]);
        }

        if($request->getting == "month"){
            $histories = $db->whereBetween("created_at",[Carbon::now()->startOfMonth() , Carbon::now()]);
            return response()->json([
                "income" => $histories->sum("price"),
                "profit" => $histories->sum("profit"),
                "histories"=> $histories,
                "total" => $histories->count()
            ]);
        }

        if($request->has('start') && $request->has('end')){
            $histories = $db->whereBetween('created_at',[Carbon::parse($request->start)->setTime(0,0,0),Carbon::parse($request->end)->setTime(23,59,59)]);
            return response()->json([
                "income" => $histories->sum("price"),
                "profit" => $histories->sum("profit"),
                "histories"=> $histories,
                "total" => $histories->count()
            ]);
        }

        if($request->has("date")){
            $histories = $db->whereBetween('created_at',[Carbon::parse($request->date)->setTime(0,0),Carbon::parse($request->date)->setTime(23,59,59)]);
            return response()->json([
                "income" => $histories->sum("price"),
                "profit" => $histories->sum("profit"),
                "histories"=> $histories,
                "total" => $histories->count()
            ]);
        }

        $histories = $db->whereBetween("created_at",[Carbon::now()->startOfMonth() , Carbon::now()]);

        return response()->json([
            "income" => $histories->sum("price"),
            "profit" => $histories->sum("profit"),
            "histories"=> $histories,
            "total" => $histories->count()
        ]);

    }
}
