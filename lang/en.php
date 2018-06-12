<?php 

/************************************************
 -------------------GLOBAL-----------------------
************************************************/
  
  /*TITLES*/
  $titleIndex = 'Home';
  $titleCheckout = 'Checkout';
  $title404 = 'Page not found';
  $titleLogIn = 'Log In';
  $titleRestore = 'Password Restore';
  $titleUnsubscribeNews = 'Newsletter';
  $titleTerms = 'Terms and Conditions';
  $titleAboutUs = 'About Us';
  $titleBasket = 'Basket';
  $titleBasketAddress = 'Address';
  $titleUsers = 'Users';
  $titlePayment = 'Payment';

  /*CONTENT*/
  $contentDescription = 'Surprise that special person with a surprise breakfast';

 
/************************************************
 -------------------HEADER-----------------------
************************************************/
  
  /*Index*/
  $btnUser = 'Log In';

  /*Principal nav*/
  $out = 'url_out';
  $menu = [
      [ 'btn' => 'home', 'url' => URL_BASE.$lang, 'url_out' => URL_BASE.$lang, 'icon' => 'fa-home' ],
      [ 'btn' => 'about us', 'url' => URL_BASE.$lang.'/bussiness/about_us', 'url_out' => URL_BASE.$lang.'/bussiness/about_us', 'icon' => 'fa-hand-o-right' ],
      [ 'btn' => 'products', 'url' => '#menu-list', 'url_out' => URL_BASE.$lang.'/#menu-list', 'icon' => 'fa-cutlery' ],
      [ 'btn' => 'testimonials', 'url' => '#testimonials', 'url_out' => URL_BASE.$lang.'/#testimonials',  'icon' => 'fa-users' ],
      [ 'btn' => 'contact', 'url' => '#contact', 'url_out' => URL_BASE.$lang.'/#contact', 'icon' => 'fa-paper-plane' ]
  ];
	$convert = json_encode($menu);    
	$principalNav  = (object)json_decode($convert); 


  /*User Menu*/
  if (isset($_SESSION['user'])) {
    
    $menuUser = [

   (object) [ 'btn' => 'My Account', 'url' => URL_BASE.'en/user/customer-account/', 'icon' => 'fa-user-circle' ],
   (object) [ 'btn' => 'My Orders', 'url' => URL_BASE.'en/user/customer-orders/', 'icon' => 'fa-list' ],
   (object) [ 'btn' => 'My Basket', 'url' => URL_BASE.'en/checkout/basket/', 'icon' => 'fa-shopping-basket' ],
   (object) [ 'btn' => 'My Addresses', 'url' => URL_BASE.'en/user/customer-address', 'icon' => 'fa-truck' ],
   (object) [ 'btn' => 'Log Out', 'url' => URL_BASE.'bd/users/logout.php?csrf='.$_SESSION['csrf_token'], 'icon' => 'fa-sign-out' ]

     ];

    // $convert = json_encode($userMenu);    
    // $menuUser  = (object)json_decode($convert); 
  }

  /*User Menu*/
  $logMenu = [

   [ 'btn' => 'Log In', 'icon' => 'fa-sign-in', 'modal' => '#logInModal' ],
   [ 'btn' => 'Sign Up', 'icon' => 'fa-sign-out', 'modal' => '#signUpModal' ]

    ];

  $convert = json_encode($logMenu);    
  $menuLog  = (object)json_decode($convert); 
  
/************************************************
 ------------------MODALS----------------------
************************************************/
  
  $modalLogIn = [
    'title' => 'Log In',
    'user' => 'Email',
    'psw' => 'Password',
    'save' => 'Remember me',
    'btn' => 'Log In',
    'remember' => 'Save',
    'forgot' => 'Forgot password?',
    'btnSignUp' => 'Sign In'
  ];

  $convert = json_encode($modalLogIn);    
  $loginM  = (object)json_decode($convert); 

  
  $modalSignUp = [
    'title' => 'Sign In',
    'gender' => 'How should we treat you?',
    'gender_woman' => 'Mrs.',
    'gender_man' => 'Mr.',
    'name' => 'Name',
    'last_name' => 'Last Name',
    'mail' => 'Email',
    'psw' => 'Password',
    'born' => 'Birthdate',
    'born_day' => 'DAY',
    'born_month' => 'MONTH',
    'born_year' => 'YEAR',
    'btn' => 'Sign In',
    'already' => 'Already have an account?',
    'btnLogIn' => 'Log In',
    'btnSignUp' => 'Sign In',
    'terms' => 'By registering you accept the <a style="color:#6DC0B4;" href="'.URL_BASE.$lang.'/bussiness/terms">terms and conditions</a>.',
  ];

  $convert = json_encode($modalSignUp);    
  $signUpM  = (object)json_decode($convert); 

