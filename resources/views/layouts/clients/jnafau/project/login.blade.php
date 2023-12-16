<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <meta name="description" content="CRMS - Bootstrap Admin Template">
      <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
      <meta name="author" content="Dreamguys - Bootstrap Admin Template">
      <meta name="robots" content="noindex, nofollow">
      <title>@yield('title')</title>
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/font-awesome.min.css')}}">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/feather.css')}}">
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/line-awesome.min.css')}}">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/morris.css')}}">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/theme-settings.css')}}">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/toatr.css')}}">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/style.css')}}">
      <link rel="stylesheet" href="{{client_asset('jnafau','project','assets/css/custom.css?ver=001')}}">
      <input type="hidden" id="get_district_by_state_id" url="{{route('get.district.by.state.id')}}">
      @yield('additional_links')
  
   </head>
   <body id="skin-color" class="inter">
      <div class="main-wrapper">


         <div class="page-wrapper authentication">
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
      <script src="{{client_asset('jnafau','project','assets/js/app.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/toastr.min.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/toastr.js')}}"></script>
      <script src="{{client_asset('jnafau','project','assets/js/ajax.js?ver=0002')}}"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.1/components/calendar.min.css" integrity="sha512-Nce5qJ0Fh2d/z21cBqocICF2mNgmLxk8yBjM6LZJ5r3LCVvozNI4wdyE+uNjQ2MMnnfrrDy2RtgLcqMaQscuaA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.1/components/calendar.min.js" integrity="sha512-KK0Ch7hfHnrbGVu0MU7xcrABHkT/KWmTtWvhqCQolkKcTbzCIw/mVJ5JWEd9CMtR0QtXsPoEhJOoivrcDh7roA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.1/semantic.min.js" integrity="sha512-9uCjPZs30uENi8K34nm/jrFW9aw7Euk3SCdJYugmjNEgJQuzBhE0WDO9xVxbNdWQC5lWG4M/nFxOTkgTqEKdlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.1/semantic.min.css" integrity="sha512-MCgTNsKwC2c/PSk77N5kuTXtsyD8tkpYMh7GnFfzTpOeNAKxuri9YuYswSiAkwPC3fBpIIMs9udL/hJIIapVHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      @yield('additional_script')
   </body>
   <script>
   $(document).on('change','#file-input',function(e){
   var file = e.target.files[0];
    if (file !== null) {
      var src = URL.createObjectURL(file);
      var img = "<img src='"+src+"' width='100%' height='auto' />";
      $("#results_mobile").html(img);
      // document.getElementById('results').innerHTML = src;
    }
});
    $('.c_l_start_date').calendar({
        type: 'date',
          formatter: {
            date: function (date, settings) {
                console.log(settings);
              if (!date) return '';
              var day = date.getDate();
              var month = date.getMonth() + 1;
              var year = date.getFullYear();
              var dd = day + '-' + month + '-' + year;
               var url = $("#filter_url").val();
               var key = 'c_l_start_date';
               url += "?key="+key+"&val="+dd;
                $.get(url,function(data){
                 customer_list.ajax.reload();
                  })
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
              var dd = day + '-' + month + '-' + year;
               var url = $("#filter_url").val();
               var key = 'c_l_end_date';
               url += "?key="+key+"&val="+dd;
                $.get(url,function(data){
                 customer_list.ajax.reload();
                  })
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
              var dd = day + '-' + month + '-' + year;
              return dd;
            }
          }
     });

</script>
</html>