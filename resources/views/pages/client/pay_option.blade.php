<fieldset>
    @if(isset($price_per_hour))
        <span id="price_per_hour">{{$price_per_hour[0]->price_per_hour}}</span>
    @else
        <span id="price_per_hour"></span>
    @endif
    <h2 class="page_title total_pay">Total to Pay:  120$ </h2>    
    <div class="row">
        <div class="col-md-8 offset-md-2 enjoy_service">
            <div class="result">
                <h2>Total time:  32Hrs</h2>
            </div>                                                                   
            <div class="row pay_result">
                    <div class="form-group">
                        <input type="radio" class="option-input radio" name="pay_mode" value="ticket" checked> <span>I have a prepared ticket</span><br>	
                    </div>
                    <div class="form-group">
                        <input type="radio" class="option-input radio" name="pay_mode" value="pay_cashier"> <span>I will pay to cashier</span><br>	
                    </div>
            </div>                                                                                                            
        </div>
    </div>
</fieldset>
