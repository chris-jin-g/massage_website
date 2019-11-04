<fieldset>    
    <h2 class="page_title">Enjoy your service</h2>
    <div class="row add_or_check">     
        <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-3 enjoy_service"> 
            <h2 class="page_title">Time Remaining</h2><br>
            @if(isset($remain_time))
                <h5 id="time_remain">{{$remain_time}}</h6>
            @else
                <h5 id="time_remain"></h6>
            @endif
            <div id="countdowntimer"><span id="future_date"><span></div>                                                                         
            <div class="form-group" >	 
                <a href="javascript:void(0)" class="hvr-rectangle-out button service_choose add_service">Add Service</a>	
            </div>	
            <div class="form-group" >	 
                <a href="javascript:void(0)" class="hvr-rectangle-out button service_choose add_service check_out">Check Out</a>		
            </div>                                                        
        </div>
    </div>
</fieldset>
