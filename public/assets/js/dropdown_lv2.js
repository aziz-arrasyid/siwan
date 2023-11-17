$('#competences').change(function () {
    var compID = $(this).val();
    if (compID) {
        $.ajax({
            type: "GET",
            url: `/dashboard-admin/getClassroom/${compID}`,
            dataType: 'JSON',
            success: function (result) {
                $("#classroom").empty();
                $("#classroom").append('<option selected disabled>Pilih Salah satu</option>');
                $.each(result, function (id, classroom_name) {
                    $("#classroom").append('<option value="' + id + '">' + classroom_name + '</option>');
                });
            }
        });
    } else {
        $("#classroom").empty();
    }
});
