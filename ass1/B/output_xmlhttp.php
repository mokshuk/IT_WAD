<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .success-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: #667eea;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .success-icon {
            text-align: center;
            font-size: 60px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .user-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .info-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #667eea;
            width: 150px;
        }
        .info-value {
            color: #333;
            flex: 1;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        .btn-custom {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: bold;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-icon">✓</div>
        <h1>Registration Successful!</h1>
        <h3 style="text-align: center; color: #6c757d; margin-bottom: 30px;">
            Using XMLHttpRequest
        </h3>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
            $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
            
            echo '<div class="user-info">';
            echo '<div class="info-row">';
            echo '<div class="info-label">Full Name:</div>';
            echo '<div class="info-value">' . $name . '</div>';
            echo '</div>';
            
            echo '<div class="info-row">';
            echo '<div class="info-label">Email Address:</div>';
            echo '<div class="info-value">' . $email . '</div>';
            echo '</div>';
            
            echo '<div class="info-row">';
            echo '<div class="info-label">Username:</div>';
            echo '<div class="info-value">' . $username . '</div>';
            echo '</div>';
            
            echo '<div class="info-row">';
            echo '<div class="info-label">Registration Date:</div>';
            echo '<div class="info-value">' . date('F j, Y, g:i a') . '</div>';
            echo '</div>';
            echo '</div>';
            
            echo '<div class="alert alert-success mt-4" role="alert">';
            echo '<strong>Welcome, ' . $name . '!</strong> Your account has been successfully created.';
            echo '</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">';
            echo 'Invalid request method!';
            echo '</div>';
        }
        ?>
        
        <div class="btn-container">
            <button onclick="window.close()" class="btn btn-secondary btn-custom">Close Window</button>
            <a href="userlist.php" class="btn btn-primary btn-custom" target="_blank">View All Users</a>
        </div>
    </div>
</body>
</html>