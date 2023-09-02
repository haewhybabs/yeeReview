<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{URL::TO('assets/images/icon/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slicknav.min.css')}}">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('assets/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}">
    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action={{ URL::TO("organisation-signup-step2") }}>
                    @csrf
                    <div class="login-form-head">
                        <h4>Sign up Step 2</h4>
                        <p>Hello there, Organisation sign up to the unified employee system </p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputName1">Company Name</label>
                            <input type="text" id="first_name" name="name" required>
                            {{-- <i class="ti-user"></i> --}}
                            <div class="text-danger"></div>
                        </div>

                        <div class="form-gp">
                            <label for="exampleInputName1">Company Description</label>
                            <textarea name="description" rows="4" class="form-control"></textarea>
                            
                            <div class="text-danger"></div>
                        </div>
                        
                
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Company email address</label>
                            <input type="email" id="email" name="email">
                            {{-- <i class="ti-email"></i> --}}
                            <div class="text-danger"></div>
                        </div>
                        
                        <div class="form-gp">
                            <label for="exampleInputName1">Company Address</label>
                            <input type="text" id="address" name="address" required>
                            {{-- <i class="ti-address"></i> --}}
                            <div class="text-danger"></div>
                        </div>

                        <div class="form-gp">
                            <label for="exampleInputName1">Company Phone Number</label>
                            <input type="text" id="phone_number" name="phone_number" required>
                            {{-- <i class="ti-address"></i> --}}
                            <div class="text-danger"></div>
                        </div>

                        <div class="form-gp">
                            <label for="exampleInputName1">Industry</label>
                            <input type="text" id="industry" name="industry" required>
                            {{-- <i class="ti-industry"></i> --}}
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputName1">Website</label>
                            <input type="text" id="website" name="website" required>
                            {{-- <i class="ti-website"></i> --}}
                            <div class="text-danger"></div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>    
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/js/toastr.min.js') }}"></script>

    <script>
        @if(Session::has('message'))
          var type = "{{ Session::get('alert-type', 'info') }}";
          switch(type){
              case 'info':
                  toastr.info("{{ Session::get('message') }}");
                  break;
              
              case 'warning':
                  toastr.warning("{{ Session::get('message') }}");
                  break;
      
              case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
      
              case 'error':
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
        @endif
        @if($errors->any())
            @foreach ($errors->all() as $error)
                toastr.warning("{{ $error }}");
            @endforeach
        @endif
    </script>
</body>

</html>