/************************************************
 ------------------PRODUCTS----------------------
************************************************/

/************************************************
 ------------------PRODUCTS----------------------
************************************************/
  
  $secProducts = [
    'title' => 'Porduct List',
    'footTitle' => 'The ideal gift for every occasion, an anniversary, birthday or if you just want to express your love',
    'btnAll' => 'Show All',
    'details' => 'details',
    'quantity' => 'quantity',
    'addCart' => 'Add to Basket',
    'testimonials' => 'Our Clients Says',
    'include' => 'It includes',
    'content' => 'Contents of the basket',
    'other_products' => 'More Options to Surprise',
  ];

  $convert = json_encode($secProducts);    
  $productSec  = (object)json_decode($convert); 
  
/************************************************
 ---------------PRINCIPAL INDEX------------------
************************************************/
 $indexPrincipal = [
    'pharse' => 'Give Breakfast of Love',
    'sentence' => 'The special gift you were looking for',
    'btn_principal' => 'Order Now',
    'how_shop' => 'How to Buy It ?',
    'btn_how_to' => 'Show breakfasts'
  ];

  $convert = json_encode($indexPrincipal);    
  $principalIndex  = (object)json_decode($convert); 


/************************************************
 ------------------CUSTOMER----------------------
************************************************/
  $userSection = [
    'account_info_title' => 'Personal Information',
    'account' => 'Account',
    'account_name' => 'Name',
    'account_lastname' => 'Last Name',
    'account_mail' => 'Mail',
    'account_birthday' => 'Birthday',
    'account_info_btn' => 'Save Changes',
    'account_psw_title' => 'Change Password',
    'account_psw_last' => 'Current password',
    'account_psw_new' => 'New Password',
    'account_psw_new2' => 'New password again',
    'account_psw_btn' => 'Change Password',
    'order_title' => 'My Orders',
    'order_empty' => 'You have not placed any orders yet',
    'order_prf1' => 'Below you will find detailed information about your order. If you have any questions, please <a href="'.URL_BASE.$lang.'/pages/contact">contact us</a> ',
    'order_tb_product' => 'Product',
    'order_tb_quanity' => 'Quantity',
    'order_tb_price' => 'Price',
    'order_tb_address' => 'Shipping Address',
    'address_title' => 'My Addresses',
    'address_phone' => 'Phone',
  ];

  $convert = json_encode($userSection);    
  $secUser  = (object)json_decode($convert); 


/************************************************
 ------------------BANNERS----------------------
************************************************/
  $secBanners = [
    'shipping' => 'FREE SHIPPING',
    'shipping_content' => 'All orders with free shipping. Check coverage cities.',
    'shipping_modal' => '',
    'payment' => 'SECURE PAYMENT',
    'payment_content' => 'Your money and data will be secure thanks to PayPal secure payment.',
    'payment_modal' => '',
    'guaranty' => 'SATISFACTION GUARANTEED',
    'guaranty_content' => '100% refund if the product does not satisfy your expectations',
    'guaranty_modal' => '',
  ];

  $convert = json_encode($secBanners);    
  $bannerSec  = (object)json_decode($convert); 


/************************************************
 -------------------CONTACT US----------------------
************************************************/

  $map = [
    'title' => 'FREE SHIPPING',
    'subTitle' => 'Coverage in Wellington, West Palm Beach, and Royal Palm Beach. FL.',
    'delivery' => 'Shipping schedules <br> Monday to Sunday </br> 6:30 am to 11:00 am',
    'btn' => 'ORDER NOW',
  ];


  $convert = json_encode($map);    
  $textMap  = (object)json_decode($convert); 

