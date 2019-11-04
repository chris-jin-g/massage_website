<fieldset>
    <h2 class="page_title">Choose the Branch you want</h2>
    <div class="row">
        <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-3 choose_branch">
            <form action="{{ route('manage.superadmin.show',$branches[0]->id) }}" method="post">
                @csrf
                @method('HEAD')
                @foreach($branches as $key=>$branch)
                    <div class="form-group">    
                        <input type="submit" class="form-control to_branch" value="{{$branch->branch_name}}" alt="{{$branch->id}}">  
                    </div>
                @endforeach
            </form>            
        </div>
    </div>
    <button class="btn btn-success manage-btn add_branch">Add Branch</button>
</fieldset>