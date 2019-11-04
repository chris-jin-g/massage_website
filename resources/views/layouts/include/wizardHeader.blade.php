<div class="card-header">
  @if(Request::is('manage/*'))
    @if(Request::is('*/superadmin'))
    <h4 class="card-title">SuperAdmin Panel</h4>
    @else
        @if(Request::is('*/cashier'))
            <h4 class="card-title">Cashier Panel</h4>          
        @elseif(Request::is('*/admin'))
            <h4 class="card-title">Admin Panel</h4>
        @endif
    @endif        
  @else
      <h4 class="card-title">Client Panel</h4>
  @endif    
  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-h font-medium-3"></i></a>  
</div>