function confirmExitFromClassroom(classroom_id,user_id) {
    console.log(classroom_id,user_id);
    Swal.fire({
        title: 'هل أنت متأكد',
        text: "لن يكون بإمكانك رؤية مهام الفصل بعد مغادرته",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم',
        cancelButtonText:"إلغاء",
    }).then((result) => {
        if (result.isConfirmed) {
            exitFromClassroom(classroom_id,user_id);

        }
    })
}

function exitFromClassroom(classroom_id,user_id) {
    const routeFormat = `/classrooms/${classroom_id}/exit/${user_id}`;
    axios.delete(routeFormat)
        .then(function (response) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: response.data["message"],
                showConfirmButton: false,
                timer: 1500
              });
            document.getElementById(user_id).remove();
        });
}