<?php

namespace App\Http\Controllers\api;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {   

        $transactions = Transaction::get()->toJson(JSON_PRETTY_PRINT);
        return response($transactions, 200);
        
    }

    public function store(Request $request)
    {
        $transactions = new Transaction();
        $transactions->seller_id = $request->seller_id;
        $transactions->buyer_id = $request->buyer_id;
        $transactions->product_id = $request->product_id;
        $transactions->save();
        return response()->json([
            "message" => "Transaction record created"
        ], 200);
    }

    public function show($id)
    {

      if(Transaction::where('email', $id)->exists()) {
            $transactions = Transaction::where('id', $id)->first();
            $transaction = $transactions->products()->get();
            return response($transaction, 200);
          } else {
            return response()->json([
              "message" => "transactions not found"
            ], 200);
          }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
