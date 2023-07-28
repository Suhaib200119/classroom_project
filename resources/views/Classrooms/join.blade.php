<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>join to classroom</title>
       <!-- Bootstrap CSS -->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
       <!-- Bootstrap Font Icon CSS -->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
           integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
           integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
       </script>
</head>
<body>
   {{-- $classroom --}}

   <div class="position-absolute top-50 start-50 translate-middle">
    <div class="card" style="width: 18rem;height: 18rem;">
        <img class="card-img-top" src="{{asset("uploads/$classroom->cover_image")}}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{$classroom->name}} classroom</h5>
          <p class="card-text">{{$classroom->section}} section and {{$classroom->subject}} subject</p>
        {{-- class="position-absolute start-50 translate-middle" --}}
          
          <form  action="{{route("join_Classroom_store",$classroom->id)}}" method="post">
            <select class="form-select"  name="role">
              <option value="student">student</option> 
              <option value="teacher">teacher</option>  
              </select>
              <br>
              {{-- <input type="hidden" name="classroom_id" value="{{$classroom->id}}"> --}}
            @csrf
            <button class="btn btn-primary position-absolute start-50 translate-middle" name="submit">Join</button>
          </form>
        </div>
      </div>
   </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

</body>
</html>