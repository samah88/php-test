@extends('layouts.app')
@section('title','Invoices')
@section('content')
<h1>Invoices</h1>
<div class="pt-3">
  <div class="div-container">
      @php $statuses=['unpaid','cancelled','paid']@endphp
      <form action="{{route('invoices.list')}}" method="get">
      <select name="invoice-status" class="form-input w-25" id="invoice-status" style="float:left" onchange="this.form.submit()">
          <option value="">select status <i class="fa fa-map-o"></i></option>
          @foreach($statuses as $key=>$value)

          <option value="{{$value}}" {{$status==$value ? 'selected':''}}>{{$value}}</option>
          @endforeach
          
       </select>
      </from>
       <a href="{{route('invoices.create')}}" class="btn-link" style="float:right"> <i class="fa fa-plus-circle icon"></i> New Invoice</a>
      </div>

      <div class="div-counts " >
          <div class="counts" >
             <span class="stats-icon"> <i class="fa fa-bar-chart"></i> </span> 
             <span class="span-3 blue-color" style="float:right"> {{$allAmount}} $</span>
             <br><br>
             <p class="bottom-icon  pt-3"> all Invoices :{{$invoices->total()}}</p>
          </div>
          <div class="counts" >
             <span class="stats-icon"> <i class="fa fa-bar-chart"></i> </span> 
             <span class="span-3 blue-color" style="float:right"> {{isset($count['paid'])? array_sum(array_column($count['paid'], 'amount')):''}} $</span>
             <br><br>
             <p class="bottom-icon  pt-3"> Paid : {{isset($count['paid'])? count($count['paid']):''}}</p>
          </div>
          <div class="counts" >
             <span class="stats-icon"> <i class="fa fa-bar-chart"></i> </span> 
             <span class="span-3 blue-color" style="float:right"> {{isset($count['unpaid'])? array_sum(array_column($count['unpaid'], 'amount')):''}} $</span>
             <br><br>
             <p class="bottom-icon  pt-3"> Unpaid : {{isset($count['unpaid'])? count($count['unpaid']):''}}</p>
          </div>
          <div class="counts" >
             <span class="stats-icon"> <i class="fa fa-bar-chart"></i> </span> 
             <span class="span-3 blue-color" style="float:right">{{isset($count['cancelled'])? array_sum(array_column($count['cancelled'], 'amount')):''}} $</span>
             <br><br>
             <p class="bottom-icon pt-3"> Cancelled : {{isset($count['paid'])? count($count['cancelled']):''}}</p>
          </div>

      </div>
      <div class="div-container">
          <table class="invoice-table">
              <tr>
              <th> Invoice ID</th>
              <th> Created On</th>
              <th> Amount</th>
              <th> Status</th> 
              </tr>
              @foreach($invoices as $invoice)
              <tr>
              <td class="blue-color">{{$invoice->uuid}}</td>
              <td>{{$invoice->created_at->format('M d Y')}}</td>
              <td class="blue-color">{{$invoice->amount}} $</td>
              <td> <span class="badge {{$invoice->status}}">{{$invoice->status}}<span></td>
              </tr>
              
              @endforeach
          </table>
          {{ $invoices->links() }}
      </div>
</div>      
@endsection
@push('styles')

@endpush
@push('scripts')

@endpush