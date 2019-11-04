<fieldset>
    <div class="table_name"><span>Achieve Orders</span></div> 
    <div class="row cashier_disp">                                                            
        <div class="col-12 table-responsive">                    
            <table class="table table-striped table-bordered  base-style keytable-integration">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Staff Name</th>
                        <th scope="col">Service Name</th>
                        <th scope="col">Room ID</th>
                        <th scope="col">Total time</th>
                        <th scope="col">Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($achieve_orders as $key=>$achieve_order)
                        <tr id="{{$achieve_order->id}}" alt="{{$key}}" data-description="{{$achieve_order->id}}" onclick="tr_active(this);">
                            <td>{{$key+1}}</td>
                            <td>{{$achieve_order->client_name}}</td>
                            <td>{{$achieve_order->staff_name}}</td>
                            <td>{{$achieve_order->service_name}}</td>
                            <td>{{$achieve_order->room_id}}</td>
                            <td>{{$achieve_order->total_time}}</td>
                            <td>{{$achieve_order->cost}}</td>
                        </tr>
                    @endforeach
                    
                </tbody>                                                                        
            </table>                        
        </div>
    </div>
</fieldset>