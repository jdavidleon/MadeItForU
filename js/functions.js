
$(document).ready(start);


function start() {
    /*Principal Nav*/    
    $(document).scroll(princialNav);
    /*End principal Nav*/  

	/*Animations*/
    $("#loading").delay(2000).fadeOut(1200);
    $.fn.extend({
    animateCss: function (animationName) {
            var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            this.addClass('animated ' + animationName).one(animationEnd, function() {
                $(this).removeClass('animated ' + animationName);
            });
        }
    });
	// $('.cart-buttom').hover(cartAnimation,cartOut);
	$('.btn-nav').hover(animateBtn,animateBtnOut);
	$('#carousel-example-generic').on('slid.bs.carousel', function () {
	  	$('.proof').delay(200).addClass('animated bounceInUp');
	})

    /*WAYPOINTS ANIMATIONS*/
        $('.ref-about-info').waypoint(function() {
            $('.about-info').addClass('animated bounceInLeft');
            $('.about-info').css('opacity','1'); 
        }, {
          offset: '50%',
        });

        $('.about-img').waypoint(function() {     
            $('#img-aboutus').addClass('animated bounceInUp');
            $('#img-aboutus').css('opacity','1');
        }, {
          offset: '50%',
        });

        $('#offert').waypoint(function() {     
            $('#offert').addClass('animated bounceInUp');
            $('#offert').css('opacity','1');
        }, {
          offset: '20%',
        });

        $('#carousel').waypoint(function() {     
            // $('.jumbotron h1').addClass('animated bounceInRight');
            // $('.jumbotron h1').css('opacity','1');
            // $('.jumbotron p').addClass('animated bounceInRight');
            // $('.jumbotron p').css('opacity','1');
        }, {
          offset: '20%',
        });
    /*END WAYPOINTS ANIMATIONS*/

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

}   
    
    /*************************************    
                    HEADER
    **************************************/

    function changeLanguage() {
        var url = $('#languageSelect').val();
        window.location.assign(url);
    }

    /*Principal Nav*/
    function princialNav() {
        
        var obj = $(document);          //objeto sobre el que quiero detectar scroll
        var obj_top = obj.scrollTop()   //scroll vertical inicial del objeto
        obj.scroll(function(){
            var obj_act_top = $(this).scrollTop();  //obtener scroll top instantaneo
            if(obj_act_top > (obj_top + 350)){
                //scroll hacia abajo
                $('[data-toggle="popoverCart"]').popover('hide');
            }
             // var obj_act_top = $(this).scrollTop();  //obtener scroll top instantaneo
            // if (obj_act_top > 180) {            
            //     if(obj_act_top > obj_top){
            //         //scroll hacia abajo
            //         if (!$(".fixedNavbar").hasClass("fixed-nav")) {
            //             $(".fixedNavbar").addClass("fixed-nav");     
            //         }                          
            //         $(".nav-principal li .btn-nav").css("padding-top","19px");    
            //         $(".cart-buttom div .btn-group").css("top","15px"); 
            //     }else{
            //         //scroll hacia arriba
            //         if (!$(".fixedNavbar").hasClass("fixed-nav")) {
            //             $(".fixedNavbar").addClass("fixed-nav"); 
            //         }   
            //         $(".nav-principal li .btn-nav").css("padding-top","19px");  
            //         $(".cart-buttom div .btn-group").css("top","15px"); 
            //     }
            //     obj_top = obj_act_top;       //almacenar scroll top anterior
            // }else{            
            //     $(".fixedNavbar").removeClass("fixed-nav"); 
            //     $(".nav-principal li").css("height","40px"); 
            //     $(".cart-buttom div .btn-group").css("top","15px");   
            // }
        })
    }


    /***Popover***/  
    $(document).ready(function(){
        $('[data-toggle="popoverCart"]').popover({
            container: 'body',
            html: true,
            content: function () {
                $('.popover').empty();
                var clone = $($(this).data('popover-content')).clone(true).removeClass('hide');
                return clone;
            }
        }).click(function(e) {
            e.preventDefault();
        });   
    });

    $('[data-toggle="popoverCart"]').on('shown.bs.popover', function () {
        $('.close-popover').removeClass('hide');
    })

    $('.close-popover').click(function() {
        $('.close-popover').addClass('hide');
        $('[data-toggle="popoverCart"]').popover('hide');
    });


    function cartAnimation() {	
        $(this).addClass('animated tada');
    }
    function cartOut() {
        // $(this).animateCss('bounceIn');
    }

    function animateBtn() {
    	// $(this).addClass('fadeInUp');
    	$(this).animateCss('bounceIn');
    }
    function animateBtnOut() {
    	// $(this).animateCss('slideOutUp');
    }

    


    /*Hamburguer Menu*/
    function openNav() {
        document.getElementById("sideNavMb").style.width = "100%";
     //    setTimeout(function () {
     //    $('.fa-hamenu').addClass('animated slideInUp');
    	// }, 2000);
        $('.fa-hamenu').addClass('animated slideInUp');
        $('.logo-name').addClass('animated flipInX');
        $('.btn-mobile-menu').addClass('animated flipInY');
    }

    function closeNav() {
        document.getElementById("sideNavMb").style.width = "0";
        $('.fa-hamenu').removeClass('animated slideInUp');
        $('.logo-name').removeClass('animated flipInX');
        $('.btn-mobile-menu').removeClass('animated flipInY');

    }

    /*MODALS*/
    function closeSignUpModal() {
        $('#logInModal').on('shown.bs.modal', function (e) {
          $('#signUpModal').modal('hide');
        })        
    }
    function closeLogInModal() {      
        $('#logInModal').modal('hide'); 
        $('#logInModal').on('hidden.bs.modal', function (e) {
          $('#signUpModal').modal('show');
        })      
    }
    
     /*************************************    
                 VALIDATE FORM
    **************************************/
    
    /*VALIDATE EMAIL*/
    $('input[type=email]').keyup(function () {
        var mail = $(this).val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(mail)) {
            $(this).siblings('.validate_val').removeClass('hide');
        }else{
            $(this).siblings('.validate_val').addClass('hide');
        }
    })

    $('input[type=email]').blur(function () {
        var mail = $(this).val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(mail)) {
            $(this).siblings('.validate_val').removeClass('hide');
        }else{
            $(this).siblings('.validate_val').addClass('hide');
        }
    })

    /*VALIDATE EMPTY VALUES*/
    $(':input').keyup(function () {
        var value = $(this).val();
        if (value.trim() !== "") {
            $(this).siblings('.required').addClass('hide');
        }
    })

    $(':input').blur(function () {
        var value = $(this).val();
        if (value.trim() === "") {
            $(this).siblings('.required').removeClass('hide');
        }else{
            $(this).siblings('.required').addClass('hide');
        }
    })

    /*VALIDATE PASSWORD*/
    $(':input[type=password]').blur(function () {
        var pswd = $(this).val();
        /*lenght*/
        if ( pswd.length < 8 ) {
            $(this).siblings('.psw-lenght').removeClass('hide');
        } else {
            $(this).siblings('.psw-lenght').addClass('hide');
        }
        /*Letter*/
        if (!pswd.match(/[A-z]/) ) {
            $(this).siblings('.psw-letter').removeClass('hide');
        } else {
            $(this).siblings('.psw-letter').addClass('hide');
        }
        /*Number*/
        if (!pswd.match(/\d/) ) {
            $(this).siblings('.psw-number').removeClass('hide');
        } else {
            $(this).siblings('.psw-number').addClass('hide');
        }
    })

    $(':input[type=password]').keyup(function () {
        var pswd = $(this).val();
        /*lenght*/
        if ( pswd.length > 8 ) {
            $(this).siblings('.psw-lenght').addClass('hide');
        }
        /*Letter*/
        if ( pswd.match(/[A-z]/) ) {
            $(this).siblings('.psw-letter').addClass('hide');
        }
        /*Number*/
        if ( pswd.match(/\d/) ) {
            $(this).siblings('.psw-number').addClass('hide');
        }
    })

    $(':input[name=telefono_contacto]').keyup(function() {
        var phone = $(this).val();
        if ( !phone.match(/\d/) || phone.match(/[A-z]/)) {
            $(this).siblings('.validate_val').removeClass('hide');
        }else{
            $(this).siblings('.validate_val').addClass('hide');
        }
    })

    $('.val_lentgh_txt').keyup(function () {
        var message = $(this).val();
        var maxlenght = $(this).attr('maxlength');
        $(this).siblings('.msn-lenght').find('span').html(maxlenght - message.length);
        if (message.length > maxlenght) {
            $(this).siblings('.msn-lenght-rev').removeClass('hide');
        }else if (message.length == maxlenght) {
            $(this).siblings('.msn-lenght').removeClass('text-success');
            $(this).siblings('.msn-lenght').addClass('text-danger');            
        }else{
            $(this).siblings('.msn-lenght').removeClass('text-danger');
            $(this).siblings('.msn-lenght').addClass('text-success');
            $(this).siblings('.msn-lenght-rev').addClass('hide');
        }
    })

    /*************************************    
                    ALERTS
    **************************************/

    function showAlert(type,txt) {
        if (txt === 'success_product_add' || txt === 'success_product_delete' || txt === 'BAG_ERROR_EXIST' || txt === 'ERROR_PRODUCT_DELETE' || txt === 'ERROR_PRODUCT_ADD') {
            txt = $('#'+txt).val();
        }
        if (type === 'success') {
            $('#successAlertTxt').html(txt);
            $('.container-alert-success').css({'opacity':'0.95','display':'block'});
            $('.alert-success-mifu').addClass('animated bounceInRight');

            setTimeout(function () {
                $('.alert-success-mifu').removeClass('animated bounceInRight');
                $('.container-alert-success').animate({
                    opacity: '0',
                },'slow').delay(500).css('display','none');
            }, 12000);
        }

        if (type === 'error') {
            $('#wrongAlertTxt').html(txt);
            $('.container-alert-wrong').css({'opacity':'0.95','display':'block'});
            $('.alert-wrong-mifu').addClass('animated bounceInRight');

            setTimeout(function () {
                $('.alert-wrong-mifu').removeClass('animated bounceInRight');
                $('.container-alert-wrong').animate({
                    opacity: '0',
                },'slow').delay(500).css('display','none');
            }, 12000);
        }
    }

    $('.alert-success-mifu').on('closed.bs.alert', function () {
        $('.alert-success-mifu').removeClass('animated bounceInRight');
        $('.container-alert-success').css({'display':'none', 'opacity' : '0'});
    })

    $('.alert-wrong-mifu').on('closed.bs.alert', function () {
        $('.alert-wrong-mifu').removeClass('animated bounceInRight');
        $('.container-alert-wrong').css({'display':'none', 'opacity' : '0'});
    })

    function selectDir(direccionID) {
        $('.block-dir').css('border-color','grey');        
        $('.block-dir address').css('color','grey');
        $('#id_direccion_paypal').val(direccionID);
        $('.block-dir-'+direccionID).css('border-color','#4DB4A5');
        $('.block-dir-'+direccionID+' address').css('color','#4DB4A5');
        $('.fa-check-square-o').addClass('hide');
        $('.fa-square-o').removeClass('hide');
        $('.icon-selected-'+direccionID).removeClass('hide');
        
    }

    
    
    /*************************************    
                    FORMS
    **************************************/

    function deleteAddress(addressID) {
        $('#formDeleteAddress'+addressID).submit();
    }
    
    /*************************************    
                    CHECKOUT
    **************************************/

    $('.btn-form-pers').click(function() {
        var form = $(this).attr('btn-form');
        $('.'+form).toggle("slow");       
        $(this).toggle("fast");       
    })