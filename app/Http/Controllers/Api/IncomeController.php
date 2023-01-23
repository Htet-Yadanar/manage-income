<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IncomeController extends Controller
{
    //
    public function save_income(Request $request){
        $user_id =  $request->user_id;
        $income = $request->income;
        $month = $request->month;
        $total_extra = DB::table('incomes')
                ->select('total_extra_money')
                ->where('user_id',$user_id)
                ->latest()
                ->first();
        // $month  = Carbon::Now()->format('M');
        //$check = Income::where('user_id',$user_id)->where('month',$month)->first();
       
        if($income == null){
            return response()->json([
                'message' => 'please enter your income',
                'status'  => '300'
            ]);
        }
        else if($month == null){
            return response()->json([
                'message' => 'please select month',
                'status'  => '301'
            ]);
        }
        else if($income == 0){
            return response()->json([
                'message' => 'cannot enter 0',
                'status'  => '400'
            ]);
        }
        // else if($check){
        //     return response()->json([
        //         'message' => 'update',
        //         'status'  => '333'
        //     ]);
        // }
        else{
            $save_income = New Income();
            $save_income->income = $income;
            $save_income->save_money = $income * 0.1;
            $save_income->tax_money = $income * 0.1;
            $save_income->general_expenses = $income * 0.6;
            $save_income->extra_money = $income * 0.2;
            if($total_extra){
                $save_income->total_extra_money = ($income * 0.2) + $total_extra->total_extra_money ;
            }
            else{
                $save_income->total_extra_money = $income * 0.2;
            }
            
            $save_income->month = $month;
            $save_income->user_id = $user_id;
            $save_income->save();
        }
        return response()->json([
            'message' => $month,
            'status' => '200'
        ]);
    }
    public function update_income(Request $request){
            $user_id =  $request->data['user_id'];
            $income = $request->data['income'];
            $month = $request->data['month'];
            $check = Income::where('user_id',$user_id)->where('month',$month)->first();
            $total_extra = DB::table('incomes')
            ->select('total_extra_money')
            ->where('user_id',$user_id)
            ->where('id','!=',$check->id)
            ->latest()
            ->first();
            $update_income =  Income::findOrFail($check->id);
            $update_income->income = $income;
            $update_income->save_money = $income * 0.1;
            $update_income->tax_money = $income * 0.1;
            $update_income->general_expenses = $income * 0.6;
            $update_income->extra_money = $income * 0.2;
            if($total_extra){
                $update_income->total_extra_money = ($income * 0.2) + $total_extra->total_extra_money ;
            }
            else{
                $update_income->total_extra_money = $income * 0.2;
            }
            $update_income->update();
            return response()->json([
                'message' => $update_income,
                'status' => '200'
            ]);
    }
}
