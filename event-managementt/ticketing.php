<?php
session_start();
$user = $_SESSION['user_name'] ?? null;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Events — EventSphere</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #6c63ff;
      --secondary: #ff6584;
      --dark: #1a1a2e;
      --darker: #16213e;
      --light: rgba(255, 255, 255, 0.85);
      --translucent: rgba(255, 255, 255, 0.1);
      --gray: #4a4a68;
      --shadow: 0 10px 20px rgba(0,0,0,0.15);
      --transition: all 0.3s ease;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
      color: #9950a0ff;
      line-height: 1.6;
      overflow-x: hidden;
      min-height: 100vh;
      position: relative;
    }
    
    body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: 
        radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 101, 132, 0.2) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(108, 99, 255, 0.2) 0%, transparent 50%);
      z-index: -1;
    }
    
    header {
      background: rgba(26, 26, 46, 0.85);
      backdrop-filter: blur(10px);
      color: white;
      padding: 1.2rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      animation: slideDown 0.5s ease;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    @keyframes slideDown {
      from { transform: translateY(-100%); }
      to { transform: translateY(0); }
    }
    
    .logo {
      font-size: 1.5rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 10px;
      color: white;
    }
    
    main {
      padding: 8rem 2rem 4rem;
      max-width: 1200px;
      margin: auto;
      animation: fadeIn 0.8s ease;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .page-header {
      text-align: center;
      margin-bottom: 3rem;
    }
    
    .page-header h1 {
      font-size: 3rem;
      color: #1a1a2e;
      margin-bottom: 1rem;
      position: relative;
      display: inline-block;
      text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .page-header h1::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 4px;
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      border-radius: 2px;
    }
    
    .page-header p {
      font-size: 1.2rem;
      color: #2d2b55;
      max-width: 600px;
      margin: 0 auto;
      font-weight: 500;
    }
    
    .event-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 2.5rem;
      margin-top: 2rem;
    }
    
    .event-card {
      background: rgba(255, 255, 255, 0.75);
      backdrop-filter: blur(10px);
      border-radius: 1.5rem;
      overflow: hidden;
      box-shadow: var(--shadow);
      transition: var(--transition);
      position: relative;
      opacity: 0;
      transform: translateY(30px);
      animation: cardAppear 0.6s ease forwards;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .event-card:nth-child(1) { animation-delay: 0.1s; }
    .event-card:nth-child(2) { animation-delay: 0.2s; }
    .event-card:nth-child(3) { animation-delay: 0.3s; }
    .event-card:nth-child(4) { animation-delay: 0.4s; }
    .event-card:nth-child(5) { animation-delay: 0.5s; }
    
    @keyframes cardAppear {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .event-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.2);
      background: rgba(255, 255, 255, 0.9);
    }
    
    .event-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      transition: var(--transition);
    }
    
    .event-card:hover img {
      transform: scale(1.05);
    }
    
    .event-content {
      padding: 1.5rem;
    }
    
    .event-card h2 {
      margin-bottom: 0.8rem;
      font-size: 1.4rem;
      color: var(--darker);
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .event-card p {
      color: var(--gray);
      margin-bottom: 1.5rem;
      font-size: 0.95rem;
      line-height: 1.5;
    }
    
    .event-actions {
      display: flex;
      justify-content: center;
    }
    
    .btn {
      padding: 10px 20px;
      border-radius: 50px;
      border: none;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .btn-primary {
      background: var(--primary);
      color: white;
    }
    
    .btn-primary:hover {
      background: #5a52e0;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(108, 99, 255, 0.4);
    }
    
    footer {
      background: rgba(26, 26, 46, 0.9);
      backdrop-filter: blur(10px);
      color: white;
      padding: 2rem;
      margin-top: 4rem;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      text-align: center;
    }
    
    .copyright {
      color: rgba(255,255,255,0.6);
      font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
      header {
        padding: 1rem;
      }
      
      main {
        padding: 9rem 1rem 2rem;
      }
      
      .page-header h1 {
        font-size: 2.2rem;
      }
      
      .event-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <i class="fas fa-globe-americas"></i>
      <span>EventSphere</span>
    </div>
  </header>

  <main>
    <div class="page-header">
      <h1>🌟 Popular Events</h1>
      <p>Explore our exciting events and celebrations where you can book tickets online and join the fun!</p>
    </div>

    <div class="event-grid">
      <!-- New Year -->
      <div class="event-card">
        <img src="https://images.unsplash.com/photo-1515023115689-589c33041d3c?ixlib=rb-4.0.3&auto=format&fit=crop&w=900&q=80" 
             alt="New Year Celebration">
        <div class="event-content">
          <h2>🎉 New Year Celebration</h2>
          <p>Ring in the new year with music, fireworks, and unforgettable parties at the city's most exclusive venues.</p>
          <div class="event-actions">
            <button class="btn btn-primary">
              <i class="fas fa-ticket-alt"></i> Book Now
            </button>
          </div>
        </div>
      </div>

      <!-- Christmas -->
      <div class="event-card">
        <img src="https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?ixlib=rb-4.0.3&auto=format&fit=crop&w=900&q=80" 
             alt="Christmas Event">
        <div class="event-content">
          <h2>🎄 Christmas Festival</h2>
          <p>Enjoy Christmas markets, carols, and festive lights with family & friends in a magical winter wonderland.</p>
          <div class="event-actions">
            <button class="btn btn-primary">
              <i class="fas fa-ticket-alt"></i> Book Now
            </button>
          </div>
        </div>
      </div>

      <!-- Birthday -->
      <div class="event-card">
        <img src="https://images.sbs.com.au/dims4/default/b46a380/2147483647/strip/true/crop/2090x1176+0+93/resize/1280x720!/quality/90/?url=http:%2F%2Fsbs-au-brightspot.s3.amazonaws.com%2Fdrupal%2Ftopics%2Fpublic%2Fgettyimages-200167864-002_martinbarraud.jpg&imwidth=1280" 
             alt="Birthday Party">
        <div class="event-content">
          <h2>🎂 Birthday Party</h2>
          <p>Celebrate special birthdays with cakes, balloons, and joyful gatherings at our premium party venues.</p>
          <div class="event-actions">
            <button class="btn btn-primary">
              <i class="fas fa-ticket-alt"></i> Book Now
            </button>
          </div>
        </div>
      </div>

      <!-- Baby Shower -->
      <div class="event-card">
        <img src="https://tse4.mm.bing.net/th/id/OIP.UtHVZhciPkvHTtMdm_-KOgHaHW?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3"
             alt="Baby Shower">
        <div class="event-content">
          <h2>👶 Baby Shower</h2>
          <p>A beautiful celebration for welcoming the little one with family blessings, games, and delightful treats.</p>
          <div class="event-actions">
            <button class="btn btn-primary">
              <i class="fas fa-ticket-alt"></i> Book Now
            </button>
          </div>
        </div>
      </div>

      <!-- Party -->
      <div class="event-card">
        <img src="https://www.urbanair.com/wp-content/uploads/2021/09/MG_2914.jpg" 
             alt="Party Event">
        <div class="event-content">
          <h2>🥳 Party Night</h2>
          <p>Dance, music, and fun-filled parties for friends and colleagues with top DJs and premium beverages.</p>
          <div class="event-actions">
            <button class="btn btn-primary">
              <i class="fas fa-ticket-alt"></i> Book Now
            </button>
          </div>
        </div>
      </div>
    </div>
  </main>
  
  <footer>
    <div class="copyright">
      &copy; 2023 EventSphere. All rights reserved.
    </div>
  </footer>
</body>
</html>