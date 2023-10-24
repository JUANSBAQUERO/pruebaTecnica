setTimeout(function() {
    let flashToast = document.querySelector('.flash-toast');
    if (flashToast) {
        flashToast.style.display = 'none';
    }
}, 3000);

let userId;
$('#deleteModal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    userId = button.data('userid');
    let usuario = button.data('usuario');
    $('.data-body').text(`¿Está seguro de eliminar el usuario ${usuario}?`)
    let modal = $(this);
    modal.find('#id_user').val(userId);
});

$('#confirmDeleteLink').on('click', function () {
    let csrfToken = $('[name="_csrfToken"]').val();
    $.ajax({
        type: 'POST',
        url: `users/userIdDelete/${userId}`,
        headers: {
            'X-CSRF-Token': csrfToken
        },
        dataType: 'json',
        success: function(response) {
            $('#deleteModal').modal('hide');
            if (response.status === 200) {
                let toast = document.createElement('div');
                toast.className = 'toast align-items-center text-bg-success border-0 d-block mt-3 position-absolute';
                toast.style = 'bottom: 5%; right: 2%';
                toast.role = 'alert';
                toast.setAttribute('aria-live', 'assertive');
                toast.setAttribute('aria-atomic', 'true');
                toast.innerHTML = '<div class="toast-body text-center">' + response.message + '</div>';
                document.querySelector('#toast').appendChild(toast);
        
                setTimeout(function() {
                    location.reload();
                }, 2000);
            } else {
                let toast = document.createElement('div');
                toast.className = 'toast align-items-center text-bg-danger border-0 d-block mt-3 position-absolute';
                toast.style = 'bottom: 5%; right: 2%';
                toast.role = 'alert';
                toast.setAttribute('aria-live', 'assertive');
                toast.setAttribute('aria-atomic', 'true');
                toast.innerHTML = '<div class="toast-body text-center">' + response.message + '</div>';
                document.querySelector('#toast').appendChild(toast);
            }
        }
        
    });
})

$('.toggle-password').on('click', function () {
    let input = $('#togglePassword')
    if (input.attr('type') === 'password') {
        input.attr('type','text');
        $(this).html('<i class="bi bi-eye"></i>')
    } else {
        input.attr('type','password');
        $(this).html('<i class="bi bi-eye-slash"></i>')
    }
})
