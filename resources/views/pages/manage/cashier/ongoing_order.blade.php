<fieldset>
    <div class="table_name">
        <span>Ongoing Orders</span>
        <a href="{{asset('file/sample.xlsx')}}" ><i class="fa fa-download pull-right" title="Excel file download" data-toggle="tooltip" data-placement="bottom"></i></a>
    </div>
    <div class="row cashier_disp">                                                            
        <div class="col-12 table-responsive" >         
            <table class="table table-striped table-bordered base-style">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Staff Name</th>
                        <th scope="col">Service Name</th>
                        <th scope="col">Remain Time</th>
                        <th scope="col">Room ID</th>
                        <th scope="col">Estimate Cost</th>
                        <th scope="col">Paid</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key=>$order)
                        <tr id="{{$order->id}}" alt="{{$key}}" data-description="{{$order->id}}" onclick="tr_active(this);">
                            <td>{{$key+1}}</td>
                            <td>{{$order->client_name}}</td>
                            <td>{{$order->staff_name}}</td>
                            <td>{{$order->service_name}}</td>
                            <td>
                                {{date_diff(date_create($current_time),date_create($order->last_time))->format('%H:%I')}}
                            </td>
                            <td>{{$order->room_id}}</td>
                            <td>{{$order->estimate_cost}}</td>
                            @if($order->pay_status==1)
                                <td><i class="fab fa-apple-pay"></i></td>
                            @else
                                <td><i class="fa-times-circle"></i></td>
                            @endif
                        </tr>
                    @endforeach
                    
                </tbody>                                                                        
            </table>
                                                
        </div>
    </div>
    <form action="{{ route('cashier.store') }}" method="post" enctype="multipart/form-data" class="excel_import">
        @csrf
        <div class="image-upload" >
            <label for="file-input">
                <i class="fa fa-upload" for="file-input"></i>
            </label>
            <input id="file-input" name="excel-upload" type="file" accept=".xls,.xlsx" required/>
            <input type="hidden" name="file-upload" value="excel-upload">
        </div>
        <button  type="submit" class="btn btn-success import_to">Import Excel</button>
    </form>
    <button class="btn btn-success manage-btn order_modify">Modify</button>
</fieldset>