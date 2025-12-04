<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <title>Reset Password | NGO Admin</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="NGO Admin Reset Password" />
     <meta name="author" content="Techzaa" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />

     <!-- App favicon -->
     <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }}">

     <!-- Vendor css (Require in all Page) -->
     <link href="{{ asset('assets/admin/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- Icons css (Require in all Page) -->
     <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- App css (Require in all Page) -->
     <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- Theme Config js (Require in all Page) -->
     <script src="{{ asset('assets/admin/js/config.js') }}"></script>
</head>

<body class="h-100">
     <div class="d-flex flex-column h-100 p-3">
          <div class="d-flex flex-column flex-grow-1">
               <div class="row h-100">
                    <div class="col-xxl-7">
                         <div class="row justify-content-center h-100">
                              <div class="col-lg-6 py-lg-5">
                                   <div class="d-flex flex-column h-100 justify-content-center">
                                        <div class="auth-logo mb-4">
                                             <a href="#" class="logo-dark">
                                                  <img src="{{ asset('assets/admin/images/logo-dark.png') }}" height="24" alt="logo dark">
                                             </a>

                                             <a href="#" class="logo-light">
                                                  <img src="{{ asset('assets/admin/images/logo-light.png') }}" height="24" alt="logo light">
                                             </a>
                                        </div>

                                        <h2 class="fw-bold fs-24">Reset Password</h2>

                                        <p class="text-muted mt-1 mb-4">Enter your email address and we'll send you an email with instructions to reset your password.</p>

                                        <div class="mb-5">
                                             @if (session('status'))
                                                  <div class="alert alert-success" role="alert">
                                                       {{ session('status') }}
                                                  </div>
                                             @endif

                                             <form action="{{ route('admin.password.email') }}" method="POST" class="authentication-form">
                                                  @csrf
                                                  <div class="mb-3">
                                                       <label class="form-label" for="email">Email</label>
                                                       <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                                                       @error('email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                       @enderror
                                                  </div>

                                                  <div class="mb-1 text-center d-grid">
                                                       <button class="btn btn-soft-primary" type="submit">Send Reset Link</button>
                                                  </div>
                                             </form>
                                             
                                             <div class="mt-3 text-center">
                                                 <p class="mb-0">Back to <a href="{{ route('admin.login') }}" class="text-primary fw-bold ms-1">Sign In</a></p>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-xxl-5 d-none d-xxl-flex">
                         <div class="card h-100 mb-0 overflow-hidden">
                              <div class="d-flex flex-column h-100">
                                   <img src="{{ asset('assets/admin/images/small/img-10.jpg') }}" alt="" class="w-100 h-100">
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <!-- Vendor Javascript (Require in all Page) -->
     <script src="{{ asset('assets/admin/js/vendor.js') }}"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="{{ asset('assets/admin/js/app.js') }}"></script>

</body>
</html>
