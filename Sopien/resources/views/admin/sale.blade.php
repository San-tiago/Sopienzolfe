@extends('layouts.admin_layout')

@section('dashboard')


<div >
    <!-- Sales -->
    <div class="d-flex justify-content-center"><h1>Sales</h1></div>
        <div class="d-flex justify-content-center">
            <div class="mr-3 p-2 card text-white bg-info mb-3 max-width: 18rem;"> 
                <h1>Today Sales</h1>
                <h3 class="text-center">{{$totalsales_today}}</h3>
            </div>
            
            <div class="mr-3 p-2 card text-white bg-info mb-3 max-width: 18rem;">
                <h1>Month Sales</h1>
                <h3 class="text-center">{{$totalsales_monthly}}</h3>
            </div>
        </div>
    </div>


<div class="d-flex flex-row justify-content-start ">
    <!-- Menu Nav -->
        <div class="mr-5">
            <h1 class="ml-5">Menu</h1>
            @foreach($menus as $menu)
            <ul >
            <a href="{{url('/menu/sales/'.$menu->id)}}"><button type="button" class="btn btn-outline-secondary">{{$menu->food_name}}</button></a> <br>
            </ul>
            @endforeach
            
        </div>

        <div class = "ml-5 p-2" >
            <h1>Today Sales</h1>
            <table class="table table-bordered">
                    <tr>
                        <th class="text-center" scope="col">id</th>
                        <th class="text-center" scope="col">Food Item</th>
                        <th class="text-center" scope="col">Category</th>
                        <th class="text-center" scope="col">Quantity</th>
                        <th class="text-center" scope="col">Total Price</th>
                        <th class="text-center" scope="col">Date</th>
                    </tr>
                    
                    @if(!$orders_today->isEmpty())
                        @foreach($orders_today as $order_today)
                        <tr>

                            <td  class="text-center">{{$loop->index+1}}</td>      
                            <td  class="text-center">{{$order_today->menu_name}}</td>       
                            <td  class="text-center">{{$order_today->menu_category}}</td>       
                            <td  class="text-center">{{$order_today->quantity}}</td>       
                            <td  class="text-center">{{$order_today->menu_price}}</td>   
                            <td  class="text-center">{{$order_today->created_at}}</td>    
                        </tr>
                        @endforeach
                    @else
                        <td  class="text-center" colspan = "6"><h2>No Orders Today</h2></td>  

                    @endif
                </table><br>

            <h1>Monthly Sales</h1>
            <table class="table table-bordered">
                    <tr>
                        <th class="text-center" scope="col">id</th>
                        <th class="text-center" scope="col">Food Item</th>
                        <th class="text-center" scope="col">Category</th>
                        <th class="text-center" scope="col">Quantity</th>
                        <th class="text-center" scope="col">Total Price</th>
                        <th class="text-center" scope="col">Date</th>
                    </tr>
                    @if(!$orders_month->isEmpty())
                        @foreach($orders_month as $order_month)
                        <tr>

                            <td  class="text-center">{{$loop->index+1}}</td>      
                            <td  class="text-center">{{$order_month->menu_name}}</td>       
                            <td  class="text-center">{{$order_month->menu_category}}</td>       
                            <td  class="text-center">{{$order_month->quantity}}</td>       
                            <td  class="text-center">{{$order_month->menu_price}}</td>   
                            <td  class="text-center">{{$order_today->created_at}}</td>    
                        </tr>
                        @endforeach
                    @else
                        <td  class="text-center" colspan = "6"><h2>No Orders This Month</h2></td>  
                    @endif
                    </table>
            </div>

    </div>
</div>


@endsection