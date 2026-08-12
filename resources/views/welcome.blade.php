<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f4f6f9;
      color: #333;
    }

    .login-container {
      width: 100%;
      max-width: 400px;
      padding: 20px;
    }

    .login-card {
      background: #fff;
      padding: 35px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .login-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .login-header h1 {
      font-size: 28px;
      margin-bottom: 8px;
      color: #1f2937;
    }

    .login-header p {
      font-size: 14px;
      color: #6b7280;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 7px;
      font-size: 14px;
      font-weight: 600;
      color: #374151;
    }

    .form-group input {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #d1d5db;
      border-radius: 7px;
      font-size: 15px;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-group input:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 22px;
      font-size: 14px;
    }

    .remember-me {
      display: flex;
      align-items: center;
      gap: 7px;
    }

    .remember-me input {
      width: auto;
    }

    .forgot-password {
      color: #2563eb;
      text-decoration: none;
    }

    .forgot-password:hover {
      text-decoration: underline;
    }

    .login-button {
      width: 100%;
      padding: 13px;
      border: none;
      border-radius: 7px;
      background: #2563eb;
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }

    .login-button:hover {
      background: #1d4ed8;
    }

    .login-button:focus-visible {
      outline: 3px solid rgba(37, 99, 235, 0.3);
      outline-offset: 2px;
    }

    @media (max-width: 480px) {
      .login-card {
        padding: 25px 20px;
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

  <main class="login-container">
    <section class="login-card" aria-labelledby="login-title">

      <header class="login-header">
        <h1 id="login-title">Admin Login</h1>
        <p>Sign in to access the administration panel.</p>
      </header>

      @error('email')
        <span style="color: red; padding-bottom: 6px;">{{ $message }}</span><br>
      @enderror

      

      <form action="{{route('admin.login')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="email">Email Address</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="admin@example.com"
            autocomplete="username"
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

        <div class="form-options">
          <label class="remember-me">
            <input type="checkbox" name="remember">
            <span>Remember me</span>
          </label>

          <a href="{{route('admin.password.sendemail')}}" id="forgotpassword" class="forgot-password">
            Forgot password?
          </a>
        </div>

        <button type="submit" class="login-button">
          Sign In
        </button>

      </form>

    </section>
  </main>

</body>
</html>