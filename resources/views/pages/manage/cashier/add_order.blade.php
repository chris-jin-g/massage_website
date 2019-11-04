<fieldset>
    <h2 class="page_title">Order Detail</h2>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">            
            <form action="{{ route('cashier.store') }}" method="post">
                @csrf
                <div class="form-group">	
                    <label class="pull-left" for="eventName1" >Input Client Name :</label>
                    <input type="email" class="form-control service_choose " placeholder="John@outlook.com" id="client_name" name="client_name" required> 
                </div>	
                <div class="form-group">
                    <label class="pull-left" for="eventName1">Select Service :</label>	
                    <select  id="sel_service" class="form-control custom-select"  data-placeholder="Type to choose service" name="sel_service">
                        @foreach($services as $service)
                            <option value="{{$service->id}}" class="option">{{$service->service_name}}</option>
                        @endforeach
                    </select>
                    <i class="zmdi zmdi-caret-down"></i>
                </div>
                <div class="form-group">
                    <label class="pull-left" for="">
                        Select Staff:
                    </label>
                    <div class="form-holder">
                        <select  id="sel_staff" class="form-control custom-select" data-placeholder="Select staff" name="sel_staff">
                            @foreach($staffs as $staff)
                                <option value="{{$staff->id}}" class="option">{{$staff->staff_name}}</option>
                            @endforeach
                        </select>
                        <i class="zmdi zmdi-caret-down"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label class="pull-left" for="">
                        Select Room:
                    </label>
                    <div class="form-holder">
                        <select name="sel_room" id="sel_room" class="form-control custom-select" data-placeholder="Select Room" name="sel_room">
                            @foreach($rooms as $room)
                                <option value="{{$room->id}}" class="option">{{$room->room_id}}</option>
                            @endforeach
                        </select>
                        <i class="zmdi zmdi-caret-down"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label class="pull-left" for="">
                        Select time:
                    </label>
                    <div class="form-holder">
                        <select name="sel_time" id="sel_time" class="form-control custom-select" data-placeholder="Select Time" name="sel_time">
                            @for($i=1; $i<6;$i++)
                                <option value="{{$i}}" class="option">{{$i}}h</option>
                            @endfor
                        </select>
                        <i class="zmdi zmdi-caret-down"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-holder">
                        <input class="btn btn-primary pull-right cashier_submit" id="add_order" type="submit" name="add_order" value="Submit">
                    </div>
                </div>
            </form>                                                                    
        </div>
        <div class="col-md-2"></div>
    </div>
</fieldset>