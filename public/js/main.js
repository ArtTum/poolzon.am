var win = $(window);
var p = 1;
win.scroll(function() {
    var maxPage = parseInt($('.page-count').data('max'));
    if (parseInt($(document).height() - win.height()) <= parseInt(win.scrollTop() + 500)) {
        $('#content').addClass('active');
        if ($("#content").hasClass('active')) {
            p++;
            console.log(maxPage);
            if (p <= maxPage) {
                if(maxPage){
                    $('footer').addClass('hide');
                }
                $('#loading').show();

                $.ajax({
                    url: window.location+'?page='+p,
                    type: "GET",
                    async: false,
                    success: function(html) {
                        setTimeout(function(){
                                $("#content").append(html);
                            }, 500
                        );

                    }
                });
            } else if(p <=  (parseInt($('.page-count').data('max')+1)) ){
                $('#loading').hide();
                $('footer').removeClass('hide');
                console.log(p);
                return false;
            }
        }
    }
});

//Tabs
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tab-links");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();


/////////

function toggleClass(id) {
    document.getElementById(id).classList.toggle('show');
    // document.getElementsByTagName("html")[0].classList.toggle('no-scroll');
}

function close(id) {
    document.getElementById(id).classList.remove('show');
}

function toggleBoxes(id, boxId) {
    var e = document.getElementById(id);
    var b = document.getElementById(boxId);

    if(e.style.display == 'block') {
        e.style.display = 'none';
        b.classList.remove('opened')
    }
    else {
        e.style.display = 'block';
        b.classList.add('opened')
    }
}

function openModal(modalId) {
    document.getElementById(modalId).classList.remove('fade');
    document.getElementsByTagName("html")[0].classList.add('no-scroll');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('fade');
    document.getElementsByTagName("html")[0].classList.remove('no-scroll');
}

function togglePopup() {
    document.getElementById("calculatorPopup").classList.toggle('show');
    document.getElementsByTagName("html")[0].classList.toggle('no-scroll');
}

var favorites = document.querySelectorAll(".product-item .favorite");

favorites.forEach((item) => {
        item.addEventListener('click', () => {
        item.classList.toggle('active')
    });
});


//input not empty

var input = document.querySelectorAll('.def-input--secondary input');


input.forEach((item) => {
    item.addEventListener('input', evt => {
        const value = item.value;

        if (!value) {
            item.dataset.state = '';
            return;
        }

        const trimmed = value.trim();

        if (trimmed) {
            item.dataset.state = 'valid';
        } else {
            item.dataset.state = 'invalid';
        }
    });
});

$(".add-cart").submit(function(event) {
    event.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    formdata = new FormData($(this)[0]);
    $.ajax({
        url: $(this).attr('action'),
        contentType: false,
        processData: false,
        data: formdata,
        type: 'POST',
        success: function(response)
        {
            $('.cart-button__count').text(response.count);
            $('.total-count').text(response.count);
        },
        error: function (errors) {
            console.log(errors);
        }

    });
    return false;
});
function addCart(theForm) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        data: $(theForm).serialize(),
        type: $(theForm).attr('method'),
        url: $(theForm).attr('action'),
        success: function(response)
        {
            $('.cart-button__count').text(response.count);
            $('.total-count').text(response.count);
        },
        error: function (errors) {
            console.log(errors);
        }

    });
    return false;
};
function updateCart(theForm) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        data: $(theForm).serialize(),
        type: $(theForm).attr('method'),
        url: $(theForm).attr('action'),
        success: function(response)
        {
            $('.cart-button__count').text(response.count);
            $('.total-count').text(response.count);
            $('.total-price').text(response.totalPrice);
            $('#old-count-'+response.id).val(response.quantity);
        },
        error: function (errors) {
            console.log(errors);
        }

    });
    return false;
};

$(".remove-cart").submit(function(event) {
    event.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    formdata = new FormData($(this)[0]);
    $.ajax({
        url: $(this).attr('action'),
        contentType: false,
        processData: false,
        data: formdata,
        type: 'POST',
        success: function(response)
        {
            $('.cart-button__count').text(response.count);
            $('.total-count').text(response.count);
            $('.total-price').text(response.totalPrice);
            $('#item-'+response.id).remove();
        },
        error: function (errors) {
            console.log(errors);
        }

    });
    return false;
});
$('#selectAllDomainList').click (function () {
    var checkedStatus = this.checked;
    $( ".flex-table__row" ).find('.def-checkbox input').each(function( index ) {
        $(this).prop('checked', checkedStatus);
    });
});

$('#remove-all').click (function () {
    var ids = [];
    $( ".flex-table__row" ).find('.def-checkbox input').each(function( index ) {
        if ($(this).is(':checked')) {
            var id = $( this ).val();
            ids.push(id);
            $('#item-' + id).remove();
        }
    });
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    var url = '/cart-remove-all';
    var formData = new FormData();

    formData.append("ids", ids);

    $.ajax({
        type: "POST",
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('.cart-button__count').text(response.count);
            $('.total-count').text(response.count);
            $('.total-price').text(response.totalPrice);
        },
        error: function (msg) {
            console.log(msg);
        }
    });

});

$('#city-disabled').click (function () {
    $('#qaxaqtext').toggle();
});
function addFavorite(a) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST", url: "/favorites/add", data: "id=" + a, dataType: "json", async: !1, success: function (t) {
            $(".wish-list-count").html(t.total_count);
            $('.f-'+a).addClass('activea');
        }
    });
}

function removeFavorite(a) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST", url: "/favorites/remove", data: "id=" + a, dataType: "json", async: !1, success: function (t) {

            $(".wish-list-count").html(t.total_count);
            $(".item-"+t.id).remove();

        }
    });
}
