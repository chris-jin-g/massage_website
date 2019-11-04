<fieldset>
    <h2 class="page_title">Modify Orders</h2>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">            
            <form action="{{ route('cashier.update',1) }}" method="post" id="modify_order">
                @csrf
                @method('PUT')
                <div class="form-group">    
                    <label class="pull-left" for="eventName1" >Client Name :</label>
                    <input type="email" class="form-control service_choose "  id="client_name" name="client_name" value="" disabled>                     
                </div> 
                <div class="form-group">
                    <label class="pull-left" for="">
                        Massager:
                    </label>
                    <div class="form-holder">
                        <input type="text" class="form-control" placeholder="" name="sel_staff" id="sel_staff" disabled>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="pull-left" for="">
                        Service Type:
                    </label>
                    <div class="form-holder">
                        <input type="text" class="form-control" placeholder="" name="sel_service" id="sel_service" disabled>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="pull-left" for="">
                        Room No:
                    </label>
                    <div class="form-holder">
                        <input type="text" class="form-control" placeholder="" name="sel_room" id="sel_room" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="pull-left" for="">
                        Pre-paid Reference No:
                    </label>
                    <div class="form-holder">
                        <input type="text" class="form-control" placeholder="" name="refer_num" id="refer_num" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="pull-left" for="">
                        Service Duration:
                    </label>
                    <div class="form-holder">
                        <input type="text" class="form-control" placeholder="" name="duration" id="duration" disabled>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="pull-left" for="">
                        Remain Time:
                    </label>
                    <div class="form-holder">
                        <input type="text" class="form-control" placeholder="" name="remain_time" id="remain_time" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="pull-left" for="">
                        Total time:
                    </label>
                    <div class="form-holder">
                        <input type="text" class="form-control" placeholder="" name="total_time" id="totaln_time" required>
                    </div>
                </div>  
                <div class="form-group">
                    <label class="pull-left" for="">
                        Finalized/Undo
                    </label>
                    <div class="form-holder">
                        <select name="finish_state" id="finish_state" class="form-control custom-select" data-placeholder="">
                            <option value="1" class="option">Finish</option>
                            <option value="0" class="option">Undo</option>       
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