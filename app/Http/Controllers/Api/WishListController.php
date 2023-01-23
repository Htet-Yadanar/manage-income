<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Income;
use App\Models\WishList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    //
    public function wish_list(Request $request){
        $user_id = $request->user_id;
        //dd($user_id);
        $name = $request->name;
        $price = $request->price;
        if($name == null && $price == null){
            return response()->json([
                'message' => 'please enter item name and price',
                'status'  => '300'
            ]);
        }
        if($name == null){
            return response()->json([
                'message' => 'please enter item name ',
                'status'  => '301'
            ]);
        }
        if($price == null){
            return response()->json([
                'message' => 'please enter item price ',
                'status'  => '302'
            ]);
        }
        if($price == 0){
            return response()->json([
                'message' => 'cannot enter 0 for pice',
                'status'  => '400'
            ]);
        }
        $save_wishlist = New WishList();
        $save_wishlist->name = $name;
        $save_wishlist->price = $price;
        $save_wishlist->user_id = $user_id;
        $save_wishlist->save();
      
        return response()->json([
            'message' => 'success',
            'status' => '200'
        ]);
    }

    public function lists(){
         $user_id =auth()->user()->id;
         $wishlist = WishList::where('user_id',$user_id)->paginate(10);
         return response()->json([
            'data' => $wishlist
        ]);
    }

    public function edit_wish_list(Request $request){
        $edit_wish_list = WishList::where('id',$request->id)->first();
        return response()->json([
           'data' => $edit_wish_list
       ]);
    }

    public function update_wish_list(Request $request){
        $update_wish_list = WishList::findOrFail($request->id);
        $update_wish_list->name = $request->name;
        $update_wish_list->price = $request->price;
        $update_wish_list->update();
        return response()->json([
           'message' => 'success'
       ]);
    }

    public function delete_wish_list(Request $request){
        WishList::find($request->id)->delete($request->id);
        return response()->json([
           'message' => 'deleted'
       ]);
   }

   public function manage_list(){
    $user_id =auth()->user()->id;
    $month = Income::select('month','total_extra_money')->where('user_id',$user_id)->get();
    foreach($month as $key=>$m){
        $month[$key]['itemname'] = "";
        $month[$key]['total'] = "";
        $wishList_id = WishList::select('name','price','id')->where('user_id',$user_id)
                    ->where('price','<=',$m->total_extra_money)
                    ->get();
        $month[$key]['itemname'] =  $wishList_id;
    }
    return response()->json([
        'data' => $month
    ]);
   }
}
