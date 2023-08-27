import Echo from 'laravel-echo';
import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();
window.Echo.private("classroom." + classroomId)
      .listen(".classwork-created",function(dataFromPusher){
alert(dataFromPusher.user.name);
});