/************************************************
 -------------------CONTACT US----------------------
************************************************/
  $contact = [
    'title' => 'Contact Us',
    'titlePage' => 'Contact Us',
    'subTitle' => '',
    'name' => 'Your Name',
    'email' => 'Your Email',
    'phone' => 'Your Phone',
    'subject' => 'Subject',
    'message' => 'Mensaje',
    'btn' => 'Send',
    'alternative' => 'You can also write us to <a href="mailto:gifts@madeitforu.com">gifts@madeitforu.com</a>.',
    'confirm' => 'Your message has been recieved. We will contact you soon. Thanks!'
  ];

  $convert = json_encode($contact);    
  $textContact  = (object)json_decode($convert); 

/************************************************
 -------------------CART----------------------
************************************************/
  $popoverCart = [
    'header' => 'Basket',
    'address' => 'Shipping Address',
    'resume' => 'Subtotal',
    'empty' => 'No product has been added',
    'btn' => 'Continue to pay',
    'btnEmpty' => 'Go shopping',
    'resume_coupon' => 'Coupon',
    'resume_valid' => 'Aplied',
    'resume_invalid' => 'Invalid',
  ];
  
  $convert = json_encode($popoverCart);    
  $cartPopover  = (object)json_decode($convert); 

/************************************************
 ----------------- CHECKOUT --------------------
************************************************/
  $checkOutTable = [
    'product' => 'product',
    'price' => 'price',
    'quantity' => 'quantity',
    'total' => 'total',
    'delete' => 'delete',
    'subtotal' => 'subtotal',
    'delBtn' => 'Delete from cart',
    'alert_msn_empty' => 'Customize the message for the basket and the gift card',
    'btn_alert_empty' => 'PERSONALIZE',
    'alert_msn_ok' => 'You have already customized the messages of your order',
    'btn_alert_ok' => ' VIEW / EDIT ',
    'form_who' => 'Who are you going to give it to?',
    'form_why' => 'Reason for gift',
    'form_basket' => 'Phrase of the basket',
    'form_basket_lenght' => 'Available Characters',
    'form_basket_lenght_error' => 'Too long',
    'form_target' => 'Message from the card',
    'form_btn_save' => 'Save Data'
  ];
  
  $convert = json_encode($checkOutTable);    
  $tableCheck  = (object)json_decode($convert); 

  $checkOutAddress = [
    'titleAddress' => 'Shipping Address',
    'subTitleAddress' => 'Select the address where you want to receive the shipment',
    'btn_add_address' => 'Add New Address',
    'empty' => 'You have not added any addresses yet',
    'btn_edit' => 'Edit',
    'btn_delete' => 'Delete',
    'form_name' => 'Name',
    'form_last_name' => 'Last Name',
    'form_state' => 'State',
    'form_city' => 'City',
    'form_address' => 'Address',
    'form_zip_code' => 'Zip Code',
    'form_phone' => 'Phone',
    'form_submit' => 'Add Address',  
  ];
  
  $convert = json_encode($checkOutAddress);    
  $addressCheck  = (object)json_decode($convert); 

  $checkOutResume = [
    'title' => 'resume',
    'subtotal' => 'subtotal',
    'coupon' => 'coupon',
    'shipping' => 'shipping',
    'total' => 'total',
    'paypal' => 'Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.',
    'btn' => 'continue',
    'alert_personal_order' => 'CUSTOMIZE YOUR ORDER TO CONTINUE',
    'alert_address_order' => 'You must enter an address to continue',
  ];
  
  $convert = json_encode($checkOutResume);    
  $resumeCheck  = (object)json_decode($convert);

/************************************************
 -------------------Cookies----------------------
************************************************/
  $alertCookies = [
    'title' => 'Cookies', 
    'content' => 'This site use cookies in order to give you a better experience. By browsing our site you accept its use. <a href="'.URL_BASE.$lang.'/bussiness/terms/#cookies'.'" style="color: white; text-decoration: underline;"> More information.</a>',
    'btn' => 'Got it'
  ];

  $convert = json_encode($alertCookies);    
  $cookieAlert  = (object)json_decode($convert); 
  
/************************************************
 ------------------ABOUT US---------------------
************************************************/
  $aboutUsSection = [
      'title' => 'About us',
      'extract' => 'In a special date for someone who you care, have you ever ask you What can I do? What will be my present? What does he/she like? If you want something different <b>Made It For U</b> will help you on that date giving a breakfast with love.',
      'btn' => 'Read More'
  ];

  $convert = json_encode($aboutUsSection);    
  $aboutUs  = (object)json_decode($convert); 
  
