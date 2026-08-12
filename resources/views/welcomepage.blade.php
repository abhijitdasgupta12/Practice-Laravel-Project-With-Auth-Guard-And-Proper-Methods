<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .welcome-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            padding: 3rem 2rem;
            max-width: 600px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
        }

        .btn-custom {
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>

    <div class="container text-center">
        <div class="welcome-card mx-auto">
            <!-- Heading -->
            <h1 class="display-4 fw-bold mb-3">Welcome to Portal</h1>
            
            <!-- Description -->
            <p class="lead text-light opacity-75 mb-4">
                Please select your access level to continue to your dashboard.
            </p>
            
            <!-- Buttons -->
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('admin.login.page') }}" class="btn btn-primary btn-custom">
                    Admin Portal
                </a>
                <a href="{{ route('user.login') }}" class="btn btn-outline-light btn-custom">
                    User Portal
                </a>
            </div>
        </div>
    </div>

</body>
</html>