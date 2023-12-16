<!DOCTYPE html>
<html lang="en">
   <head>
     <meta name="description" content="VIDY - Most advanced customer engagement platform to revolutionize the way you interact with your customers.">
<meta name="keywords" content="vidy, fsi, flying stars, customer engagement, crm, customers, vidy crm">
<meta name="author" content="VIDY - Customer Engagement Platform">
<meta name="robots" content="index, follow">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <title>@yield('title')</title>
      <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/font-awesome.min.css')}}">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/feather.css')}}">
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/line-awesome.min.css')}}">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/morris.css')}}">
      @yield('additional_links')
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/toatr.css')}}">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/theme-settings.css')}}">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/style.css?ver=001')}}">
      <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.min.js"></script>
      <script src="assets/js/respond.min.js"></script>
      <![endif]-->
   </head>
   <body id="skin-color" class="inter">

      <div class="main-wrapper">

         <div class="header" id="heading">
            <div class="header-left">
               <a href="#" class="logo">
               <img src="{{client_asset('jnafau','project','logo.png')}}" alt="Logo" class="sidebar-logo">
               <img src="{{client_asset('jnafau','project','logo.png')}}" alt="Logo" class="mini-sidebar-logo">
               </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);">
            <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
            </span>
            </a>
            <div class="page-title-box">
             <!--   <div class="top-nav-search">
                  <a href="javascript:void(0);" class="responsive-search">
                  <i class="fa fa-search"></i>
                  </a>
                  <form action="#">
                     <input class="form-control" type="text" placeholder="Search here">
                     <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                  </form>
               </div> -->
            </div>
            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu">
               <li class="nav-item"></li>
              
               <!-- <li class="nav-item dropdown">
                  <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                  <i class="fa fa-bell-o"></i> <span class="badge rounded-pill">3</span>
                  </a>
                  <div class="dropdown-menu notifications">
                     <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                     </div>
                     <div class="noti-content">
                        <ul class="notification-list">
                           <li class="notification-message">
                              <a href="#">
                                 <div class="media d-flex">
                                    <span class="avatar flex-shrink-0">
                                    <img alt="" src="">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                       <p class="noti-details"><span class="noti-title">NAME</span> added new task <span class="noti-title">Patient appointment booking</span></p>
                                       <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                    </div>
                                 </div>
                              </a>
                           </li>
                         
                           
                        </ul>
                     </div>
                     <div class="topnav-dropdown-footer">
                        <a href="activities.html">View all Notifications</a>
                     </div>
                  </div>
               </li> -->
               
               <li class="nav-item dropdown has-arrow main-drop">
                  <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                  <span class="user-img"><img src="{{client_asset('jnafau','project','logo.png')}}" alt="">
                  <span class="status online"></span></span>
                  <span></span>
                  </a>
                  <div class="dropdown-menu">
                     <a class="dropdown-item" href="">My Profile</a>
                     <a class="dropdown-item" target="__blank" href="">Share Refer Link</a>
                     <a class="dropdown-item" href="">Logout</a>
                  </div>
               </li>
            </ul>
            <div class="dropdown mobile-user-menu">
               <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
               <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="">My Profile</a>
                  
                  <a class="dropdown-item" href="">Logout</a>
               </div>
            </div>
         </div>

         <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
               <form action="search.html" class="mobile-view">
                  <input class="form-control" type="text" placeholder="Search here">
                  <button class="btn" type="button"><i class="fa fa-search"></i></button>
               </form>
               <div id="sidebar-menu" class="sidebar-menu">
                  <ul>
                     <li class="nav-item nav-profile">
                        <!-- <a href="#" class="nav-link"> -->
                           <!-- <div class="nav-profile-image">
                              <img src="{{client_asset('jnafau','project','logo.png')}}" alt="profile">
                           </div> -->
                           <!-- <div class="nav-profile-text d-flex flex-column">
                              <span class="font-weight-bold mb-2"></span>
                              <span class="text-white text-small">Customer</span>
                           </div> -->
                           <!-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a> -->
                     </li>
                     <li class="menu-title">
                        <span>Main</span>
                     </li>
                     
                     <li class="">
                        <a href=""><i class="feather-home"></i> <span>Dashboard</span></a>
                     </li>

                     
                     <li class="">
                        <a href=""><i class="feather-user"></i> <span>Leads</span></a>
                     </li>

                     <li>
                        <a href="javascript:void(0)" class=""><i class="feather-user"></i> <span>Sites</span>&nbsp;({{count([])}})</a>
                        <ul class="sub-menus">
                          
                        </ul>
                     </li>
                       
                        <li class="">
                        <a href=""><i class="fa fa-bar-chart"></i> <span>Reports</span></a>
                     </li>
                       <li class="">
                        <a href=""><i class="feather-grid"></i> <span>Referred by</span></a>
                     </li>
                     
                     <li class="">
                        <a href=""><i class="feather-calendar"></i> <span>Lead Agent</span></a>
                     </li>
                       <li class="">
                        <a href=""><i class="fa fa-heart"></i> <span>Favourite Leads</span></a>
                     </li> 
                       <li class="">
                        <a href=""><i class="fa fa-bell-o"></i> <span>Reminders</span></a>
                     </li> 
                     <li class="">
                        <a href=""><i class="fa fa-bell-o"></i> <span>Calender</span></a>
                     </li> 
                   
                    
                  </ul>
               </div>
            </div>
         </div>

         <div class="page-wrapper">
         	 @yield('content')
            
         </div>
      </div>
      
      <script src="{{client_asset('jnafau','project','assets/js/jquery-3.6.0.min.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/jquery.slimscroll.min.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/morris.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/raphael.min.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/chart.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/linebar.min.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/piechart.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/apex.min.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/theme-settings.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/toastr.min.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/toastr.js')}}"></script>
      <!-- <script src="{{client_asset('jnafau','project','assets/sementic/calendar.css')}}"></script> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.1/components/calendar.min.css" integrity="sha512-Nce5qJ0Fh2d/z21cBqocICF2mNgmLxk8yBjM6LZJ5r3LCVvozNI4wdyE+uNjQ2MMnnfrrDy2RtgLcqMaQscuaA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.1/components/calendar.min.js" integrity="sha512-KK0Ch7hfHnrbGVu0MU7xcrABHkT/KWmTtWvhqCQolkKcTbzCIw/mVJ5JWEd9CMtR0QtXsPoEhJOoivrcDh7roA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.1/semantic.min.js" integrity="sha512-9uCjPZs30uENi8K34nm/jrFW9aw7Euk3SCdJYugmjNEgJQuzBhE0WDO9xVxbNdWQC5lWG4M/nFxOTkgTqEKdlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.1/semantic.min.css" integrity="sha512-MCgTNsKwC2c/PSk77N5kuTXtsyD8tkpYMh7GnFfzTpOeNAKxuri9YuYswSiAkwPC3fBpIIMs9udL/hJIIapVHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      @yield('additional_script')

      <script src="{{client_asset('jnafau','project','assets/js/app.js')}}"></script>
      @yield('inline_script')
     
   <div class="modal-dialog" role="document" id="leads-details-html">
   </div>
