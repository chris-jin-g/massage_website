<fieldset>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h2 class="page_title">Input Staff Information</h2>
            <form action="{{ route('admin.update',1) }}" method="post" enctype="multipart/form-data" id="modify_room">
                @csrf
                @method('PUT')
                <div class="form-group">    
                    <label class="pull-left" for="eventName1" >Input Room Name :</label>
                    <input type="text" class="form-control service_choose" placeholder="2-01" name="room_name" required> 
                </div>               
                <div class="form-group">
                    <label class="pull-left" for="">
                        Input Room Image:
                    </label>
                    <div class="form-holder">
                        <input type="file" placeholder="" name="room_img" class="form-control service_choose " >
                        <input type="hidden" name="admin_flag" value="room_manage">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-holder">
                        <input class="btn btn-primary pull-right cashier_submit"  type="submit" name="add_room" value="Submit">
                    </div>
                </div>
            </form>                                                                    
        </div>
        <div class="col-md-2"></div>
    </div>
</fieldset>