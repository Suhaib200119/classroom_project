function confirmDeleteItem_softDelete(id) {
    Swal.fire({
        title: 'هل أنت متأكد',
        text: "بإمكانك إسترجاع العنصر الذي تريد حذفه",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم',
        cancelButtonText:"إلغاء",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteItem_softDelete(id);

        }
    })
}

function deleteItem_softDelete(id) {
    const routeFormat = `/classrooms/${id}`;
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

// force delete
function confirmDeleteItem_forceDelete(id) {
    Swal.fire({
        title: 'هل أنت متأكد',
        text: "لن يكون بإمكانك إسترجاع العنصر الذي تريد حذفه",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم',
        cancelButtonText:"إلغاء",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteItem_forceDelete(id);

        }
    })
}

function deleteItem_forceDelete(id) {
    console.log(id);
    const routeFormat = `/classrooms/${id}/forceDelete`;
    axios.delete(routeFormat)
        .then(function (response) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: response.data["message"],
                showConfirmButton: false,
                timer: 1500
              });
            document.getElementById(id).remove();
        }).catch(function(error){
           
            Swal.fire(
                "خطأ",
                response.data["message"],
                'error'
            );
        });
}

