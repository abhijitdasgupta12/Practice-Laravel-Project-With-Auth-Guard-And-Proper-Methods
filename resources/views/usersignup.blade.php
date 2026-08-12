<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      min-height: 100vh;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #eef4ff, #f8fafc);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      color: #1f2937;
    }

    .login-wrapper {
      width: 100%;
      max-width: 900px;
      min-height: 550px;
      background: #fff;
      border-radius: 18px;
      overflow: hidden;
      display: grid;
      grid-template-columns: 1fr 1fr;
      box-shadow: 0 15px 45px rgba(0, 0, 0, 0.10);
    }

    /* Left section */
    .login-intro {
      background: #2563eb;
      color: #fff;
      padding: 55px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-intro .brand {
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 50px;
    }

    .login-intro h1 {
      font-size: 38px;
      line-height: 1.15;
      margin-bottom: 20px;
    }

    .login-intro p {
      color: #dbeafe;
      line-height: 1.7;
      font-size: 15px;
      max-width: 350px;
    }

    /* Right section */
    .login-form-section {
      padding: 55px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-form-section h2 {
      font-size: 28px;
      margin-bottom: 8px;
    }

    .subtitle {
      color: #6b7280;
      font-size: 14px;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-size: 14px;
      font-weight: 600;
    }

    .form-group input {
      width: 100%;
      padding: 13px 14px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 15px;
      outline: none;
      transition: 0.2s;
    }

    .form-group input:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      font-size: 13px;
    }

    .remember {
      display: flex;
      align-items: center;
      gap: 7px;
    }

    .remember input {
      width: auto;
    }

    .forgot-password {
      color: #2563eb;
      text-decoration: none;
    }

    .forgot-password:hover {
      text-decoration: underline;
    }

    .login-btn {
      width: 100%;
      padding: 14px;
      border: none;
      border-radius: 8px;
      background: #2563eb;
      color: #fff;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.2s;
    }

    .login-btn:hover {
      background: #1d4ed8;
    }

    .register-text {
      text-align: center;
      margin-top: 25px;
      font-size: 14px;
      color: #6b7280;
    }

    .register-text a {
      color: #2563eb;
      font-weight: 600;
      text-decoration: none;
    }

    .register-text a:hover {
      text-decoration: underline;
    }

    @media (max-width: 700px) {
      .login-wrapper {
        grid-template-columns: 1fr;
        max-width: 450px;
      }

      .login-intro {
        padding: 35px;
        min-height: 250px;
      }

      .login-intro .brand {
        margin-bottom: 25px;
      }

      .login-intro h1 {
        font-size: 30px;
      }

      .login-form-section {
        padding: 35px;
      }
    }

    @media (max-width: 400px) {
      .login-form-section {
        padding: 25px 20px;
      }

      .login-intro {
        padding: 30px 20px;
      }

      .form-options {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }
    }
  </style>
</head>

<body>

  <main class="login-wrapper">

    <!-- Introduction -->
    <section class="login-intro">
      <div class="brand">MyApp</div>

      <h1>Welcome!</h1>

      <p>
        Sign up and get access your profile,
        orders, settings, and other personalized features.
      </p>
    </section>

    <!-- Login Form -->
    <section class="login-form-section">

      <h2>Register</h2>

      <p class="subtitle">
        Fill up the fields to continue.
      </p>

      <form action="{{route('user.post.signup')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="email">Name</label>

          <input
            type="text"
            id="name"
            name="name"
            placeholder="John Doe"
            autocomplete="name"
            required
          >
        </div>

        <div class="form-group">
          <label for="email">Email</label>

          <input
            type="email"
            id="email"
            name="email"
            placeholder="email@demo.com"
            autocomplete="email"
            required
          >
        </div>

        <div class="form-group">
          <label for="password">Password</label>

          <input
            type="password"
            id="password"
            name="password"
            placeholder="Enter your password"
            autocomplete="current-password"
            required
          >
        </div>

        <div class="form-group">
          <label for="password">Confirm Password</label>

          <input
            type="password"
            id="password"
            name="password_confirmation"
            placeholder="Enter your password"
            autocomplete="current-password"
            required
          >
        </div>

        <div class="form-options">

          <!-- <a
            href="/forgot-password"
            class="forgot-password"
          >
            Forgot password?
          </a> -->

        </div>

        <button
          type="submit"
          class="login-btn"
        >
          Register
        </button>

      </form>

      <p class="register-text">
        Have an account?
        <a href="{{route('user.login')}}">Login Here</a>
      </p>

    </section>

  </main>

</body>
</html>