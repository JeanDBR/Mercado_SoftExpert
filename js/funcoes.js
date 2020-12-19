$(document).ready(function () {
    $(".maskmoney").maskMoney({thousands:'.', decimal:',', allowZero:false, prefix: 'R$ '});
});

function msg(msg) {
    Swal.fire({
        position: 'center',
        icon: msg[0],
        title: msg[1],
        timer: msg[2],
        timerProgressBar: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        text: msg[3],
        showConfirmButton: true,
        showCancelButton: false,
    });
}

function msgRefresh(msg) {
    Swal.fire({
        position: 'center',
        icon: msg[0],
        title: msg[1],
        timer: msg[2],
        timerProgressBar: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        text: msg[3],
        showConfirmButton: true,
        showCancelButton: false,
        onClose: () => {
            window.location.reload();
        },
    });
}

