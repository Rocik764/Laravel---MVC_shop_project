$(document).ready(function () {
    $(".minus").on("click", function (evt) {
        evt.preventDefault()
        let productId = $(this).attr("id")
        let amountInput = $("#amount" + productId)

        let newAmount = parseInt(amountInput.val()) - 1
        if(newAmount > 0) amountInput.val(newAmount)
    })

    $(".plus").on("click", function (evt) {
        evt.preventDefault()
        let productId = $(this).attr("id")
        let amountInput = $("#amount" + productId)

        let newAmount = parseInt(amountInput.val()) + 1
        if(newAmount > 0) amountInput.val(newAmount)
    })
})
