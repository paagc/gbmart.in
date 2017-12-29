@if(\Session::has('message'))
    <div class="alert alert-{{\Session::get('class')}}">
        <strong>{{\Session::get('message')}}</strong>
    </div>
    {{\Session::forget(['message','message_type'])}}
@endif