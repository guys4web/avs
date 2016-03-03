<?php



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\Cart;
use Datatables;


class OrdersController extends Controller {
    
    public function index()
    {
        return view("admin.orders.index");
    }
    
    public function datatables()
    {
        $orders = Order::select(["id","cart_id","user_id","created_at"]);
        
        return Datatables::of($orders)
            ->addColumn('action', function ($model) {
                return '<a href="#modal-edit" data-id="'.$model->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-zoom-in"></i></a>';
            })     
            ->editColumn('cart_id', function($model){
                return $model->payment();
            })
            ->editColumn('user_id', function ($model) {
                return $model->user->first_name . " " .$model->user->last_name;
            })
            ->make(true);
    }
    
}
