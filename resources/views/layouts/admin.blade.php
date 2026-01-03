<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <title>@yield('title', 'Dashboard') | NGO Admin</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="NGO Admin Dashboard" />
     <meta name="author" content="Techzaa" />
     <meta name="author" content="Techzaa" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <!-- App favicon -->
     <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }}">

     <!-- Vendor css (Require in all Page) -->
     <link href="{{ asset('assets/admin/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- Icons css (Require in all Page) -->
     <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

     <!-- App css (Require in all Page) -->
     <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/admin/css/ckeditor-dark.css') }}" rel="stylesheet" type="text/css" />

     <!-- Theme Config js (Require in all Page) -->
     <script src="{{ asset('assets/admin/js/config.js') }}"></script>
     @stack('styles')
</head>

<body>

     <!-- START Wrapper -->
     <div class="wrapper">

          <!-- ========== Topbar Start ========== -->
          <header class="topbar">
               <div class="container-fluid">
                    <div class="navbar-header">
                         <div class="d-flex align-items-center">
                              <!-- Menu Toggle Button -->
                              <div class="topbar-item">
                                   <button type="button" class="button-toggle-menu me-2">
                                        <iconify-icon icon="solar:hamburger-menu-broken" class="fs-24 align-middle"></iconify-icon>
                                   </button>
                              </div>

                              <!-- Menu Toggle Button -->
                              <div class="topbar-item">
                                   <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">NGO Admin</h4>
                              </div>
                         </div>

                         <div class="d-flex align-items-center gap-1">

                              <!-- Theme Color (Light/Dark) -->
                              <div class="topbar-item">
                                   <button type="button" class="topbar-button" id="light-dark-mode">
                                        <iconify-icon icon="solar:moon-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                                   </button>
                              </div>

                              <!-- User -->
                              <div class="dropdown topbar-item">
                                   <a type="button" class="topbar-button" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="d-flex align-items-center">
                                             <img class="rounded-circle" width="32" src="{{ Auth::user()->avatar ? asset('uploads/' . Auth::user()->avatar) : asset('assets/admin/images/users/avatar-1.jpg') }}" alt="{{ Auth::user()->name }}">
                                             <span class="ms-2 d-none d-xl-block fw-medium user-name-text">{{ Auth::user()->name }}</span>
                                        </span>
                                   </a>
                                   <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <h6 class="dropdown-header">Welcome!</h6>
                                        <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                             <i class="bx bx-user-circle text-muted fs-18 align-middle me-1"></i><span class="align-middle">Profile</span>
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.password.edit') }}">
                                             <i class="bx bx-lock text-muted fs-18 align-middle me-1"></i><span class="align-middle">Change Password</span>
                                        </a>
                                        
                                        <div class="dropdown-divider my-1"></div>

                                        <form method="POST" action="{{ route('admin.logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bx bx-log-out fs-18 align-middle me-1"></i><span class="align-middle">Logout</span>
                                            </button>
                                        </form>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </header>
          <!-- ========== Topbar End ========== -->

          <!-- ========== App Menu Start ========== -->
          <div class="main-nav">
               <!-- Sidebar Logo -->
               <div class="logo-box">
                    <a href="{{ route('admin.dashboard') }}" class="logo-dark">
                         <img src="{{ asset('assets/admin/images/logo-sm.png') }}" class="logo-sm" alt="logo sm">
                         <img src="{{ asset('assets/admin/images/logo-dark.png') }}" class="logo-lg" alt="logo dark">
                    </a>

                    <a href="{{ route('admin.dashboard') }}" class="logo-light">
                         <img src="{{ asset('assets/admin/images/logo-sm.png') }}" class="logo-sm" alt="logo sm">
                         <img src="{{ asset('assets/admin/images/logo-light.png') }}" class="logo-lg" alt="logo light">
                    </a>
               </div>

               <!-- Menu Toggle Button (sm-hover) -->
               <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
                    <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone" class="button-sm-hover-icon"></iconify-icon>
               </button>

               <div class="scrollbar" data-simplebar>
                    <ul class="navbar-nav" id="navbar-nav">

                         <li class="menu-title">General</li>

                         <li class="nav-item">
                              <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Dashboard </span>
                              </a>
                         </li>

                         <li class="menu-title">Content</li>

                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.features.index') }}">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:list-check-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text"> Features </span>
                            </a>
                        </li>
                         <li class="nav-item">
                              <a class="nav-link" href="{{ route('admin.pages.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:document-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Pages </span>
                              </a>
                         </li>

                         <li class="nav-item">
                              <a class="nav-link collapsed" data-bs-target="#blog-nav" data-bs-toggle="collapse" href="#">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:pen-new-square-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Blog </span>
                              </a>
                              <ul id="blog-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                                   <li>
                                        <a href="{{ route('admin.blog.posts.index') }}">
                                             <iconify-icon icon="solar:list-bold-duotone"></iconify-icon>
                                             <span>All Posts</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="{{ route('admin.blog.categories.index') }}">
                                             <iconify-icon icon="solar:tag-bold-duotone"></iconify-icon>
                                             <span>Categories</span>
                                        </a>
                                   </li>
                              </ul>
                         </li>

                         {{-- <li class="nav-item">
                              <a class="nav-link" href="{{ route('admin.menus.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:hamburger-menu-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Menus </span>
                              </a>
                         </li> --}}

                         <li class="nav-item">
                              <a class="nav-link collapsed" data-bs-target="#homepage-nav" data-bs-toggle="collapse" href="#">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:home-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Homepage </span>
                              </a>
                              <ul id="homepage-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                                   <li>
                                        <a href="{{ route('admin.sliders.index') }}">
                                             <iconify-icon icon="solar:slider-minimalistic-horizontal-bold-duotone"></iconify-icon>
                                             <span>Sliders</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="{{ route('admin.team.index') }}">
                                             <iconify-icon icon="solar:users-group-rounded-bold-duotone"></iconify-icon>
                                             <span>Team(Volunteers) Members</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="{{ route('admin.testimonials.index') }}">
                                             <iconify-icon icon="solar:chat-round-like-bold-duotone"></iconify-icon>
                                             <span>Testimonials</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="{{ route('admin.partners.index') }}">
                                             <iconify-icon icon="solar:hand-shake-bold-duotone"></iconify-icon>
                                             <span>Partners</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="{{ route('admin.gallery.index') }}">
                                             <iconify-icon icon="solar:gallery-bold-duotone"></iconify-icon>
                                             <span>Gallery</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="{{ route('admin.faq-categories.index') }}">
                                             <iconify-icon icon="solar:tag-bold-duotone"></iconify-icon>
                                             <span>FAQ Categories</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="{{ route('admin.faqs.index') }}">
                                             <iconify-icon icon="solar:question-circle-bold-duotone"></iconify-icon>
                                             <span>FAQs</span>
                                        </a>
                                   </li>
                                    <li>
                                        <a href="{{ route('admin.volunteer.index') }}">
                                             <iconify-icon icon="solar:users-group-two-rounded-bold-duotone"></iconify-icon>
                                             <span>Volunteer Section</span>
                                        </a>
                                   </li>
                                    <li>
                                        <a href="{{ route('admin.about.section.index') }}">
                                             <iconify-icon icon="solar:document-text-bold-duotone"></iconify-icon>
                                             <span>About Section</span>
                                        </a>
                                   </li>
                                    <li>
                                        <a href="{{ route('admin.about.page.index') }}">
                                             <iconify-icon icon="solar:file-text-bold-duotone"></iconify-icon>
                                             <span>About Us Page</span>
                                        </a>
                                   </li>
                              </ul>
                         </li>

                         <li class="nav-item">
                              <a class="nav-link collapsed" data-bs-target="#campaigns-nav" data-bs-toggle="collapse" href="#">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:heart-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Campaigns/Causes </span>
                              </a>
                              <ul id="campaigns-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                                   <li>
                                        <a href="{{ route('admin.campaigns.index') }}">
                                             <iconify-icon icon="solar:list-bold-duotone"></iconify-icon>
                                             <span>All Campaigns</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="{{ route('admin.events.index') }}">
                                             <iconify-icon icon="solar:calendar-bold-duotone"></iconify-icon>
                                             <span>Events</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="{{ route('admin.donations.index') }}">
                                             <iconify-icon icon="solar:hand-money-bold-duotone"></iconify-icon>
                                             <span>Donations</span>
                                        </a>
                                   </li>
                              </ul>
                         </li>

                         <li class="nav-item">
                              <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Forms </span>
                              </a>
                              <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                                   <li>
                                        <a href="{{ route('admin.volunteers.index') }}">
                                             <iconify-icon icon="solar:users-group-rounded-bold-duotone"></iconify-icon>
                                             <span>Volunteers</span>
                                        </a>
                                   </li>
                                    <li>
                                        <a href="{{ route('admin.contact-submissions.index', ['type' => 'event_reply']) }}">
                                            <iconify-icon icon="solar:chat-round-line-bold-duotone"></iconify-icon>
                                            <span>Event Replies</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="{{ route('admin.contact-submissions.index') }}">
                                             <iconify-icon icon="solar:letter-bold-duotone"></iconify-icon>
                                             <span>Contact Submissions</span>
                                        </a>
                                   </li>
                              </ul>
                         </li>



                         <li class="menu-title">System</li>

                         <li class="nav-item">
                              <a class="nav-link" href="{{ route('admin.countries.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:globus-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Countries </span>
                              </a>
                         </li>

                         <li class="nav-item">
                              <a class="nav-link" href="{{ route('admin.media.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:gallery-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Media Library </span>
                              </a>
                         </li>

                         <li class="nav-item">
                              <a class="nav-link" href="{{ route('admin.languages.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:global-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Languages </span>
                              </a>
                         </li>

                         {{-- <li class="nav-item">
                              <a class="nav-link collapsed" data-bs-target="#roles-nav" data-bs-toggle="collapse" href="#">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:shield-user-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Roles & Permissions </span>
                              </a>
                              <ul id="roles-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                                   <li>
                                        <a href="{{ route('admin.roles.index') }}">
                                             <iconify-icon icon="solar:user-id-bold-duotone"></iconify-icon>
                                             <span>Roles</span>
                                        </a>
                                   </li>
                                   <li>
                                        <a href="{{ route('admin.permissions.index') }}">
                                             <iconify-icon icon="solar:key-bold-duotone"></iconify-icon>
                                             <span>Permissions</span>
                                        </a>
                                   </li>
                              </ul>
                         </li> --}}

                         {{-- <li class="nav-item">
                              <a class="nav-link" href="#">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:palette-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Theme Settings </span>
                              </a>
                         </li> --}}

                         <li class="nav-item">
                              <a class="nav-link" href="{{ route('admin.settings.index') }}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
                                   </span>
                                   <span class="nav-text"> Settings </span>
                              </a>
                         </li>

                    </ul>
               </div>
          </div>
          <!-- ========== App Menu End ========== -->

          <!-- ============================================================== -->
          <!-- Start Page Content here -->
          <!-- ============================================================== -->

          <div class="page-content">

               <div class="container-fluid">

                    @yield('content')

               </div>
               <!-- container-fluid -->

               <!-- Footer Start -->
               <footer class="footer">
                    <div class="container-fluid">
                         <div class="row">
                              <div class="col-12 text-center">
                                   <script>document.write(new Date().getFullYear())</script> &copy; NGO Admin.
                              </div>
                         </div>
                    </div>
               </footer>
               <!-- Footer End -->

          </div>

          <!-- ============================================================== -->
          <!-- End Page Content -->
          <!-- ============================================================== -->

     </div>
     <!-- END Wrapper -->

     <!-- Vendor Javascript (Require in all Page) -->
     <script src="{{ asset('assets/admin/js/jquery.js') }}"></script>
     <script src="{{ asset('assets/admin/js/vendor.js') }}"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="{{ asset('assets/admin/js/app.js') }}"></script>
     @stack('scripts')

</body>
</html>
