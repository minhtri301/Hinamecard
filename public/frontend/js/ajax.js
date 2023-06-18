// chỉnh sửa card trang information
$('.get-edit').on('click',  function(e){
    e.preventDefault();
    const el = $(this); 
    const url = $(this).data("href"); 
    $.ajax({
        type: 'GET', 
        url: url,
        dataType: "json",
        success: function (data) {  
            $('#modal-edit').modal('show');
            $('#get_add_icon').html(data.html);
        },
    })
});

// Xóa card trang information
$('.delete-card').on('click', function(){
    const el = $(this); 
    const url = $(this).data("href"); 
    $.ajax({
        type: 'GET', 
        url: url,
        dataType: "json",
        success: function (data) {  
            Toast.fire({
                iconColor: '#89B76C',
                icon: 'success',
                title: data.message,
                customClass: {
                title: 'success-title',
                timerProgressBar: 'timer-success',
                popup: 'border-toast'
                },
            })
            $('#sortable').html(data.html);
        },
    })
});



