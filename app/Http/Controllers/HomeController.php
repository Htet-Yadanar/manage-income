<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index(){
        return view('index');
    }
    public function wish_list(){
        $user_id =auth()->user()->id;
        $data = WishList::where('user_id',$user_id)->paginate(10);
        return view('wishlist',compact('data'));
    }

    public function manage(){
        $user_id =auth()->user()->id;
               
        $data = Income::select('month','total_extra_money')->where('user_id',$user_id)->get();
        foreach($data as $key=>$m){
            $data[$key]['itemname'] = "";
            $data[$key]['total'] = "";
            $wishList_id = WishList::select('name','price','id')->where('user_id',$user_id)
                        ->where('price','<=',$m->total_extra_money)
                        ->get();
            $data[$key]['itemname'] =  $wishList_id;
            //     if(count($wishList_id) > 0  ){
            //         $output_array=array();
            //         $work_array=array();
            //         $sum=0;
            //        // sort($wishList,SORT_NUMERIC);
            //         if(count($wishList_id)>0) {
            //             $sum = array_sum($work_array) + array_sum(array_column($wishList_id, 'price') );
            //           // dd($sum,$m->total_extra_money);
            //             if($m->total_extra_money <= $sum) {
            //                 $work_array[] = array_pop($wishList_id);
            //             } 
            //             else{
            //                 $output_array[]=$work_array;
            //                 $work_array=array();
            //             }
            //         }
                
            //        // return $work_array;
            //        $month[$key]['itemname'] = $wishList_id;
            //     }
             
            // // }

            // $wishList = WishList::where('user_id',$user_id)
            //             ->where('price','<=',$m->total_extra_money)
            //             ->pluck('price')->toArray();
                       
        }
        //  dd($data->wishList->toArray());
        return view('manageincome',compact('data'));
    }
}
