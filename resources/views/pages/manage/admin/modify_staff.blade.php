<fieldset>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h2 class="page_title">Modify Staff Information</h2>
            <form action="{{ route('admin.update',1) }}" method="post" id="modify_staff" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">    
                    <label class="pull-left" for="eventName1" >Input Staff Name :</label>
                    <input type="text" class="form-control service_choose staff_name" placeholder="Michelle Howard" name="staff_name" required> 
                </div>  
                <div class="form-group">
                    <label class="pull-left" for="eventName1">Select Role :</label>
                    <select  class="form-control custom-select sel_role"  data-placeholder="Type to choose service" name="sel_role">   
                            <option value="0" class="option">Massager</option>
                            <option value="1" class="option">Cashier</option>   
                    </select>
                    <i class="zmdi zmdi-caret-down"></i>
                </div>
                <div class="form-group cashier_id">    
                    <label class="pull-left" for="eventName1" >Input Cashier ID :</label>
                    <input type="email" class="form-control service_choose staff_id" placeholder="Michelle@outlook.com"  name="staff_id" required> 
                </div>
                <div class="form-group">
                    <span id="error_message"></span>
                </div>
                <div class="form-group sel_skill">
                    <label class="pull-left" for="">
                        Select Skill:
                    </label>
                    <div class="form-holder">
                        <select  class="form-control custom-select sel_skill" data-placeholder="Select skill" name="sel_skill">
                            <option value="1" class="option">1</option>
                            <option value="2" class="option">2</option>
                            <option value="3" class="option">3</option>
                            <option value="4" class="option">4</option>
                            <option value="5" class="option">5</option>
                        </select>
                        <i class="zmdi zmdi-caret-down"></i>
                    </div>
                </div>               
                <div class="form-group sel_avatar">
                    <label class="pull-left" for="">
                        Input Avatar:
                    </label>
                    <div class="form-holder">
                        <input type="file" placeholder="Choose avatar" name="sel_avatar" class="form-control service_choose " value="" >
                        <input type="hidden" name="admin_flag" value="staff_manage">
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