/************************************************
 ------------------SPECIAL---------------------
************************************************/
  $specialSection = [
      'title' => 'Productos',
      'footTitle' => 'some text',
      'subTitle' => 'title',
      'extract' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore eos suscipit earum voluptas aliquam recusandae, quae iure adipisci, inventore quia, quos delectus quaerat praesentium id expedita nihil illo accusantium, tempora.',
      'btn' => 'Read More'
  ];

  $convert = json_encode($specialSection);    
  $special  = (object)json_decode($convert); 

/************************************************
 -------------------MAIL-----------------------
************************************************/

  $dataMail = [
    'subjet' => 'Account activation',
    'title' => 'Welcome to ',
    'paragraf_1_1' => 'Thanks for registering. <br> We almost have your registration, you just have to click ',
    'btnHere' => 'here',
    'paragraf_1_2' => 'and we well will verify your account.',
    'paragraf_2' => 'If you can`t open the link, please copy and paste in your browser: ',
    'paragraf_3' => 'If you have any questions you can contact us at',
    'btnNewsletter' => 'unsubscribe</font></a> me from newsletter.</a>',
  ];
    
    $convert = json_encode($dataMail);    
    $mailTXT  = (object)json_decode($convert); 
  

  $mailRestorePassword = [
    'subjet' => 'Reset Account',
    'title' => 'Reset Account ',
    'paragraf_1_1' => 'You have ask to restore your account. Just click',
    'btnHere' => 'Here',
    'paragraf_1_2' => 'and you will be able to restore your account. Link only will be available by 24 hours, after you have to make the restore request again.',
    'paragraf_2' => 'If you can`t open the link, please copy and paste in your browser: ',
    'paragraf_3' => 'If you have any questions you can contact us at',
    'btnNewsletter' => 'unsubscribe</font></a> me from newsletter.</a>',
  ];
  
  $convert = json_encode($mailRestorePassword);    
  $mailResPass  = (object)json_decode($convert); 

/************************************************
 -------------------FOOTER-----------------------
************************************************/

/************************************************
 -------------------FORMS-----------------------
************************************************/

  $validateForm = [
    'required' => 'Required field',
    'invalid_email' => 'Invalid email address.',
    'invalid_psw_lenght' => 'The password must be at least 8 characters long.',    
    'invalid_psw_number' => 'The password must be at least 1 number long.',    
    'invalid_psw_letter' => 'The password must be at least 1 letter long.',    
    'invalid_phone' => 'Invalid phone number.',       
  ];

  $convert = json_encode($validateForm);    
  $formTXT  = (object)json_decode($convert); 


  $contactForm = [
    'name' => 'Name',
    'email' => 'Email',
    'phone' => 'Phone',    
    'subject' => 'Subject',    
    'message' => 'Message',    
  ];

  $convert = json_encode($contactForm);    
  $contactTXT  = (object)json_decode($convert); 

  $forgotpasswordForm = [
    'title' => 'Restore Account',
    'subtitle' => 'Enter the registered email address with us',
    'email' => 'Email',    
    'btn_restore' => 'Restore' 
  ];

  $convert = json_encode($forgotpasswordForm);    
  $forgotForm  = (object)json_decode($convert); 

  $restartpasswordForm = [
    'subtitle' => 'Enter the new password',
    'psw1' => 'Password',    
    'psw2' => 'Repeat Password',
    'btn_restore' => 'Restore',
    'error' => "We were unable to establish the integrity of your data. Remember that the validation link sent to your email is only enabled 24 hours since moment you requested to restore your account. If you wish you can request a new password again",
    'btn_error' => 'Request to restore account', 
  ];

  $convert = json_encode($restartpasswordForm);    
  $restartForm  = (object)json_decode($convert); 


