<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users List</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        .page-header {
            background: white;
            padding: 30px;
            border-radius: 15px 15px 0 0;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        h1 {
            color: #4facfe;
            margin: 0;
            font-weight: bold;
        }
        .users-table-container {
            background: white;
            padding: 30px;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .table {
            margin-bottom: 0;
        }
        .table thead {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
        }
        .table tbody tr {
            transition: background-color 0.3s;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .badge-custom {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
        }
        .no-data {
            text-align: center;
            padding: 50px;
            color: #6c757d;
        }
        .btn-clear {
            margin-top: 20px;
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 8px;
            font-weight: bold;
        }
        .btn-clear:hover {
            background: #c82333;
        }
        .stats-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            gap: 15px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            flex: 1;
        }
        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #4facfe;
        }
        .stat-label {
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number" id="totalUsers">0</div>
                <div class="stat-label">Total Registrations</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="todayUsers">0</div>
                <div class="stat-label">Today's Registrations</div>
            </div>
        </div>

        <div class="page-header">
            <h1>📋 Registered Users List</h1>
            <p class="text-muted mb-0">View all users registered through localStorage</p>
        </div>
        
        <div class="users-table-container">
            <div id="usersTableContent">
                <!-- Content will be loaded here -->
            </div>
            
            <div class="text-center">
                <button onclick="clearAllUsers()" class="btn btn-clear">
                    Clear All Registrations
                </button>
                <button onclick="location.reload()" class="btn btn-primary" style="margin-left: 10px; padding: 10px 30px; border-radius: 8px; font-weight: bold;">
                    Refresh List
                </button>
            </div>
        </div>
    </div>

    <script>
        function loadUsers() {
            var users = JSON.parse(localStorage.getItem('registeredUsers') || '[]');
            var content = '';
            
            // Update statistics
            document.getElementById('totalUsers').textContent = users.length;
            
            // Calculate today's registrations
            var today = new Date().toDateString();
            var todayCount = users.filter(function(user) {
                return new Date(user.timestamp).toDateString() === today;
            }).length;
            document.getElementById('todayUsers').textContent = todayCount;
            
            if (users.length === 0) {
                content = '<div class="no-data">';
                content += '<h3>No Users Registered Yet</h3>';
                content += '<p>Register new users to see them appear here.</p>';
                content += '</div>';
            } else {
                content = '<div class="table-responsive">';
                content += '<table class="table table-hover">';
                content += '<thead>';
                content += '<tr>';
                content += '<th>#</th>';
                content += '<th>Full Name</th>';
                content += '<th>Email</th>';
                content += '<th>Username</th>';
                content += '<th>Registration Date</th>';
                content += '<th>Action</th>';
                content += '</tr>';
                content += '</thead>';
                content += '<tbody>';
                
                users.forEach(function(user, index) {
                    var date = new Date(user.timestamp);
                    var formattedDate = date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
                    
                    content += '<tr>';
                    content += '<td>' + (index + 1) + '</td>';
                    content += '<td><strong>' + user.name + '</strong></td>';
                    content += '<td>' + user.email + '</td>';
                    content += '<td><span class="badge bg-primary badge-custom">' + user.username + '</span></td>';
                    content += '<td>' + formattedDate + '</td>';
                    content += '<td><button onclick="deleteUser(' + index + ')" class="btn btn-sm btn-danger">Delete</button></td>';
                    content += '</tr>';
                });
                
                content += '</tbody>';
                content += '</table>';
                content += '</div>';
            }
            
            document.getElementById('usersTableContent').innerHTML = content;
        }
        
        function clearAllUsers() {
            if (confirm('Are you sure you want to delete all registered users? This action cannot be undone!')) {
                localStorage.removeItem('registeredUsers');
                loadUsers();
                alert('All users have been cleared!');
            }
        }
        
        function deleteUser(index) {
            if (confirm('Are you sure you want to delete this user?')) {
                var users = JSON.parse(localStorage.getItem('registeredUsers') || '[]');
                users.splice(index, 1);
                localStorage.setItem('registeredUsers', JSON.stringify(users));
                loadUsers();
                alert('User deleted successfully!');
            }
        }
        
        // Load users when page loads
        $(document).ready(function() {
            loadUsers();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>