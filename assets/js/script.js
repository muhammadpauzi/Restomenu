// Show file name in the input or label file input image
$('#gambar').on('change', function () {
    $('.custom-file-label').html($(this).val().split('\\').pop());
});

// Show Password
$('#showPass').on('change', function (e) {
    if (e.target.checked) {
        $('#password').attr('type', 'text');
    } else {
        $('#password').attr('type', 'password');
    }
});

$('.table').on('click', 'img', function () {
    console.log(this.src);
    $('#imageModal-image').attr('src', this.src);
});