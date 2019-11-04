<fieldset>
    <h2 class="page_title" style="opacity: 0">Cashier Option</h2>
    <div class="row">                                                                
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-3"></div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-6 cashier_option">                                                                    
            <div class="form-group">	
                <a href="#" class="hvr-rectangle-out button cashier_opt add_service">Massagers Choose</a>	
            </div>	
            <div class="form-group">	
                <a href="#" class="hvr-rectangle-out button cashier_opt add_service">Room Queue</a>	                                                                        
            </div>
            <div class="form-group">		
                <a href="#" class="hvr-rectangle-out button cashier_opt add_service">Ongoing Orders</a>	
            </div>
            <div class="form-group">	
                <a href="#" class="hvr-rectangle-out button cashier_opt add_service">Add Orders</a>	
            </div>
            <div class="form-group">    
                <a href="#" class="hvr-rectangle-out button cashier_opt add_service">QR CODE</a> 
            </div>

            @foreach ($errors->all() as $error)
              <div class="form-error">{{ $error }}</div>
            @endforeach
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-3"></div>
    </div>
</fieldset>