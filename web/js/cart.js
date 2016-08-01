function showCart(cart){
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
}

$('.add-to-cart').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var count = $('#count').val();
    $.ajax({
        url: '/cart/add',
        data: {
            id: id,
            count: count
        },
        type: 'GET',
        success: function(res){
            if(!res) alert('Ошибка!');
            showCart(res);
        },
        error: function(){
            alert('Error!');
        }
    });
});

$('#clear').on('click', function(e){
    e.preventDefault();
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function(res){
            if(!res) alert('Ошибка!');
            showCart(res);
        },
        error: function(){
            alert('Error!');
        }
    });
});

$('#cart .modal-body').on('click', '.del-item', function(){
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/remove',
        data:{id: id},
        type: 'GET',
        success: function(res){
            if(!res) alert('Ошибка!');
            showCart(res);
        },
        error: function(){
            alert('Error!');
        }
    });
});

$('.show-cart').on('click', function(e){
    e.preventDefault();
    $.ajax({
        url: '/cart/show',
        type: 'GET',
        success: function(res){
            if(!res) alert('Ошибка!');
            showCart(res);
        },
        error: function(){
            alert('Error!');
        }
    });
});

$('a.del-item').on('click', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/cart/remove',
        data:{id: id},
        type: 'GET',
        success: function(res){
            if(!res) alert('Ошибка!');
            location.reload();
        },
        error: function(){
            alert('Error!');
        }
    });
})