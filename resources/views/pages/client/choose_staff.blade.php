<fieldset>   
    <h2 class="page_title">Choose the Staff you want</h2>
    <div class="row">
            <div class="col-12 col-sm-10 col-md-10 col-lg-10 offset-sm-1 offset-md-1 offset-lg-1">                
                <div class="row staff_intro">
                    @foreach($staffs as $staff)
                        <div class="staff">
                                <!--Card-->                                                 
                            <div class="staff-avatar"><a href="javascript:void(0)" class="user_avatar"><img src="{{asset($staff->staff_avatar)}}"
                                alt="{{$staff->id}}" class="rounded-circle img-fluid"></a>
                            </div>
                            <div class="staff-name">
                                <!--Name-->
                                <h4>{{$staff->staff_name}}</h4>
                                @for($i=0;$i<$staff->skill;$i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                                @for($i=0;$i<(5-$staff->skill);$i++)
                                    <i class="fa fa-star-o"></i>
                                @endfor
                            </div>                                                          
                        </div>
                    @endforeach                  
                </div>
            </div>
    </div>
</fieldset>