
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

function deleteBook(bookId) {
    fetch('/books/' + bookId, { method: 'DELETE'})
        .then(response => response.json())
        .then(function(data) {
            $('#book-view-'+bookId).remove();
        });
}

async function addAuthor(fullName) {
    return fetch('/authors/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 'fullname': fullName })
    }).then(response => response.json())
}

async function addTranslator(fullName) {
    return fetch('/translators/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 'fullname': fullName })
    }).then(response => response.json())
}

async function addCategory(title, titleEng) {
    return fetch('/categories/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 'title': title, 'title_eng': titleEng })
    }).then(response => response.json())
}

async function addCycle(title) {
    return fetch('/cycles/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 'title': title })
    }).then(response => response.json())
}
