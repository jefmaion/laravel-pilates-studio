$('[name=zipcode]').keyup(function (e) {
    var zipcode = $(this).val()
    if (zipcode.length < 9) return

    $.ajax({
        type: "get",
        url: "/helper/zipcode/" + zipcode,
        dataType: "json",
        beforeSend: function (e) {
            $('.viacep-loading').val('...')
        },
        success: function (response) {
            $('.viacep-loading').val('')
            console.log(response)
            if (response.status) {
                $('[name=address]').val(response.data.logradouro)
                $('[name=district]').val(response.data.bairro)
                $('[name=city]').val(response.data.localidade)
                $('[name=state]').val(response.data.uf)
                $('[name=number]').focus()
                return
            }
        }
    });
});