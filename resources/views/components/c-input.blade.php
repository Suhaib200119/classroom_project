<input type="{{$type}}" name="{{$inputName}}" value="{{ old($inputName) }}"
    class="form-control @error($inputName)
          is-invalid
        @enderror" id="{{$inputId}}"
    placeholder="{{$placeholder}}">
