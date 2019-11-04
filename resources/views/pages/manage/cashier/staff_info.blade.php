<fieldset alt="staff_info">
    <div class="table_name"><span>Staff Information</span>
        <i class="fa fa-sort-asc up_down up_btn staff_order pull-right" onclick="updown_order(1);"></i>
        <i class="fa fa-sort-desc up_down down_btn staff_order pull-right" onclick="updown_order(0);"></i>  
    </div>    
    <div class="row cashier_disp">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 cashier_option table-responsive">
            <input type="hidden" id="available_img" value="{{asset('images/available.png')}}">
            <input type="hidden" id="unavailable_img" value="{{asset('images/unavailable.png')}}">
            <input type="hidden" id="wait_img" value="{{asset('images/wait-icon-3.jpg')}}">
            <input type="hidden" id="time_img" value="{{asset('images/time.png')}}">                            
            <table class="table table-striped table-bordered keytable-integration">
                <thead>
                    <tr>
                        <th>No</th>
                        <th scope="col">Staff name</th>
                        <th scope="col">Skills</th>
                        <th scope="col">Available</th>
                        <th scope="col">Busy</th>
                        <th scope="col">Online</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staffs as $key=>$staff)
                        <tr id="{{$staff->id}}" onclick="tr_active(this);" data-description="{{$staff->id}}" tid="{{$staff->team_order}}">
                            <td>{{$key+1}}</td>
                            <td>{{$staff->staff_name}}</td>
                            <td>
                                @for($i=0;$i<$staff->skill;$i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                                @for($i=0;$i<(5-$staff->skill);$i++)
                                    <i class="fa fa-star-o"></i>
                                @endfor
                            </td>                            
                            @if($staff->online==1)
                                @if($staff->last_time==null)
                                    <td available="1"><img  class="staff_state" src="{{asset('images/available.png')}}"></td>
                                @else
                                    <td available="0"><img class="staff_state" src="{{asset('images/unavailable.png')}}"></td>
                                @endif
                            @else
                                @if($staff->last_time==null)
                                    <td available="1"><img class="staff_state" src="{{asset('images/unavailable.png')}}"></td>
                                @else
                                    <td available="0"><img class="staff_state" src="{{asset('images/unavailable.png')}}"></td>
                                @endif
                            @endif
                            @if($staff->online==1)
                                @if($staff->last_time==null)
                                    <td busy="1"><img class="staff_state" src="{{asset('images/wait-icon-3.jpg')}}"></td>
                                @else
                                    <td busy="0" remain="{{date_diff(date_create($current_time),date_create($staff->last_time))->format('%H:%I')}}">
                                        <img class="staff_state" src="{{asset('images/time.png')}}">
                                        {{date_diff(date_create($current_time),date_create($staff->last_time))->format('%H:%I')}}
                                    </td>
                                @endif
                            @else
                                @if($staff->last_time==null)
                                    <td busy="1"></td>
                                @else
                                    <td busy="0" remain="{{date_diff(date_create($current_time),date_create($staff->last_time))->format('%H:%I')}}"></td>
                                @endif
                            @endif
                            @if($staff->online==1)
                                <td>
                                    <label class="switch">
                                      <input type="checkbox" checked onclick="staff_check(this);">
                                      <span class="slider round"></span>
                                    </label>
                                </td>
                            @else($staff->onine==0)
                                <td>
                                    <label class="switch">
                                      <input type="checkbox" onclick="staff_check(this);">
                                      <span class="slider round"></span>
                                    </label>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>
    </div>
</fieldset>