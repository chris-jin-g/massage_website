
<fieldset>
    <h2 class="page_title">Add Branch and Admin</h2>
    <div class="row">
        <div class="col-10 col-sm-8 col-md-8 col-lg-8 offset-1 offset-sm-2 offset-md-2 offset-lg-2">            
            <form action="{{ route('manage.superadmin.store') }}" method="post" id="add_branch">
                @csrf
                <div class="form-group">    
                    <label class="pull-left" for="eventName1" >Input Branch Name :</label>
                    <input type="text" class="form-control" placeholder="Happy land"  name="branch_name" required> 
                </div>
                <div class="form-group">    
                    <label class="pull-left" for="eventName1" >Input Admin Name :</label>
                    <input type="email" class="form-control"   name="admin_name" required> 
                </div>
                <div class="form-group">
                    <label class="pull-left" for="eventName1">Input Admin Password :</label> 
                    <input type="password" class="form-control" id="admin_pass" name="admin_pass" required>
                </div>
                <div class="form-group">
                    <label class="pull-left" for="eventName1">Input Admin Confirm Password :</label> 
                    <input type="password" class="form-control" id="confirm_admin_pass" name="confirm_admin_pass" required>
                </div>
                <div class="form-group">
                    <span id="error_message"></span>
                </div>          
                <input class="btn btn-primary pull-right cashier_submit" id="add_branch" type="submit" value="Save">
            </form>
        </div>
    </div>
</fieldset>