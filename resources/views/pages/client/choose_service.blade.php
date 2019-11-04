
<fieldset>
    @csrf
        @method('PUT')   
    <h2 class="page_title">Choose the service you want</h2>
    <div class="row">
        <div class="col-1 col-sm-2 col-md-3 col-lg-3"></div>
        <div class="col-10 col-sm-8 col-md-6 col-lg-6">      
            @foreach ($services as $service) 
                <div class="form-group">	
                    <input type="button" class="form-control service_choose " value="{{$service->service_name}}" alt="{{$service->id}}"> 	
                </div>	
            @endforeach 
            <div class="form-group" style="text-align:center;">
                <span id="service_duration"></span><span>h</span>
                <div id="slider-step" class="my-1"></div>                
            </div>
        </div>
        <div class="col-1 col-sm-2 col-md-3 col-lg-3"></div>
    </div>
</fieldset>