<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Dashboard</title>

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      color: #333;
    }

    /* Layout */
    .dashboard {
      min-height: 100vh;
      display: flex;
    }

    /* Sidebar */
    .sidebar {
      width: 240px;
      background: #1f2937;
      color: #fff;
      padding: 25px 15px;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
    }

    .logo {
      padding: 0 15px 30px;
      font-size: 22px;
      font-weight: 700;
    }

    .nav-menu {
      list-style: none;
    }

    .nav-menu li {
      margin-bottom: 6px;
    }

    .nav-menu a {
      display: block;
      padding: 12px 15px;
      border-radius: 7px;
      color: #d1d5db;
      text-decoration: none;
      font-size: 14px;
      transition: 0.2s;
    }

    .nav-menu a:hover,
    .nav-menu a.active {
      background: #2563eb;
      color: #fff;
    }

    /* Main Content */
    .main-content {
      width: calc(100% - 240px);
      margin-left: 240px;
      min-height: 100vh;
    }

    /* Top Header */
    .topbar {
      height: 70px;
      background: #fff;
      border-bottom: 1px solid #e5e7eb;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 30px;
    }

    .topbar h1 {
      font-size: 22px;
      color: #1f2937;
    }

    .admin-profile {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 14px;
      font-weight: 600;
    }

    .profile-avatar {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: #2563eb;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Content */
    .content {
      padding: 30px;
    }

    .welcome {
      margin-bottom: 25px;
    }

    .welcome h2 {
      font-size: 24px;
      color: #1f2937;
      margin-bottom: 6px;
    }

    .welcome p {
      color: #6b7280;
      font-size: 14px;
    }

    /* Statistics */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: #fff;
      border-radius: 10px;
      padding: 22px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .stat-card .label {
      color: #6b7280;
      font-size: 14px;
      margin-bottom: 10px;
    }

    .stat-card .value {
      font-size: 28px;
      font-weight: 700;
      color: #1f2937;
    }

    .stat-card .change {
      margin-top: 8px;
      font-size: 13px;
      color: #16a34a;
    }

    /* Content Grid */
    .dashboard-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 20px;
    }

    .card {
      background: #fff;
      border-radius: 10px;
      padding: 25px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .card-header h3 {
      font-size: 18px;
      color: #1f2937;
    }

    .view-all {
      color: #2563eb;
      font-size: 13px;
      text-decoration: none;
    }

    .view-all:hover {
      text-decoration: underline;
    }

    /* Table */
    .table-wrapper {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 14px 10px;
      text-align: left;
      border-bottom: 1px solid #e5e7eb;
      font-size: 14px;
    }

    th {
      color: #6b7280;
      font-weight: 600;
    }

    td {
      color: #374151;
    }

    .status {
      display: inline-block;
      padding: 5px 9px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .status.active {
      background: #dcfce7;
      color: #166534;
    }

    .status.pending {
      background: #fef3c7;
      color: #92400e;
    }

    /* Activity */
    .activity-list {
      list-style: none;
    }

    .activity-item {
      display: flex;
      gap: 12px;
      padding: 13px 0;
      border-bottom: 1px solid #e5e7eb;
    }

    .activity-item:last-child {
      border-bottom: none;
    }

    .activity-icon {
      width: 34px;
      height: 34px;
      flex-shrink: 0;
      border-radius: 50%;
      background: #eff6ff;
      color: #2563eb;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      font-weight: bold;
    }

    .activity-text {
      font-size: 13px;
      line-height: 1.5;
    }

    .activity-text strong {
      color: #1f2937;
    }

    .activity-time {
      display: block;
      color: #9ca3af;
      font-size: 11px;
      margin-top: 3px;
    }

    /* Responsive */
    @media (max-width: 1000px) {
      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .dashboard-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 700px) {
      .sidebar {
        width: 70px;
        padding: 20px 10px;
      }

      .logo {
        text-align: center;
        padding: 0 0 25px;
        font-size: 0;
      }

      .logo::after {
        content: "A";
        font-size: 22px;
      }

      .nav-menu a {
        text-align: center;
        font-size: 0;
      }

      .nav-menu a::first-letter {
        font-size: 18px;
      }

      .main-content {
        width: calc(100% - 70px);
        margin-left: 70px;
      }

      .topbar {
        padding: 0 20px;
      }

      .topbar h1 {
        font-size: 18px;
      }

      .content {
        padding: 20px;
      }
    }

    @media (max-width: 500px) {
      .stats-grid {
        grid-template-columns: 1fr;
      }

      .admin-profile span {
        display: none;
      }

      .welcome h2 {
        font-size: 20px;
      }

      .card {
        padding: 18px;
      }
    }
  </style>
</head>

<body>

  <div class="dashboard">

    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">
        Admin Panel
      </div>

      <nav aria-label="Main navigation">
        <ul class="nav-menu">
          <li>
            <a href="#" class="active">Dashboard</a>
          </li>
          <li>
            <a href="#">Users</a>
          </li>
          <li>
            <a href="#">Orders</a>
          </li>
          <li>
            <a href="#">Products</a>
          </li>
          <li>
            <a href="#">Reports</a>
          </li>
          <li>
            <a href="#">Settings</a>
          </li>
          <li id="myButton">
            <a href="javascript:void(0)" >Logout</a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

      <!-- Top Bar -->
      <header class="topbar">
        <h1>Dashboard</h1>

        <div class="admin-profile">
          <div class="profile-avatar">CT</div>
          <span>{{auth()->guard('admin')->user()->name}}</span>
        </div>
      </header>

      <!-- Dashboard Content -->
      <div class="content">

        <section class="welcome">
          <h2>Welcome back, {{auth()->guard('admin')->user()->name}}!</h2>
          <p>Here's what's happening with your application today.</p>
        </section>

        <!-- Statistics -->
        <section class="stats-grid" aria-label="Statistics">

          <article class="stat-card">
            <div class="label">Total Users</div>
            <div class="value">12,480</div>
            <div class="change">+8.2% this month</div>
          </article>

          <article class="stat-card">
            <div class="label">Total Orders</div>
            <div class="value">3,842</div>
            <div class="change">+12.5% this month</div>
          </article>

          <article class="stat-card">
            <div class="label">Revenue</div>
            <div class="value">$48,290</div>
            <div class="change">+6.8% this month</div>
          </article>

          <article class="stat-card">
            <div class="label">Pending Orders</div>
            <div class="value">126</div>
            <div class="change">-3.4% this month</div>
          </article>

        </section>

        <!-- Dashboard Cards -->
        <section class="dashboard-grid">

          <!-- Recent Orders -->
          <article class="card">

            <div class="card-header">
              <h3>Recent Orders</h3>
              <a href="#" class="view-all">View All</a>
            </div>

            <div class="table-wrapper">
              <table>
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>#ORD-1024</td>
                    <td>John Smith</td>
                    <td>$240.00</td>
                    <td>
                      <span class="status active">Completed</span>
                    </td>
                  </tr>

                  <tr>
                    <td>#ORD-1023</td>
                    <td>Sarah Wilson</td>
                    <td>$185.50</td>
                    <td>
                      <span class="status pending">Pending</span>
                    </td>
                  </tr>

                  <tr>
                    <td>#ORD-1022</td>
                    <td>Michael Brown</td>
                    <td>$320.00</td>
                    <td>
                      <span class="status active">Completed</span>
                    </td>
                  </tr>

                  <tr>
                    <td>#ORD-1021</td>
                    <td>Emily Davis</td>
                    <td>$95.00</td>
                    <td>
                      <span class="status active">Completed</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

          </article>

          <!-- Recent Activity -->
          <article class="card">

            <div class="card-header">
              <h3>Recent Activity</h3>
            </div>

            <ul class="activity-list">

              <li class="activity-item">
                <div class="activity-icon">U</div>

                <div class="activity-text">
                  <strong>John Smith</strong> created a new account.
                  <span class="activity-time">5 minutes ago</span>
                </div>
              </li>

              <li class="activity-item">
                <div class="activity-icon">O</div>

                <div class="activity-text">
                  New order <strong>#ORD-1024</strong> was placed.
                  <span class="activity-time">20 minutes ago</span>
                </div>
              </li>

              <li class="activity-item">
                <div class="activity-icon">P</div>

                <div class="activity-text">
                  Product <strong>Wireless Headphones</strong> was updated.
                  <span class="activity-time">1 hour ago</span>
                </div>
              </li>

              <li class="activity-item">
                <div class="activity-icon">S</div>

                <div class="activity-text">
                  System settings were updated.
                  <span class="activity-time">2 hours ago</span>
                </div>
              </li>

            </ul>

          </article>

        </section>

      </div>
    </main>

  </div>

</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  $('#myButton').click(function (e){
    e.preventDefault();
    
    $.ajax({
      url: "{{route('admin.logout')}}",
      type: "POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      success: function (response) {
        window.location.href = "{{route('admin.login.page')}}";
      },
      error: function (xhr) {
          console.error("ERROR: ",xhr.responseText);
      }
    })
  })
</script>

</html>