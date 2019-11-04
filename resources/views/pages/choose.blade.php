@extends('layouts.home')
@section('wizard_content')
  <div class="card-content collapse show">     
    <div class="card-body">
            <div class="row choose_branch">
                <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-3">
                    <form action="{{ route('client.show',$branches[0]->id) }}" method="post">
                        @csrf
                        @method('HEAD')
                        @foreach($branches as $key=>$branch)
                            <div class="form-group">    
                                <input type="submit" class="form-control to_branch" value="{{$branch->branch_name}}" alt="{{$branch->id}}" formaction="{{ route('client.show',$branch->id) }}">  
                            </div>
                        @endforeach
                    </form>            
                </div>
            </div>
    </div>
  </div>
@endsection