
function addReservation(bookId, button) {
    fetch('/books/' + bookId + '/reserve')
        .then(response => response.json())
        .then(function(data) {
            if (data.result) {
                $(button).text('Убрать')
                $(button).off('click').click(function() {removeReservation(bookId, button)});
            } else {
                $(button).text('Отложить')
                $(button).off('click').click(function() {addReservation(bookId, button)});
            }
        });
}

function removeReservation(bookId, button, remove = false ) {
    fetch('/books/' + bookId + '/unreserve')
        .then(response => response.json())
        .then(function(data) {
            if (data.result) {
                $(button).text('Отложить');
                $(button).off('click').click(function() {addReservation(bookId, button)});
                if (remove) {
                    $('#book-view-'+bookId).remove();
                }
            } else {
                $(button).text('Убрать')
                $(button).off('click').click(function() {removeReservation(bookId, button)});
            }
        });
}
