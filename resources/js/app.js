import Echo from 'laravel-echo';
import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

// window.Echo.private("classroom." + classroomId)
// .listen(".classwork-created", function (dataFromPusher) {
//       alert(dataFromPusher.user.name);
// });

window.Echo.private("App.Models.User." + userId)
      .notification(function (dataFromPusher) {
            Swal.fire({
                  position: 'bottom-end',
                  icon: "",
                  title: dataFromPusher.title,
                  showConfirmButton: false,
                  timer: 1500
                });
            // Swal.fire();
      });

// window.Echo.private("add-submission."+user_id).listen("AddSubmissionEvent", function (dataFromPusher) {
//             alert("There is Submission on " + dataFromPusher.classwork.title + " classwork")
//       });

// window.Echo.private("join-to-classroom."+ownerClassroomId).listen("JoinToClassroomEvent", function (dataFromPusher) {
//             alert("Ther is new user join to  " + dataFromPusher.classroom.name + " classroom")
//       });
      


