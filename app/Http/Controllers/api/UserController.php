<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function store(Request $request)
    {
        $users = new User();
        $query = User::where('email', $request->email);
        if(!$query->exists()){
            $users->name = $request->name;
            $users->email = $request->email;
            $users->cellphone = $request->cellphone;
            $users->password = $request->password;
            $users->street = $request->street;
            $users->neightboorHood = $request->neighborhood;
            $users->city = $request->city;
            $users->number = $request->number;
            $users->state = $request->state;
            $users->save();
            return response()->json([true,$request], 200);
        }else{
            return response()->json([false,
                "message" => "já tem alguem com esse email"
              ], 404);
        }

    }

    public function show(Request $request)
    {
        $query = User::where('email','=' , $request->email)->where('password', '=', $request->password);

        if($query->exists()){
            $user = $query->first();
            return response()->json( [true,$user], 200);
        }
        else{
            return response()->json( [false], 200);
        }
    }


    public function showTransaction($profile,$id)
    {
        $final = array();
        $transactions = array();
        if(User::where('id', $id)->exists()) {

            $user = User::where('id', $id)->first();

            if($profile == 'seller')
            {
                $transactions = $user->transactionSeller()->get();
            }elseif($profile == 'buyer'){
                $transactions = $user->transactionBuyer()->get();
            }
            elseif($profile == 'user'){
                return response()->json($user, 200);
            }
            else{
                return response()->json([
                    "message" => "profile transaction not found"
                  ], 404);
            }

            foreach ($transactions as $value) {
                $product = $value->products()->first();
                array_push($final , $product);
            }
            return response()->json([$user,$final],200);
          } else {
            return response()->json([
              "message" => "transactions not found"
            ], 404);
          }
        //
    }


    public function update(Request $request, $id)
    {
        if (User::where('id', $id)->exists()) {
            $userUpdate = User::find($id);
            $userUpdate->name = is_null($request->name) ? $userUpdate->name : $request->name;
            $userUpdate->email = is_null($request->email) ? $userUpdate->email : $request->email;
            $userUpdate->cellphone = is_null($request->cellphone) ? $userUpdate->cellphone : $request->cellphone;
            $userUpdate->password = is_null($request->password) ? $userUpdate->password : $request->password;
            $userUpdate->street = is_null($request->street) ? $userUpdate->street : $request->street;
            $userUpdate->neightboorHood = is_null($request->neighborhood) ? $userUpdate->neighborhood : $request->neighborhood;
            $userUpdate->number = is_null($request->number) ? $userUpdate->number : $request->number;
            $userUpdate->city = is_null($request->city) ? $userUpdate->city : $request->city;
            $userUpdate->state = is_null($request->state) ? $userUpdate->state : $request->state;
            $userUpdate->save();

            return response()->json( $request, 200);

            } else {

            return response()->json([
                "message" => "User not found"
            ], 404);

        }
    }

}
