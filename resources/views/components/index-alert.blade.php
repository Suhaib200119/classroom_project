@if (session()->has($name))
    <div {{$attributes->class(["alert"])}}>
        {{session($name)}}
    </div>
@endif