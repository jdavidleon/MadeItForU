$(document).ready(startAjax);

	function startAjax() {
		base = $('#urlBase').val();
		$('.formAddCart').submit(addCart);
		$('.estado_eu').change(findCities);
		$('#formNews').submit(newNewsletter);
		$('#add_coupon').submit(addCoupon);
		$('input[name=dia_entrega]').change(updateDateForm);
	}


	/**/
	// function ajaxEvent() {
	// 	let username = $('#username').val();
	// 	let lastname = $('#lastname').val();
	// 	let method = $('#user_form').attr('method');
	// 	let action = $('#user_form').action;
	// }
	/**/

	/*Cookies Policy terms*/
	$('#alertCookiePol').on('closed.bs.alert', function () {	  	
		$.ajax({
			type: 'POST',
			url: base+'bd/cookie/cookie_policy.php'
		})
	})
	/*#Cookies Policy terms*/

	/*Bag user functions*/
		function addCart() {
			var lang = $('input[name=lang]').val();
			$.ajax({
				type: 'POST',
				data: $(this).serialize(),
				url: $(this).attr('action'),
				success: function (data) {	
					responds = data.trim();			
					if (responds === 'success_product_add') {
						$('.badge-cart').load(base+'bd/checkout/bag/cantidadBolsa.php');
						$('#previewCart ul.media-list').load(base+'bd/checkout/bag/recargar.php?lang='+lang)
						showAlert('success',responds);
						recalcularTotal();
  						fbq('track', 'AddToCart');
					}else{
						showAlert('error',responds);
					}
				}
			})
			return false;
		}

		function sumCart(bolsaID,productoID) {
			if (bolsaID === null) {
				bolsaID = 'null';
			}
			var valor = $('.cantidadBolsa'+productoID).val();
	        $datos  = {
	            'id_bolsa_compras': bolsaID,
	            'id_producto': productoID,
	            'empt_val': ''
	        }
			$.ajax({
				type: 'POST',
				data: $datos,
				url: base+'bd/checkout/bag/aumentar.php',
				success: function (data) {	
					$('.total-producto'+productoID).load(base+'bd/checkout/bag/totalProducto.php?id_producto='+productoID+'&empt_val=');	
					$('.cantidadBolsa'+productoID).val(Number(data));				
					calcularPrecioFinal();
					recalcularTotal();
					calcularCupon();
				}
			})
	    }

		function restCart(bolsaID = null,productoID) {		
			if (bolsaID === null) {
				bolsaID = 'null';
			}
			var valor = $('.cantidadBolsa'+productoID).val();
	        $datos  = {
	            'id_bolsa_compras': bolsaID,
	            'id_producto': productoID,
	            'empt_val': ''
	        }
			$.ajax({
				type: 'POST',
				data: $datos,
				url: base+'bd/checkout/bag/restar.php',
				success: function (data) {
					$('.total-producto'+productoID).load(base+'bd/checkout/bag/totalProducto.php?id_producto='+productoID+'&empt_val=');
					$('.cantidadBolsa'+productoID).val(Number(data));
					recalcularTotal();
					calcularPrecioFinal();
					calcularCupon();
				}
			})
	    }

	    function recalcularTotal() {
	    	$(".totalPagar").load(base+'bd/checkout/bag/recalcular_total.php');
	    }

	    function calcularPrecioFinal() {
	    	$(".total-final").load(base+'bd/checkout/bag/recalcular_precio_final.php');
	    }

	    function calcularCupon() {
	    	$(".cupon").load(base+'bd/checkout/bag/recalcular_cupon.php');
	    }

	    function deleteCartItem(num) {
	    	$('#deleteForm'+num).submit();
	    }

	    function addCoupon() {
	    	$.ajax({
				type: 'POST',
				data: $(this).serialize(),
				url: $(this).attr('action'),
				success: function (data) {	
					if (data.trim() == 'cupon agregado') {
						$('.area-cupon-success').removeClass('hide');
						$('.area-cupon-error').addClass('hide');
						$('.area-cupon-val').addClass('hide');
					}else{					
						$('.area-cupon-error').removeClass('hide');
						$('.area-cupon-success').addClass('hide');
						$('.area-cupon-val').addClass('hide');
					}
					calcularPrecioFinal();
					calcularCupon();
				}
			})
			return false;
	    }
	/*Bag user functions*/


	function updateDateForm() {
		var fecha = $(this).val();
		$('input[name=fecha_entrega]').val(fecha);
	}


	/*User profile info*/
	function editAddress(id_direccion,lang,urlOrigen) {
		$('#content_address_form').load(base+'bd/users/address/addressEdit.php?id_direcciones='+id_direccion+'&lang='+lang+'&urlOrigen='+urlOrigen);
		$('#addAddressModal').modal('toggle');
		$('#addAddressModal').on('shown.bs.modal', function (e) {
		 	startAjax();
		})
	}
	/*User profile info*/


    function findCities() {
		var stateID = $(this).val();
		$datos = {
			'id_estado_eu': stateID,
            'empt_val': ''
		}
		$.ajax({
			type: 'POST',
			data: $datos,
			url: base+'bd/specific/findCities.php',
			success: function (data) {
				$('.ciudades').html(data);
			}
		})
    }

    /*CONTACT FORM*/
	function contactForm() {
		$.ajax({
			type: 'POST',
			data: $(this).serialize(),
			url: $(this).attr('action'),
			success: function (data) {	
				responds = data.trim();			
				if (responds === 'recibido') {
					showAlert('success','Hemos recibido su mensaje nos pondremos en contacto pronto.');
				}else{
					showAlert('error','Ha ocurrido un error por favor intentalo nuevamente en un momento.');
				}
			}
		})
		return false;
	}


    /*FOOTER*/
    function newNewsletter() {   
    	$('#circularG').css('display','block');
    	$('#formNews').css('display','none');
		$.ajax({
			type: 'POST',
			data: $(this).serialize(),
			url: $(this).attr('action'),
			success: function (data) {
    			$('#circularG').css('display','none');
    			$('.cont-princ-news').html(data);
			}
		})
		return false;
    }
