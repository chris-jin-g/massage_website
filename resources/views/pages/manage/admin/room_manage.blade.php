<fieldset>
    <div class="table_name"><span>Room Management</span></div>
    <div class="row cashier_disp">                                                            
        <div class="col-12  table-responsive" >    
            <table class="table table-striped table-bordered  room_info">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Room Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($room_infos as $key=>$room_info)
                        <tr id="{{$room_info->id}}" alt="{{$key}}" data-description="{{$room_info->id}}" onclick="tr_active(this);">
                            <td>{{$key+1}}</td>
                            <td>
                                <img class="room_simg" src="{{asset($room_info->room_img)}}" alt="avatar">
                            </td>
                            <td>{{$room_info->room_id}}</td>
                            <td>
                                @if($room_info->used==0)
                                    Allow
                                @elseif($room_info->used==1)
                                    Not allow
                                @endif
                            </td>                      
                        </tr>
                    @endforeach
                    
                </tbody>                                                                        
            </table>                        
        </div>
    </div>
    <button class="btn btn-success manage-btn add_room">Add</button>
    <button class="btn btn-success manage-btn modify_room">Modify</button>
</fieldset>