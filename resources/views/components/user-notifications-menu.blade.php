<li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link active">
        <i class="nav-icon fa fa-dashboard"></i>
        <p>
            الإشعارات
            {{$unreadNotificationsCount}}
            <i class="right fa fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        @foreach ($notifications as $notification)
        <li class="nav-item">
            <a href="#" onclick="Swal.fire('{{$notification->data['body']}}')" class="nav-link {{-- active --}}">
                {{$notification->data["title"]}} <br>            
            </a>
        </li>
       {{--  --}}
        @endforeach
    
    </ul>
</li>
{{-- <script>
     function c_alert(body){
        window.alert(body);
     }
</script> --}}
