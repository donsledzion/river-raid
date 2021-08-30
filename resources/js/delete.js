$(function(){
    $('.delete').click(function()
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                //console.log('deleteUrl = ' + deleteUrl);
                $.ajax({
                    method: 'DELETE',
                    url: deleteUrl + $(this).data("class") + "/" + $(this).data("id")
                }).done(function(data){
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then((result) => {
                        if(result.isConfirmed){
                            location.reload();
                        }
                    })
                }).fail(function(data){
                    Swal.fire({
                        title: 'Error',
                        text: "There was an error!",
                        icon: 'error',
                    })
                });
            }
        })
    });
});
