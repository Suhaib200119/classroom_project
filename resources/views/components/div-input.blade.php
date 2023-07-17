
<div {{$attributes->class(["mb-3"])}}>
    <x-c-label-input input-name="{{$name}}" label-value="{{$label}}" label-id="{{$id}}"/>
    <x-c-input type="{{$type}}" input-name="{{$name}}" input-id="{{$id}}" placeholder="{{$placeholder}}"/>
    <x-hint-error input-name="{{$name}}"/>
  </div>