<fieldset>
    <div class="row">
        <div class="col-10 col-sm-8 col-md-8 col-lg-6 offset-1 offset-sm-2 offset-md-2 offset-lg-3 choose_branch">
            @foreach($admin_menus as $key=>$admin_menu)
                <div class="form-group">    
                    <input type="button" class="form-control admin_option" value="{{$admin_menu->menu_name}}" alt="{{$key+1}}">  
                </div>
            @endforeach
            <input type="hidden" value="{{$admin_state}}" id="admin_state">         
        </div>
    </div>
</fieldset>