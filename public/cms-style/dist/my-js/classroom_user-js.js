function confirmExitFromClassroom(id) {
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
            exitFromClassroom(id);

        }
    })
}

function exitFromClassroom(id) {
    const routeFormat = `/classrooms/${id}/exit`;
    axios.delete(routeFormat)
        .then(function (response) {
            document.getElementById(id).remove();
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: response.data["message"],
                showConfirmButton: false,
                timer: 1500
              });
        });
}