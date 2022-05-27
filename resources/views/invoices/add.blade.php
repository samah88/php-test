@extends('layouts.app')
@section('title','New Invoice')
@section('content')
   <div class="pt-3">
   @if ($errors->any())
     @foreach ($errors->all() as $error)
         <p>{{$error}}</p>
     @endforeach
 @endif
   </div>
  <div class="pt-3">
    <form method="post" action="{{route('invoices.store')}}" name="submit">
      @csrf
      <span class="title-1 blue-color">Product Details</span>
      <table class="invoice-table mt-2">
        <tbody>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Discount</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </tbody>
          <tbody class="rows">
          <tr>
            <td> <input type="text" class="form-input prod-name" onblur="return summaryRender()" value="" name="product[]"></td>

            <td> <input type="text" class="form-input prod-price" onblur="return summaryRender()" value="" name="price[]"></td>

            <td> <input type="number" class="form-input prod-qty" onblur="return summaryRender()" value="1" name="qty[]"></td>

            <td> <input type="text" class="form-input prod-discount" onblur="return summaryRender()" value="" name="discount[]"></td>

            <td> <input type="date" class="form-input"   value="{{date('Y-m-d')}}" name="date[]"></td>

            <td>
               <a href="javascript:void(0);" class="add-row" onclick="return addRow()"> <i class="fa fa-plus-circle icon blue-color" ></i></a>
            </td>
          </tr>

        </tbody>

        
      </table>

    <div class="mt-2" >
      <span class="title-2 mt-2 navy-blue"> Summary </span>
      <div class="summary mt-2">
        <table class="summary-table mt-2">
          <tbody class="items"></tbody>
          <tbody class="totals purple">
            <tr class="span-3">
              <td> Total Amount </td>
              <td > <input type="text" name="amount" class="total-price form-input"style="width:50%" readonly> $</td>
            </tr>
          </tbody>
        </table>
        <div>
          
          <select name="invoice-status" class="form-input "id="invoice-status">
  <option value="unpaid">unpaid</option>
  <option value="cancelled">cancelled</option>
  <option value="paid">paid</option>
  
</select>
        </div>
       

      </div>
    </div>
    <br><br>
    <input type="submit" value="save-changes" class="form-input mt-2 btn" onclick="return validate()">
</form>
  </div> 
@endsection
@push('styles')

@endpush
@push('scripts')
<script>
  function validate(){
    return true;
  }
  function addRow(){
   let product_tr='<tr>'+
            '<td> <input type="text" class="form-input prod-name" onblur="return summaryRender()" value="" name="product[]"></td>'+

            '<td> <input type="text" class="form-input prod-price" onblur="return summaryRender()"  value="" name="price[]"></td>'+

            '<td> <input type="number" class="form-input prod-qty" onblur="return summaryRender()" value="1" name="qty[]"></td>'+

            '<td> <input type="text" class="form-input prod-discount" onblur="return summaryRender()" value="" name="discount[]"></td>'+

            '<td> <input type="date" class="form-input" value="{{date('Y-m-d')}}" name="date[]"></td>'+

            '<td>'+
            '  <a href="javascript:void(0)" class="remove-row" onclick="return removeRow(this)"><i class="fa fa-trash icon red-color"></i></a>'+
            ' </td>'+

            ' </tr>';               
   $('.invoice-table .rows').append(product_tr)

 }
 function removeRow(row){
  let itemclicked=$(row);
  itemclicked.parent().parent().remove();
  summaryRender();
 }

 function summaryRender(){
  $('.total-price').val(0)
  let totalPrice=toValivNumber($('.total-price').val());
   $('.summary-table .items').empty();
  $(".invoice-table .rows tr").each( function(index,row) {
  
  let item_price=toValivNumber($(row).children().children('.prod-price').val());
  let item_qty=toValivNumber($(row).children().children('.prod-qty').val());
  let item_discount=toValivNumber($(row).children().children('.prod-discount').val());
  let   price= item_price * item_qty - item_discount;
    totalPrice+=price;
    $('.summary-table .items').append('<tr class="font-15">'+
                     '<td>'+ $(row).children().children('.prod-name').val() +'</td>'+
                     '<td class="price"> '+ price+'$</td>'+
                     '</tr>');
                   
    });

$('.total-price').val(totalPrice)
}
function toValivNumber(value){
return (value!=='')? parseInt(value) : value*0
}
</script>
@endpush