<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Login and Signup form</title>
  <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,500,700" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="http://tra.in/todo/assets/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!-- Inspiration
  https://dribbble.com/shots/2311260-Day-1-Sign-Up-and-Login-Animated
-->

<section class="user-authentication">
  <div class="user_options-container">
    <div class="user_options-text">
      <div class="user_options-unregistered">
        <h2 class="user_unregistered-title">Don't have an account?</h2>
        <p class="user_unregistered-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis nibh in leo lacinia blandit et quis lorem.</p>
        <button class="user_unregistered-signup" id="signup-button">Sign up</button>
      </div>

      <div class="user_options-registered">
        <h2 class="user_registered-title">Have an account?</h2>
        <p class="user_registered-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis nibh in leo lacinia blandit et quis lorem.</p>
        <button class="user_registered-login" id="login-button">Login</button>
      </div>
    </div>

    <div class="user_options-forms" id="user_options-forms">
      <div class="user_forms-login">
        <h2 class="forms_title">Login</h2>
        <form class="forms_form" action="<?=$_SERVER['PHP_SELF']?>?action=login" method="post">
          <fieldset class="forms_fieldset">
            <div class="forms_field">
              <input type="email" placeholder="Email" name="email" class="forms_field-input" required autofocus />
            </div>
            <div class="forms_field">
              <input type="password" placeholder="Password" name="password" class="forms_field-input" required />
            </div>
          </fieldset>
          <div class="forms_buttons">
            <button type="button" class="forms_buttons-forgot" id="forget-button">Forgot password?</button>
            <button type="submit" class="forms_buttons-action">Login</button>
						<a class="forms_buttons-mb-button" id="signup-button-mb">Sign up</a>
          </div>
        </form>
      </div>
      <div class="user_forms-signup">
        <h2 class="forms_title">Sign Up</h2>
        <form class="forms_form" action="<?=$_SERVER['PHP_SELF']?>?action=register" method="post">
          <fieldset class="forms_fieldset">
            <div class="forms_field">
              <input type="text" placeholder="User Name" class="forms_field-input" name="username" required />
            </div>
            <div class="forms_field">
              <input type="email" placeholder="Email" class="forms_field-input" name="email" required />
            </div>
            <div class="forms_field">
              <input type="password" placeholder="Password" class="forms_field-input" name="password" required />
            </div>
          </fieldset>
          <div class="forms_buttons">
            <button type="submit" class="forms_buttons-action">Sign up</button>
						<a class="forms_buttons-mb-button" id="login-button-mb">Login</a>
          </div>
        </form>
      </div>
			<div class="user_forms-forgot">
        <h2 class="forms_title">Forgot Password</h2>
        <form class="forms_form">
          <fieldset class="forms_fieldset">
            <div class="forms_field">
              <input type="email" placeholder="Email" class="forms_field-input" required autofocus />
            </div>
          </fieldset>
          <div class="forms_buttons">
            <button type="submit" class="forms_buttons-action">Send reset link</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- partial -->
  <script>const signupButton = document.getElementById('signup-button'),
    loginButton = document.getElementById('login-button'),
                signupButtonMb = document.getElementById('signup-button-mb'),
    loginButtonMb = document.getElementById('login-button-mb'),
                forgetButton = document.getElementById('forget-button'),
    userForms = document.getElementById('user_options-forms'),
                loginForm = document.getElementById('user_forms-login'),
                signUpForm = document.getElementById('user_forms-signup');

// Add event listener to the "Sign Up" button
signupButton.addEventListener('click', () => {
        userForms.classList.remove('show-forgotPass');
  userForms.classList.remove('bounceRight');
  userForms.classList.add('bounceLeft');
}, false)

// Add event listener to the "Login" button
loginButton.addEventListener('click', () => {
        userForms.classList.remove('show-forgotPass');
  userForms.classList.remove('bounceLeft');
  userForms.classList.add('bounceRight');
}, false)

// Add event listener to the "Forget Password" button
forgetButton.addEventListener('click', () => {
        userForms.classList.add('show-forgotPass');
  // userForms.classList.add('bounceRight');
  // userForms.classList.remove('bounceLeft');
        userForms.classList.remove('show-login');
        userForms.classList.remove('show-signup');
}, false)

// Add event listener to the "Signup" button mobile
signupButtonMb.addEventListener('click', () => {
        userForms.classList.remove('show-forgotPass');
        userForms.classList.remove('show-login');
        userForms.classList.add('show-signup');
}, false)

// Add event listener to the "Login" button mobile
loginButtonMb.addEventListener('click', () => {
        userForms.classList.remove('show-forgotPass');
  userForms.classList.add('show-login');
        userForms.classList.remove('show-signup');
}, false)</script>

</body>
</html>