/************************************************
 -------------------ERRORS-----------------------
************************************************/

  
  
  $errors = [
    'ERROR_DATA_REQUEST' => 'An error occurred while receiving the data, please try again.',
    'PAGE_NOT_FOUND' => 'It looks like the page you tried to enter has moved or no longer exists. Please verify the url address entered.',
    'INCONMPLETE_FORM' => 'You must complete all the fields.',
    'ERR_LOG_CUENTA_BLOQUEADA' => 'The account is locked because of several failed login attempts. You can easily restore it <a href="'.URL_BASE.$lang.'/pages/forgotpassword/"><b class="text-danger">HERE</b></a>.',
    'ERROR_VAL_LOG_MAIL_PSW' => 'The username and password entered do not match.',
    'LENGHT_PASSWORD' => 'Password must be at least 8 characters.',
    'INVALID_MAIL' => 'You must enter a valid email.',
    'MAIL_PREV_REG' => 'The email entered is already registered if you do not remember your password, you can reset it <a href="'.URL_BASE.$lang.'/pages/forgotpassword/">here</a>.',
    'ERROR_GLB_SIGNUP' => 'There was a problem with your account creation, please try again.',
    'COUNT_LOST' => 'We could not find your account. You must register.',
    'COUNT_ALREADY_VALIDATED' => 'This account has already been validated. Does not require any additional action.',
    'COUNT_ERROR_VALIDATE' => 'There was an error activating your account. Please try again or contact us.',
    'ERROR_VALIDACION_USUARIOS_P_V' => 'Your account has not yet been validated at the time of registration. You must restore it <a href="'.URL_BASE.$lang.'/pages/forgotpassword/">here</a>',
    'ERROR_DATA_RESTORE' => 'We were unable to establish the integrity of your data. Remember that the validation link sent to your email is only enabled for 24 hours from the moment you requested to restore your account. If you wish you can request a new password again.',
    'ERROR_DIFERENT_PASSWORD' => 'Passwords do not match.',
    'ERROR_NEWSLETTER_UNSUBSCRIBE' => 'The authenticity of your subscription could not be established. Please try again.',
    'ERROR_NEWSLETTER_COUNT_LOST' => 'Your email is not registered to the newsletter.',
    'ERROR_PRODUCT_ADD' => 'We were unable to add product, please try again.',
    'ERROR_PRODUCT_DELETE' => 'We were unable to delete the product, please try again.',
    'BAG_ERROR_EXIST' => 'This product already exists in your bag.',
    'ERROR_DATE_EXIST' => 'You must enter a correct date.',
    'ERROR_ACCEPT_TERMS' => 'You must accept the terms to continue',
    'ERROR_MAIL_USED' => 'The email entered is associated with another account. Try a different email',
    'ERROR_UPDATE_DATA' => 'An error has occurred. Please try again.',
    'ERROR_UPDATE_PSW' => 'There was an error updating your password. Please try again.',
    'ERROR_VALIDATE_PSW' => 'The password is incorrect',
    'BAD_FORMAT_ZIP_CODE' => 'You must enter a valid Zip code',
    'BAD_FORMAT_PHONE' => 'You must enter a valid phone number',
  ];

  $convert = json_encode($errors);    
  $error  = (object)json_decode($convert); 

  if ( isset($_GET['mail']) ){
    $mailS = $_GET['mail'];
  }else{
    $mailS = '';
  }

  $successMsn = [
    'success_signup_title' => 'You have registered successfully.',
    'success_signup_p1' => 'We have sent an email to '.$mailS.', In order to validate your account and in this way to get in touch with you easily in case it is required in your purchases. Do not forget to check your spam tray.',
    'success_signup_p2' => 'If you have not received the email please <a href="'.URL_BASE.$lang.'/pages/contact/">contact</a> with us.',
    'activate_title' => 'Account Activation',
    'btn_contact_us' => 'If you have problems with your account please <a href="'.URL_BASE.$lang.'/pages/contact/">contact us</a>. We will help you solve it.',
    'success_validate_account' => 'Your account has been activated and you can login.',
      'success_contact' => 'We have received your message, we will get back to you as soon as possible.',
    'success_form_forgotpassword' => 'We have sent a message with instructions to '.$mailS.' To reset your account',
    'success_restore_password' => 'You have successfully updated your account. Now you can login to your account with your new password.',
    'success_newsletter_unsubscribe' => 'We have canceled the subscription to your newsletter. Do not receive more informative emails.',
    'success_product_add' => 'Product added to your basket',
    'success_product_delete' => 'Product removed from your basket',
    'success_info_updated' => 'Personal information updated successfully',
    'success_psw_update' => 'Password updated successfully',
    'success_address_added' => 'You added a new address',
    'success_continue_basket' => 'LOG IN AND </br> CONTINUE WITH MY PAYMENT',
  ];

  $convert = json_encode($successMsn);    
  $success = (object)json_decode($convert); 