</div>
<script>
   
    $('.c_l_start_date').calendar({
        type: 'date',
          formatter: {
            date: function (date, settings) {
                console.log(settings);
              if (!date) return '';
              console.log('hi');
              var day = date.getDate();
              var month = date.getMonth() + 1;
              var year = date.getFullYear();
              if(month<10){
               month = "0"+month;
              }
              var dd = day + '-' + month + '-' + year;
             
              return dd;
            }
          }
     });

     $('.c_l_end_date').calendar({
        type: 'date',
          formatter: {
            date: function (date, settings) {
                console.log(settings);
              if (!date) return '';
              var day = date.getDate();
              var month = date.getMonth() + 1;
              var year = date.getFullYear();
              if(month<10){
               month = "0"+month;
              }
              var dd = day + '-' + month + '-' + year;
               
              return dd;
            }
          }
     });


     $('.normal_datepicker').calendar({
        type: 'date',
          formatter: {
            date: function (date, settings) {
                console.log(settings);
              if (!date) return '';
              var day = date.getDate();
              var month = date.getMonth() + 1;
              var year = date.getFullYear();
              if(month<10){
               month = "0"+month;
              }
              var dd = day + '-' + month + '-' + year;
              return dd;
            }
          }
     });

      $('.normal_datepicker1').calendar({
        type: 'date',
          formatter: {
            date: function (date, settings) {
                console.log(settings);
              if (!date) return '';
              var day = date.getDate();
              var month = date.getMonth() + 1;
              if(month<10){
               month = "0"+month;
              }
              var year = date.getFullYear();
              var dd = day + '-' + month + '-' + year;
              return dd;
            }
          }
     });



</script>
   </body>
</html>