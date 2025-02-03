<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Volunteer Dashboard - CHARITEX</title>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background-color: #f8f9fa;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 1rem;
    }

    h1 {
      text-align: center;
      color: #3498db;
      margin-bottom: 2rem;
    }

    .section {
      margin-bottom: 2rem;
      background: white;
      padding: 1.5rem;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .section h2 {
      margin-bottom: 1rem;
      color: #2c3e50;
    }

    .task-list {
      list-style: none;
      padding: 0;
    }

    .task-list li {
      margin-bottom: 1rem;
      padding: 1rem;
      background: #f5f5f5;
      border-radius: 5px;
    }

    .task-list li:hover {
      background: #eef6fc;
    }

    .btn {
      display: inline-block;
      margin-top: 1rem;
      padding: 0.75rem 1.5rem;
      background: #3498db;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      text-align: center;
      transition: background 0.3s ease;
    }

    .btn:hover {
      background: #2980b9;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Welcome to Your Volunteer Dashboard</h1>

    <!-- Assigned Tasks Section -->
    <div class="section">
      <h2>Assigned Tasks</h2>
      <ul class="task-list">
        <li>
          <strong>Task:</strong> Distribute educational kits to rural schools<br>
          <strong>Date:</strong> January 25, 2025<br>
          <strong>Location:</strong> Community Center, District A<br>
          <a href="#" class="btn">View Details</a>
        </li>
        <li>
          <strong>Task:</strong> Organize blood donation drive<br>
          <strong>Date:</strong> January 30, 2025<br>
          <strong>Location:</strong> Health Center, District B<br>
          <a href="#" class="btn">View Details</a>
        </li>
      </ul>
    </div>

    <!-- Available Opportunities Section -->
    <div class="section">
      <h2>Available Opportunities</h2>
      <p>Sign up for upcoming events and make an impact:</p>
      <ul class="task-list">
        <li>
          <strong>Event:</strong> Fundraising Marathon<br>
          <strong>Date:</strong> February 10, 2025<br>
          <strong>Location:</strong> City Park<br>
          <a href="#" class="btn">Sign Up</a>
        </li>
      </ul>
    </div>

    <!-- Profile Section -->
    <div class="section">
      <h2>Your Profile</h2>
      <p><strong>Name:</strong> John Doe</p>
      <p><strong>Email:</strong> john.doe@example.com</p>
      <p><strong>Skills:</strong> Teaching, First Aid</p>
      <p><strong>Availability:</strong> Weekends</p>
      <a href="#" class="btn">Update Profile</a>
    </div>
  </div>
</body>
</html>
