<?= helper('html') ?>
<?php
/***
 * Vista para registarse 
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
 <title>SignUp Cover | CORK - Multipurpose Bootstrap Dashboard Template </title>
 <link rel="icon" type="image/x-icon" href="<?= base_url() ?>/cork/src/assets/img/favicon.ico" />
 <link href="<?= base_url() ?>/cork/layouts/vertical-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
 <link href="<?= base_url() ?>/cork/layouts/vertical-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
 <script src="../layouts/vertical-light-menu/loader.js"></script>
 <?= script_tag('cork/layouts/vertical-light-menu/loader.js') ?>
 <!-- BEGIN GLOBAL MANDATORY STYLES -->
 <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
 <link href="<?= base_url() ?>/cork/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

 <link href="<?= base_url() ?>/cork/layouts/vertical-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
 <link href="<?= base_url() ?>/cork/src/assets/css/light/authentication/auth-cover.css" rel="stylesheet" type="text/css" />

 <link href="<?= base_url() ?>/cork/layouts/vertical-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
 <link href="<?= base_url() ?>/cork/src/assets/css/dark/authentication/auth-cover.css" rel="stylesheet" type="text/css" />
 <!-- END GLOBAL MANDATORY STYLES -->

</head>

<body class="form">

 <!-- BEGIN LOADER -->
 <div id="load_screen">
  <div class="loader">
   <div class="loader-content">
    <div class="spinner-grow align-self-center"></div>
   </div>
  </div>
 </div>
 <!--  END LOADER -->

 <div class="auth-container d-flex">

  <div class="container mx-auto align-self-center">

   <div class="row">

    <div class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
     <div class="auth-cover-bg-image"></div>
     <div class="auth-overlay"></div>

     <div class="auth-cover">

      <div class="position-relative">
       <?= img('cork/src/assets/img/auth-cover.svg', false, ['class' => 'auth-img']) ?>

       <h2 class="mt-5 text-white font-weight-bolder px-2">Join the community of expert developers</h2>
       <p class="text-white px-2">It is easy to setup with great customer experience. Start your 7-day free trial</p>
      </div>

     </div>

    </div>

    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
     <div class="card">
      <div class="card-body">
       <form action="<?= url_to('Register::registerAction') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="row">
         <div class="col-md-12 mb-3">

          <h2>Sign Up</h2>
          <p>Enter your email and password to register</p>
          <?php if (session('error') !== null) : ?>
           <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
          <?php elseif (session('errors') !== null) : ?>
           <div class="alert alert-danger" role="alert">
            <?php if (is_array(session('errors'))) : ?>
             <?php foreach (session('errors') as $error) : ?>
              <?= $error ?>
              <br>
             <?php endforeach ?>
            <?php else : ?>
             <?= session('errors') ?>
            <?php endif ?>
           </div>
          <?php endif ?>

         </div>
         <div class="col-md-12">
          <div class="mb-3">
           <label class="form-label">User Name</label>
           <input type="text" class="form-control add-billing-address-input" name="username" required>
          </div>
         </div>
         <div class="col-md-12">
          <div class="mb-3">
           <label class="form-label">Email</label>
           <input type="email" class="form-control" name="email" required>
          </div>
         </div>
         <div class="col-12">
          <div class="mb-3">
           <label class="form-label">Password</label>
           <input type="password" class="form-control" name="password" required>
          </div>
         </div>
         <div class="col-12">
          <div class="mb-3">
           <label class="form-label">Password Confirm</label>
           <input type="password" class="form-control" name="password_confirm" required>
          </div>
         </div>


         <!--
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="form-check form-check-primary form-check-inline">
                                            <input class="form-check-input me-3" type="checkbox" id="form-check-default">
                                            <label class="form-check-label" for="form-check-default">
                                                I agree the <a href="javascript:void(0);" class="text-primary">Terms and Conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
-->
         <div class="col-12">
          <div class="mb-4">
           <button class="btn btn-secondary w-100">SIGN UP</button>
          </div>
         </div>

         <div class="col-12 mb-4">
          <div class="">
           <div class="seperator">
            <hr>
            <div class="seperator-text"> <span>Or continue with</span></div>
           </div>
          </div>
         </div>

         <div class="col-sm-4 col-12">
          <div class="mb-4">
           <button class="btn  btn-social-login w-100 ">
            <?= img('cork/src/assets/img/google-gmail.svg', false, ['class' => 'img-fluid']) ?>
            <span class="btn-text-inner">Google</span>
           </button>
          </div>
         </div>

         <div class="col-sm-4 col-12">
          <div class="mb-4">
           <button class="btn  btn-social-login w-100">
            <?= img('cork/src/assets/img/github-icon.svg', false, ['class' => 'img-fluid']) ?>
            <span class="btn-text-inner">Github</span>
           </button>
          </div>
         </div>

         <div class="col-sm-4 col-12">
          <div class="mb-4">
           <button class="btn  btn-social-login w-100">
            <?= img('cork/src/assets/img/twitter.svg', false, ['class' => 'img-fluid']) ?>
            <span class="btn-text-inner">Twitter</span>
           </button>
          </div>
         </div>

         <div class="col-12">
          <div class="text-center">
           <p class="mb-0">Already have an account ? <a href="javascript:void(0);" class="text-warning">Sign in</a></p>
          </div>
         </div>

        </div>
       </form>

      </div>
     </div>
    </div>

   </div>

  </div>

 </div>

 <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
 <?= script_tag('/cork/src/bootstrap/js/bootstrap.bundle.min.js') ?>
 <!-- END GLOBAL MANDATORY SCRIPTS -->


</body>

</html>
