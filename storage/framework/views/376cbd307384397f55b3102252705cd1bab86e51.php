<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Font Awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Dropzone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.css" />
    <!-- Custom Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/login/auth.css')); ?>">
    <!-- Responsive Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/responsive.css')); ?>">

  </head>
  <body class="d-flex flex-column min-vh-100">

    <!-- Header -->
      <div class="header-area">
        <div class="container-xxl">
            <div class="row align-items-center">
              <div class="col-6 col-lg-3">
                <a class="logo" href="#"><img src="<?php echo e(asset('img/logo-white.png')); ?>" align="" class="img-fluid" width="200"></a>
              </div> 
              <div class="col-6 col-lg-9 text-end">                
                <a href="<?php echo e(route('register')); ?>" class="ps-2 text-white">Sign up</a>
                <a href="<?php echo e(route('login')); ?>" class="ps-2 text-white">Login</a>         
              </div>
            </div>
          </div>
      </div>
    <!-- end Header -->

    <!-- Auth Content -->
    <div class="main-content wrapper flex-grow-1">
      <div class="my-5 py-5">
        <div class="container-xxl">
          <div class="row justify-content-center">
            <div class="col-lg-4">
              <div class="heading">
                <h3 class="mb-4">Sign in</h3>
              </div>
              <div class="auth-form">
                <form method="POST" action="<?php echo e(route('login')); ?>">
                  <?php echo csrf_field(); ?>
                  <div class="mb-3">
                    <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" autocomplete="email" autofocus placeholder="E-mail" required="">
                     <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="mb-3">
                    <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="current-password" placeholder="Password" required="">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                      </span>
                   <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="d-flex justify-content-between mb-4">
                    <div class="remember-checkbox">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="rememberme">
                        <label class="form-check-label" for="rememberme">
                          Remember Me
                        </label>
                      </div>
                    </div>
                      
                  </div>
                  <div class="submit-btn">
                    <button type="submit" class="btn btn-primary text-uppercase btn-wide">sing in</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end Auth Content -->

    <!-- Footer -->
    <footer class="footer">
      <ul class="footer-menu">
        <li><a href="#">Contact</a></li>
        <li><a href="#">Privacy policy</a></li>
        <li><a href="#">Terms of use</a></li>
      </ul>
      <div class="copyright">Softpyramid © 2021</div>
    </footer>
    <!-- end Footer -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html><?php /**PATH D:\Tariq_Naeem\TNN\Laravel\DMS_S\dms\resources\views/auth/login.blade.php ENDPATH**/ ?>