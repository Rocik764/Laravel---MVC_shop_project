$(document).ready(function () {
    $("#buttonAddToCart").on("click", function (e) {
        e.preventDefault()
        addToCart()
    })
})


function addToCart() {
    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
    let amount = $("#amount" + productId).val()
    let id = productId
    let url = url_route

    console.log(amount);
    console.log(url);
    console.log(CSRF_TOKEN);
    console.log(id);

    $.ajax({
        type: "POST",
        url: url,
        data:{
            id:id,
            amount:amount,
            _token: CSRF_TOKEN
        },
    }).done(function (response) {
        $("#modalTitle").text("Cart")
        $("#modalBody").text(response)
        $("#myModal").modal()
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log("failed: ");
        console.log(jqXHR.responseText);
        console.log(textStatus);
        console.log(errorThrown);
        $("#modalTitle").text("Cart")
        $("#modalBody").text("Error")
        $("#myModal").modal()
    })
}
