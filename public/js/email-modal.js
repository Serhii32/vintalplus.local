var modal = document.getElementById('order-modal');

var modal2 = document.getElementById('order-modal2');

var span = document.getElementById("order-close");

var hidden = document.getElementById("hidden-modal");

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}

function showModal(hiddenProductId) {
	hidden.value = hiddenProductId;
	modal.style.display = "block";
}
