<fieldset>
    <div class="table_name"><span>Staff Management</span></div>
    <div class="row cashier_disp">                                                            
        <div class="col-12 col-sm-12  table-responsive" >         
            <table class="table table-striped table-bordered  base-style ">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Staff_name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Skill</th>
                        <th scope="col">Email Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staff_infos as $key=>$staff_info)
                        <tr id="{{$staff_info->id}}" alt="{{$key}}" data-description="{{$staff_info->id}}" onclick="tr_active(this);">
                            <td>{{$key+1}}</td>
                            <td>
                                <img class="staff_avatar" src="{{asset($staff_info->staff_avatar)}}" alt="avatar">
                            </td>
                            <td>{{$staff_info->staff_name}}</td>
                            <td alt="{{$staff_info->role}}">
                                @if($staff_info->role==0)
                                    Massager
                                @elseif($staff_info->role==1)
                                    Cashier
                                @elseif($staff_info->role==2)
                                    Admin
                                @endif
                            </td>
                            <td alt="{{$staff_info->skill}}">
                                @if($staff_info->role==0)
                                    @for($i=0;$i<$staff_info->skill;$i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    @for($i=0;$i<(5-$staff_info->skill);$i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                @endif
                            </td>
                            <td>
                                {{$staff_info->staff_id}}
                            </td>                      
                        </tr>
                    @endforeach
                    
                </tbody>                                                                        
            </table>                        
        </div>
    </div>
    <button class="btn btn-success manage-btn add_staff">Add</button>
    <button class="btn btn-success manage-btn modify_staff">Modify</button>
</fieldset>