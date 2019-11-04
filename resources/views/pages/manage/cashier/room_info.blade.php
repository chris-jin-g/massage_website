<fieldset alt="room_info">
    <div class="table_name"><span>Room Information</span>
        <i class="fa fa-sort-asc up_down up_btn staff_order pull-right" onclick="updown_order(1);"></i>
        <i class="fa fa-sort-desc up_down down_btn staff_order pull-right" onclick="updown_order(0);"></i>  
    </div>   
    <div class="row cashier_disp">
        <div class="col-12 col-sm-12 col-md-12  table-responsive" >
                   
            <table class="table table-striped table-bordered keytable-integration">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Room_no</th>
                        <th scope="col">available</th>
                        <th scope="col">Busy</th>
                        <th scope="col">Used</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $key=>$room)
                        <tr id="{{$room->id}}" onclick="tr_active(this);" data-description="{{$room->id}}" tid="{{$room->team_order}}">
                            <td>{{$key+1}}</td>
                            <td>{{$room->room_id}}</td>                          
                            @if($room->used==1)
                                @if($room->last_time==null)
                                    <td available="1"><img  class="room_state" src="{{asset('images/available.png')}}"></td>
                                @else
                                    <td available="0"><img class="room_state" src="{{asset('images/unavailable.png')}}"></td>
                                @endif
                            @else
                                @if($room->last_time==null)
                                    <td available="1"><img class="room_state" src="{{asset('images/unavailable.png')}}"></td>
                                @else
                                    <td available="0"><img class="room_state" src="{{asset('images/unavailable.png')}}"></td>
                                @endif
                            @endif

                            @if($room->used==1)
                                @if($room->last_time==null)
                                    <td busy="1"><img class="room_state" src="{{asset('images/wait-icon-3.jpg')}}"></td>
                                @else
                                    <td busy="0" remain="{{date_diff(date_create($current_time),date_create($room->last_time))->format('%H:%I')}}">
                                        <img class="room_state" src="{{asset('images/time.png')}}">
                                        {{date_diff(date_create($current_time),date_create($room->last_time))->format('%H:%I')}}
                                    </td>
                                @endif
                            @else
                                @if($room->last_time==null)
                                    <td busy="1"></td>
                                @else
                                    <td busy="0" remain="{{date_diff(date_create($current_time),date_create($room->last_time))->format('%H:%I')}}"></td>
                                @endif
                            
                            @endif
                            @if($room->used==1)
                                <td>
                                    <label class="switch">
                                      <input type="checkbox" checked onclick="room_check(this);">
                                      <span class="slider round"></span>
                                    </label>
                                </td>
                            @else($room->used==0)
                                <td>
                                    <label class="switch">
                                      <input type="checkbox" onclick="room_check(this);">
                                      <span class="slider round"></span>
                                    </label>
                                </td>
                            @endif
                        </tr>
                        </tr>
                    @endforeach		
                </tbody>
            </table>                        
        </div>
    </div>
</fieldset>