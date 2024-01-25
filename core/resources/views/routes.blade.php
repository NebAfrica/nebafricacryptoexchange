@php  
$routeCollection = Route::getRoutes();
@endphp
<ol>
    @foreach ($routeCollection as $value)
    @if ($value->methods()[0] == 'GET')
        <li><a href="{{$value->uri() }}" target="_blank">{{$value->uri() }}</a> </li>
    @endif
        
    @endforeach
</ol>

