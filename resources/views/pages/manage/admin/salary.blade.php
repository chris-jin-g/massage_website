<fieldset>
    <div class="table_name">
        <span>Salary of Staffs</span>
        <!-- <div class="form-group date_display"> -->
            <div class="form-holder date_display">                    
                <select  class="form-control custom-select sel_year"  id="sel_month" name="sel_month" value="">
                    <option value="01" class="option">Jan</option>
                    <option value="02" class="option">Feb</option>
                    <option value="03" class="option">Mar</option>
                    <option value="04" class="option">Apr</option>
                    <option value="05" class="option">May</option>
                    <option value="06" class="option">Jun</option>
                    <option value="07" class="option">Jul</option>
                    <option value="08" class="option">Aug</option>
                    <option value="09" class="option">Sep</option>
                    <option value="10" class="option">Oct</option>
                    <option value="11" class="option">Nov</option>
                    <option value="12" class="option">Dec</option>
                </select>
                <i class="zmdi zmdi-caret-down"></i>
                <select  class="form-control custom-select sel_year"  id="sel_year" name="sel_year" value="">
                    @for($i=2000; $i<2100;$i++)
                        <option value="{{$i}}" class="option">{{$i}}</option>
                    @endfor
                </select>
                <i class="zmdi zmdi-caret-down"></i>
            </div>                
        <!-- </div> -->
    </div>
    <div class="row cashier_disp">                                                            
        <div class="col-12 table-responsive salary_table" >               
            <table class="table table-striped table-bordered  base-style">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Staff Name</th>
                        <th scope="col">Total Hours</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Bonus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salarys as $key=>$salary)
                        <tr id="{{$salary->id}}" alt="{{$key}}" data-description="{{$salary->id}}" onclick="tr_active(this);">
                            <td>{{$key+1}}</td>
                            <td>{{$salary->staff_name}}</td>
                            <td>{{$salary->sub_time}}</td>
                            <td>{{$salary->total_cost}}</td>                     
                            <td>{{$salary->bonus}}</td>                           
                        </tr>
                    @endforeach                    
                </tbody>                                                         
            </table>                        
        </div>
    </div>
    <button class="btn btn-success manage-btn add_salary">Add</button>
    <button class="btn btn-success manage-btn modify_salary">Modify</button>
    <button class="btn btn-success manage-btn reset_salary">Reset</button>
</fieldset>