$(document).ready(function () {

    // banner owl carousel
    $("#banner-area .owl-carousel").owlCarousel({
        dots: true,
        items: 1
    });

    // top sale owl carousel
    $("#top-sale .owl-carousel").owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    // isotope filter
    var $grid = $(".grid").isotope({
        itemSelector: '.grid-item',
        layoutMode: 'fitRows'
    });

    // filter items on button click
    $(".button-group").on("click", "button", function () {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
    })

    /*// product qty section
     let $qty_up = $(".qty .qty-up");
     let $qty_down = $(".qty .qty-down");
     //let $input = $(".qty .qty_input");

    // click on qty up button
    $qty_up.click(function(e){
        let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        if($input.val() >= 1 && $input.val() <= 9){
            $input.val(function(i, oldval){
                return ++oldval;
            });
        }
    });

       // click on qty down button
       $qty_down.click(function(e){
        let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        if($input.val() > 1 && $input.val() <= 10){
            $input.val(function(i, oldval){
                return --oldval;
            });
        }
    });*/

});

function ajax() {
    const qtyUpBtn = document.querySelectorAll('.qty-up');
    const qtyDownBtn = document.querySelectorAll('.qty-down');

    qtyUpBtn.forEach(function (item) {
        item.addEventListener('click', qtyUpDown);
    });

    qtyDownBtn.forEach(function (item) {
        item.addEventListener('click', qtyUpDown);
    });

    /*function qtyUp(){
        const itemId = this.getAttribute('data-id');
        const qtyInput = document.querySelector(`.class${itemId}`);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', './template/_ajax.php' ,true);
        xhr.setRequestHeader("Content-type", "application/json");
        xhr.onload=function () {
            if(this.status===200){
                qtyInput.value = 8;
                //console.log('hey');
            }
            //console.log('hey');
        };
        const params=`{
            "item_id" = ${itemId};
        }`;
        xhr.send(params);
    }

    function qtyDown(){
        const itemId = this.getAttribute('data-id');
        const qtyInput = document.querySelector(`.class${itemId}`);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', './template/_ajax.php' ,true);
        xhr.setRequestHeader("Content-type", "application/json");
        xhr.onload=function () {
            if(this.status===200){
                qtyInput.value = 8;
                //console.log('hey');
            }
            //console.log('hey');
        };
        const params=`{
            "item_id" = ${itemId};
        }`;
        xhr.send(params);
    }*/

    function qtyUpDown() {
        const currentBtn = this;
        const itemId = this.getAttribute('data-id');
        const qtyInput = document.querySelector(`.class${itemId}`);
        const itemPriceElement = document.querySelector(`.price${itemId}`);
        const subTotal = document.querySelector('#deal-price');
        const xhr = new XMLHttpRequest();
        xhr.open('POST', './template/_ajax.php', true);
        //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.setRequestHeader("Content-type", "application/json");
        xhr.onload = function () {
            if (this.status === 200) {
                const jsonEncodedString = this.responseText;
                const jsObject = JSON.parse(jsonEncodedString);
                const productRow = jsObject[0];
                const productPrice = productRow['item_price'];
                if (currentBtn.classList.contains('qty-up')) {
                    qtyInput.value = parseInt(qtyInput.value) + 1;
                    subTotal.innerText = parseInt(subTotal.innerText) + parseInt(productPrice);
                }
                else if (currentBtn.classList.contains('qty-down')) {
                    if (parseInt(qtyInput.value) > 1) {
                        qtyInput.value = parseInt(qtyInput.value) - 1;
                        subTotal.innerText = parseInt(subTotal.innerText) - parseInt(productPrice);
                    }
                }
                itemPriceElement.innerText = parseInt(productPrice) * parseInt(qtyInput.value);
            }
        };
        //xhr.send(`item_id=${itemId}`);
        xhr.send(`{"item_id": ${itemId}}`);
    }
}

ajax();