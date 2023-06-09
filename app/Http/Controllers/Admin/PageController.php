<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function showLogin(){
        return view('admin.auth.login');
    }
    public function login(){
        // return request()->all();
        request()->validate([
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        $cre = request()->only('email','password');//['email'=>"sample@gmail.com",'password'=>"password"]
        // $value = ;
        if(auth()->guard('admin')->attempt($cre)){
            return redirect('/admin')->with('success','Welcome Admin');
        }
        return redirect()->back()->with('error','Email And Password Doesnot Match!');


    }
    public function logout(){
        auth()->guard('admin')->logout();
        return redirect('/');
    }
    public function showDashboard(){
        $todayIncome = Income::whereDay('created_at',date('d'))->sum('amount');
        $todayOutcome = Outcome::whereDay('created_at',date('d'))->sum('amount');
        $user_count = User::count();
        $product_count = Product::count();

        $latest_users = User::latest()->take(5)->get();
        $under_three_products = Product::latest()->where('total_quantity','<=','3')->take(5)->get();

        //months
        $months = [date("F")];//['june']
        $yearMonth = [
            [
                "year" => date("Y"),
                "month" => date("m")
            ]
        ];

        //day-months
        $day_months = [date("F d")];//['june 07']
        $dayMonth[] = [
            "month" => date("m"),
            "day" => date("d")
        ];     

        for($i = 1; $i <= 5; $i++){
            //months
            $months[] = date("F",strtotime("-$i month"));           

            //day-months
            $day_months[] = date("F d",strtotime("-$i day"));  
            $dayMonth[] = [
                "month" => date("m",strtotime("-$i day")),
                "day" => date("d",strtotime("-$i day"))
            ];

            //year-months
            $yearMonth[] = [
                "year" => date("Y",strtotime("-$i month")),
                "month" => date("m",strtotime("-$i month"))
            ];            
        }

        //sale-count
        $sale_count = [];
        foreach($yearMonth as $ym){
            $sale_count[] = ProductOrder::whereYear('created_at',$ym['year'])->whereMonth('created_at',$ym['month'])->count();
        }

        //income-outcome
        $incomes = [];
        $outcomes = [];

        foreach($dayMonth as $dm){
            $incomes[] = Income::whereMonth('created_at',$dm['month'])->whereDay('created_at',$dm['day'])->sum('amount');
            $outcomes[] = Outcome::whereMonth('created_at',$dm['month'])->whereDay('created_at',$dm['day'])->sum('amount');
        }

        return view('admin.dashboard',compact('todayIncome','todayOutcome','user_count','product_count','months','sale_count','day_months','incomes','outcomes','latest_users','under_three_products'));
    }
}
