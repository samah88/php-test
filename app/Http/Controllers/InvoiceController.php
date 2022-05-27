<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    //
    public function index(Request $request){
        $status=$request->input('invoice-status');
        $invoices=Invoice::query();
        $all=$invoices->get();
        $count=$all->groupBy('status')->toArray();
        
        $allAmount=$all->sum('amount');
       
        if($status!='')
        {
         $invoices=$invoices->where('status',$status);  
        }
        $invoices=$invoices->paginate(10);
       
        return view('invoices.list',compact('invoices','status','count','allAmount'));
    }

    public function  create(){
        return view('invoices.add');   
    }

    public function store(Request $request){

        $data=$request->validate([
        'product'=>'array|required|min:1',
        'price'=>'array|required|min:1',
        'qty'=>'array|required|min:1',
        'discount'=>'array|required|min:1',
        'date'=>'array',
        'amount'=>'required',
        'invoice-status'=>'required',
        ]);

          DB::transaction(function ()use($data) {
           $invoice=Invoice::create([
            'amount'=>$data['amount'],
            'status'=>$data['invoice-status'],
           ]);
         
           foreach($data['product']  as $key=>$value){
            Item::create([
                'invoice_id'=>$invoice->id,
                'name'=>$value,
                'qty'=>$data['qty'][$key],
                'price'=>$data['price'][$key],
                'discount'=>$data['discount'][$key],
                'added_at'=>$data['date'][$key],
            ]);
           }
            
        }, 5);

        return redirect()->route('invoices.list');

    }
}
