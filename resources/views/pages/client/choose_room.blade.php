<fieldset>
    <h2 class="page_title">Advice the receptionist about the room</h2>
    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">                
                <div class="row room_intro">
                    @foreach($rooms as $room)
                        <div class="massage_room">												
                            <div class="room_img"><a href="javascript:void(0)"><img src="{{asset($room->room_img)}}"
                                    alt="{{$room->id}}" class="img-fluid"></a>
                            </div>
                            <hr>
                            <div class="room_name">
                                <h6 class="card-title">{{$room->room_id}}</h6>
                            </div>															
                        </div>
                    @endforeach
                </div>
            </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
        <input type=hidden id="sel_staff" name="sel_staff" value="">
        <input type=hidden id="sel_service" name="sel_service" value="">
        <input type=hidden id="sel_room" name="sel_room" value="">        
        <input type=hidden id="cost" name="cost" value="">
        <input type=hidden id="total_time" name="total_time" value="">
        <input type=hidden id="duration" name="duration" value="">
        @if(isset($orders[0]->duration))
            <input type=hidden id="reserve_duration" name="reserve_duration" value="{{$orders[0]->duration}}">
        @else
            <input type=hidden id="reserve_duration" name="reserve_duration" value="">
        @endif
        @if(isset($orders[0]->current_state))
            <input type="hidden" name="current_state" id="current_state" value="{{$orders[0]->current_state}}"> 
        @else
            <input type="hidden" name="current_state" id="current_state" value="1">
        @endif        
    </div>
</fieldset>