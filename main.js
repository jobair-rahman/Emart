$(document).ready(function () {
    product();

    // get all products
    function product() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {getProduct: 1},
            success: function (data) {
                $("#get_product").html(data);
            }
        })
    }

    

    // change product list on category select
    $('.category').click(function (event) {
        $("#get_product").html("<h3>Loading...</h3>");
        event.preventDefault(); //prevent link change
        var cid = $(this).attr('cid');

        $.ajax({
            url: "action.php",
            method: "POST",
            data: {get_seleted_Category: 1, cat_id: cid},
            success: function (data) {
                $("#get_product").html(data);
                if ($("body").width() < 480) {
                    $("body").scrollTop(683);
                }
            }
        })

    })

    // change product list on brand select
    $(".selectBrand").click(function (event) {
        event.preventDefault();
        $("#get_product").html("<h3>Loading...</h3>");
        var bid = $(this).attr('bid');
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {selectBrand: 1, brand_id: bid},
            success: function (data) {
                $("#get_product").html(data);
                if ($("body").width() < 480) {
                    $("body").scrollTop(683);
                }
            }
        })

    })
    // change product list on search
    $("#search_btn").click(function (event) {
        event.preventDefault();
        $("#get_product").html("<h3>Loading...</h3>");
        var keyword = $("#search").val();
        if (keyword != "") {
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {search: 1, keyword: keyword},
                success: function (data) {
                    $("#get_product").html(data);
                    if ($("body").width() < 480) {
                        $("body").scrollTop(683);
                    }
                }
            })
        }
    })
    //end


   
    $("#login").on("submit", function (event) {
        event.preventDefault();
        $(".overlay").show();
        $.ajax({
            url: "login.php",
            method: "POST",
            data: $("#login").serialize(),
            success: function (data) {
                if (data == "login_success") {
                    window.location.href = "profile.php";
                } else if (data == "cart_login") {
                    window.location.href = "cart.php";
                } else {
                    $("#e_msg").html(data);
                    $(".overlay").hide();
                }
            }
        })
    })
    //end

    //Get User Information before checkout
    $("#signup_form").on("submit", function (event) {
        event.preventDefault();
        $(".overlay").show();
        $.ajax({
            url: "register.php",
            method: "POST",
            data: $("#signup_form").serialize(),
            success: function (data) {
                $(".overlay").hide();
                if (data == "register_success") {
                    window.location.href = "cart.php";
                } else {
                    $("#signup_msg").html(data);
                }

            }
        })
    })
    //Get User Information before checkout end here

    //Add Product into Cart
    $("body").delegate("#product", "click", function (event) {
        var pid = $(this).attr("pid");
        event.preventDefault();
        $(".overlay").show();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {addToCart: 1, proId: pid},
            success: function (data) {
                count_item();
                getCartItem();
                $('#product_msg').html(data);
                $('.overlay').hide();
            }
        })
    })
    //Add Product into Cart End Here
    //Count user cart items function
    count_item();

    function count_item() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {count_item: 1},
            success: function (data) {
                $(".badge").html(data);
            }
        })
    }

    //Count user cart items function end

    //Fetch Cart item from Database to dropdown menu
    getCartItem();

    function getCartItem() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {Common: 1, getCartItem: 1},
            success: function (data) {
                $("#cart_product").html(data);
            }
        })
    }

    //Fetch Cart item from Database to dropdown menu

   
    $("body").delegate(".qty", "keyup", function (event) {
        event.preventDefault();
        var row = $(this).parent().parent();
        var price = row.find('.price').val();
        var qty = row.find('.qty').val();
        if (isNaN(qty)) {
            qty = 1;
        }
        ;
        if (qty < 1) {
            qty = 1;
        }
        ;
        var total = price * qty;
        row.find('.total').val(total);
        var net_total = 0;
        $('.total').each(function () {
            net_total += ($(this).val() - 0);
        })
        $('.net_total').html("Total : $ " + net_total);

    })
    //Change Quantity end here

    /*
        whenever user click on .remove class we will take product id of that row
        and send it to action.php to perform product removal operation
    */
    $("body").delegate(".remove", "click", function (event) {
        var remove = $(this).parent().parent().parent();
        var remove_id = remove.find(".remove").attr("remove_id");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {removeItemFromCart: 1, rid: remove_id},
            success: function (data) {
                $("#cart_msg").html(data);
                checkOutDetails();
            }
        })
    })
    /*
        whenever user click on .update class we will take product id of that row
        and send it to action.php to perform product qty updation operation
    */
    $("body").delegate(".update", "click", function (event) {
        var update = $(this).parent().parent().parent();
        var update_id = update.find(".update").attr("update_id");
        var qty = update.find(".qty").val();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {updateCartItem: 1, update_id: update_id, qty: qty},
            success: function (data) {
                $("#cart_msg").html(data);
                checkOutDetails();
            }
        })


    })
    checkOutDetails();
    net_total();

    
    function checkOutDetails() {
        $('.overlay').show();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {Common: 1, checkOutDetails: 1},
            success: function (data) {
                $('.overlay').hide();
                $("#cart_checkout").html(data);
                net_total();
            }
        })
    }

    /*
        net_total function is used to calcuate total amount of cart item
    */
    function net_total() {
        var net_total = 0;
        $('.qty').each(function () {
            var row = $(this).parent().parent();
            var price = row.find('.price').val();
            var total = price * $(this).val() - 0;
            row.find('.total').val(total);
        })
        $('.total').each(function () {
            net_total += ($(this).val() - 0);
        })
        $('.net_total').html("Total : " + CURRENCY + " " + net_total);
    }

    //remove product from cart

    page();

    function page() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {page: 1},
            success: function (data) {
                $("#pageno").html(data);
            }
        })
    }

    $("body").delegate("#page", "click", function () {
        var pn = $(this).attr("page");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {getProduct: 1, setPage: 1, pageNumber: pn},
            success: function (data) {
                $("#get_product").html(data);
            }
        })
    })
})




















