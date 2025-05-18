<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Walawa Cabana</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
  <style>
    :root {
      --bg-color: #06202b;
      --text-color: #f5eedd;
      --accent-color: #7ae2cf;
      --button-color: #077a7d;
      --card-bg-color: #0a2a3a;
      --subtle-bg-color: #0f3b50;
      --heading-color: #ffffff;
      --text-muted-color: #a0aec0;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
      background-color: var(--bg-color);
      color: var(--text-color);
      margin: 0;
      transition: all 0.3s ease;
      overflow-x: hidden;
    }

    /* Custom styles to supplement Tailwind */
    .dashboard-bg {
      background-color: var(--bg-color);
    }
    
    .text-dashboard {
      color: var(--text-color);
    }
    
    .bg-card {
      background-color: var(--card-bg-color);
    }
    
    .bg-subtle {
      background-color: var(--subtle-bg-color);
    }
    
    .text-heading {
      color: var(--heading-color);
    }
    
    .text-muted {
      color: var(--text-muted-color);
    }
    
    .accent {
      color: var(--accent-color);
    }
    
    .btn-custom {
      background-color: var(--button-color);
      color: var(--heading-color);
      transition: all 0.3s ease;
    }
    
    .btn-custom:hover {
      background-color: var(--accent-color);
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
    }
    
    .sidebar-icon {
      transition: all 0.2s ease;
    }
    
    .nav-item {
      border-left: 3px solid transparent;
      transition: all 0.2s ease;
    }
    
    .nav-item:hover, .nav-item.active {
      border-left: 3px solid var(--accent-color);
      background-color: var(--subtle-bg-color);
    }
    
    .nav-item:hover .sidebar-icon, .nav-item.active .sidebar-icon {
      color: var(--accent-color);
    }
    
    .card {
      background-color: var(--card-bg-color);
      border-radius: 12px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
    }
    
    #particleCanvas {
      position: fixed;
      top: 0;
      left: 0;
      z-index: -1;
      width: 100%;
      height: 100%;
      pointer-events: none;
    }
    
    .progress-bar {
      height: 8px;
      border-radius: 4px;
      background-color: var(--subtle-bg-color);
    }
    
    .progress-value {
      height: 8px;
      border-radius: 4px;
      background-color: var(--accent-color);
    }
    
    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(122, 226, 207, 0.7);
      }
      70% {
        box-shadow: 0 0 0 10px rgba(122, 226, 207, 0);
      }
      100% {
        box-shadow: 0 0 0 0 rgba(122, 226, 207, 0);
      }
    }
    
    .pulse {
      animation: pulse 2s infinite;
    }
    
    /* Mobile responsiveness */
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
        position: fixed;
        height: 100vh;
        z-index: 50;
      }
      
      .sidebar.open {
        transform: translateX(0);
      }
      
      .overlay {
        display: none;
      }
      
      .overlay.active {
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 40;
      }
    }
  </style>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            dashboard: {
              bg: '#06202b',
              text: '#f5eedd',
              accent: '#7ae2cf',
              button: '#077a7d',
              card: '#0a2a3a',
              subtle: '#0f3b50',
              heading: '#ffffff',
              muted: '#a0aec0'
            }
          }
        }
      }
    }
  </script>
</head>
<body class="dashboard-bg">
  <div id="particleCanvas"></div>
  
  <div class="flex h-screen overflow-hidden">
    <div id="sidebar" class="sidebar w-64 flex-shrink-0 bg-subtle transition-all duration-300 ease-in-out">
      <div class="p-4 flex items-center justify-center mb-6">
        <h1 class="text-heading text-xl font-bold">Walawa<span class="accent"> Cabana.</span></h1>
      </div>
      
     <?php include "admin-sidebar.php"?>
      
      <div class="absolute bottom-0 w-full p-4">
        <div class="flex items-center p-2">
          <img src="/api/placeholder/40/40" alt="Admin" class="w-10 h-10 rounded-full mr-3" />
          <div>
            <p class="text-heading font-medium">Alex Johnson</p>
            <p class="text-muted text-sm">Super Admin</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="flex-1 flex flex-col overflow-hidden">
      <header class="bg-card shadow-md">
        <div class="flex items-center justify-between p-4">
          <div class="flex items-center">
            <button id="menuToggle" class="mr-4 text-heading lg:hidden">
              <i class="fas fa-bars"></i>
            </button>
            <h2 class="text-heading font-bold">Dashboard</h2>
          </div>
          
          <div class="flex items-center">
            <div class="relative mr-4">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-search text-muted"></i>
              </span>
              <input type="text" class="bg-subtle text-text rounded-lg pl-10 pr-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-accent" placeholder="Search..." />
            </div>
            
            <div class="flex items-center">
              <button class="text-muted hover:text-heading mx-2 relative">
                <i class="fas fa-bell"></i>
                <span class="absolute -top-1 -right-1 w-2 h-2 bg-accent rounded-full pulse"></span>
              </button>
              
              <button class="text-muted hover:text-heading mx-2">
                <i class="fas fa-cog"></i>
              </button>
            </div>
          </div>
        </div>
      </header>
      
      <main class="flex-1 overflow-y-auto p-4">
        <div class="mb-6">
          <h1 class="text-heading text-2xl font-bold mb-2">Welcome back, Alex!</h1>
          <p class="text-muted">Here's what's happening with your travel business today.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
          <div class="card p-4">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-muted">Total Bookings</h3>
              <span class="bg-subtle p-2 rounded-lg"><i class="fas fa-calendar accent"></i></span>
            </div>
            <div class="flex items-end justify-between">
              <div>
                <h2 class="text-heading text-3xl font-bold">867</h2>
                <p class="text-accent text-sm"><i class="fas fa-arrow-up mr-1"></i> 12% this month</p>
              </div>
              <div class="text-muted text-sm">
                +24 today
              </div>
            </div>
          </div>
          
          <div class="card p-4">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-muted">User Count</h3>
              <span class="bg-subtle p-2 rounded-lg"><i class="fas fa-users accent"></i></span>
            </div>
            <div class="flex items-end justify-between">
              <div>
                <h2 class="text-heading text-3xl font-bold">2,543</h2>
                <p class="text-accent text-sm"><i class="fas fa-arrow-up mr-1"></i> 8% this month</p>
              </div>
              <div class="text-muted text-sm">
                +12 today
              </div>
            </div>
          </div>
          
          <div class="card p-4">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-muted">Messages</h3>
              <span class="bg-subtle p-2 rounded-lg"><i class="fas fa-envelope accent"></i></span>
            </div>
            <div class="flex items-end justify-between">
              <div>
                <h2 class="text-heading text-3xl font-bold">128</h2>
                <p class="text-accent text-sm"><i class="fas fa-arrow-up mr-1"></i> 18% this month</p>
              </div>
              <div class="text-muted text-sm">
                +3 unread
              </div>
            </div>
          </div>
          
          <div class="card p-4">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-muted">Revenue</h3>
              <span class="bg-subtle p-2 rounded-lg"><i class="fas fa-dollar-sign accent"></i></span>
            </div>
            <div class="flex items-end justify-between">
              <div>
                <h2 class="text-heading text-3xl font-bold">$98.3k</h2>
                <p class="text-accent text-sm"><i class="fas fa-arrow-up mr-1"></i> 24% this month</p>
              </div>
              <div class="text-muted text-sm">
                +$4.5k today
              </div>
            </div>
          </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
          <div class="card p-4 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-heading font-bold">Booking Analytics</h3>
              <div class="flex">
                <button class="btn-custom px-3 py-1 rounded-lg text-sm mr-2">Monthly</button>
                <button class="bg-subtle text-muted px-3 py-1 rounded-lg text-sm">Weekly</button>
              </div>
            </div>
            <div>
              <canvas id="bookingChart" height="250"></canvas>
            </div>
          </div>
          
          <div class="card p-4">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-heading font-bold">Recent Activity</h3>
              <button class="text-muted hover:text-accent">
                <i class="fas fa-ellipsis-h"></i>
              </button>
            </div>
            
            <div class="space-y-4">
              <div class="flex items-start">
                <div class="bg-subtle p-2 rounded-lg mr-3">
                  <i class="fas fa-user-plus text-accent"></i>
                </div>
                <div>
                  <p class="text-heading">New user registered</p>
                  <p class="text-muted text-sm">Sarah Williams</p>
                  <p class="text-muted text-xs">5 minutes ago</p>
                </div>
              </div>
              
              <div class="flex items-start">
                <div class="bg-subtle p-2 rounded-lg mr-3">
                  <i class="fas fa-calendar-check text-accent"></i>
                </div>
                <div>
                  <p class="text-heading">New booking</p>
                  <p class="text-muted text-sm">Bali Discovery Package</p>
                  <p class="text-muted text-xs">15 minutes ago</p>
                </div>
              </div>
              
              <div class="flex items-start">
                <div class="bg-subtle p-2 rounded-lg mr-3">
                  <i class="fas fa-star text-accent"></i>
                </div>
                <div>
                  <p class="text-heading">New review</p>
                  <p class="text-muted text-sm">Europe Cultural Tour</p>
                  <p class="text-muted text-xs">1 hour ago</p>
                </div>
              </div>
              
              <div class="flex items-start">
                <div class="bg-subtle p-2 rounded-lg mr-3">
                  <i class="fas fa-envelope text-accent"></i>
                </div>
                <div>
                  <p class="text-heading">New message</p>
                  <p class="text-muted text-sm">John Doe asked about pricing</p>
                  <p class="text-muted text-xs">2 hours ago</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="card p-4 mb-6">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-heading font-bold">Popular Packages</h3>
            <button class="btn-custom px-4 py-2 rounded-lg text-sm">View All</button>
          </div>
          
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead>
                <tr class="text-left text-muted border-b border-subtle">
                  <th class="pb-3">Package Name</th>
                  <th class="pb-3">Price</th>
                  <th class="pb-3">Bookings</th>
                  <th class="pb-3">Status</th>
                  <th class="pb-3">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b border-subtle">
                  <td class="py-3">
                    <div class="flex items-center">
                      <img src="/api/placeholder/40/40" alt="Bali" class="w-10 h-10 rounded-lg mr-3" />
                      <div>
                        <p class="text-heading">Bali Discovery</p>
                        <p class="text-muted text-sm">7 days tour</p>
                      </div>
                    </div>
                  </td>
                  <td>$1,299</td>
                  <td>
                    <div>
                      <p class="text-heading">284</p>
                      <div class="progress-bar w-full mt-1">
                        <div class="progress-value" style="width: 75%"></div>
                      </div>
                    </div>
                  </td>
                  <td><span class="bg-accent bg-opacity-20 text-accent px-2 py-1 rounded-full text-xs">Active</span></td>
                  <td>
                    <button class="text-muted hover:text-accent mr-2"><i class="fas fa-edit"></i></button>
                    <button class="text-muted hover:text-accent"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
                
                <tr class="border-b border-subtle">
                  <td class="py-3">
                    <div class="flex items-center">
                      <img src="/api/placeholder/40/40" alt="Europe" class="w-10 h-10 rounded-lg mr-3" />
                      <div>
                        <p class="text-heading">Europe Cultural Tour</p>
                        <p class="text-muted text-sm">14 days tour</p>
                      </div>
                    </div>
                  </td>
                  <td>$2,699</td>
                  <td>
                    <div>
                      <p class="text-heading">198</p>
                      <div class="progress-bar w-full mt-1">
                        <div class="progress-value" style="width: 60%"></div>
                      </div>
                    </div>
                  </td>
                  <td><span class="bg-accent bg-opacity-20 text-accent px-2 py-1 rounded-full text-xs">Active</span></td>
                  <td>
                    <button class="text-muted hover:text-accent mr-2"><i class="fas fa-edit"></i></button>
                    <button class="text-muted hover:text-accent"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
                
                <tr class="border-b border-subtle">
                  <td class="py-3">
                    <div class="flex items-center">
                      <img src="/api/placeholder/40/40" alt="Japan" class="w-10 h-10 rounded-lg mr-3" />
                      <div>
                        <p class="text-heading">Japan Explorer</p>
                        <p class="text-muted text-sm">10 days tour</p>
                      </div>
                    </div>
                  </td>
                  <td>$1,999</td>
                  <td>
                    <div>
                      <p class="text-heading">156</p>
                      <div class="progress-bar w-full mt-1">
                        <div class="progress-value" style="width: 45%"></div>
                      </div>
                    </div>
                  </td>
                  <td><span class="bg-subtle text-muted px-2 py-1 rounded-full text-xs">Inactive</span></td>
                  <td>
                    <button class="text-muted hover:text-accent mr-2"><i class="fas fa-edit"></i></button>
                    <button class="text-muted hover:text-accent"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
                
                <tr>
                  <td class="py-3">
                    <div class="flex items-center">
                      <img src="/api/placeholder/40/40" alt="Mexico" class="w-10 h-10 rounded-lg mr-3" />
                      <div>
                        <p class="text-heading">Mexico Adventure</p>
                        <p class="text-muted text-sm">8 days tour</p>
                      </div>
                    </div>
                  </td>
                  <td>$1,499</td>
                  <td>
                    <div>
                      <p class="text-heading">142</p>
                      <div class="progress-bar w-full mt-1">
                        <div class="progress-value" style="width: 40%"></div>
                      </div>
                    </div>
                  </td>
                  <td><span class="bg-accent bg-opacity-20 text-accent px-2 py-1 rounded-full text-xs">Active</span></td>
                  <td>
                    <button class="text-muted hover:text-accent mr-2"><i class="fas fa-edit"></i></button>
                    <button class="text-muted hover:text-accent"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>
  
  <div id="overlay" class="overlay"></div>
  
  <script>
    // Mobile sidebar toggle
    document.getElementById('menuToggle').addEventListener('click', () => {
      document.getElementById('sidebar').classList.toggle('open');
      document.getElementById('overlay').classList.toggle('active');
    });
    
    document.getElementById('overlay').addEventListener('click', () => {
      document.getElementById('sidebar').classList.remove('open');
      document.getElementById('overlay').classList.remove('active');
    });
    
    // Chart initialization
    const ctx = document.getElementById('bookingChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(122, 226, 207, 0.5)');
    gradient.addColorStop(1, 'rgba(122, 226, 207, 0.0)');
    
    const bookingChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
          label: 'Bookings',
          data: [65, 78, 52, 91, 68, 82, 59, 91, 114, 138, 116, 160],
          borderColor: '#7ae2cf',
          backgroundColor: gradient,
          tension: 0.4,
          fill: true,
          pointBackgroundColor: '#077a7d',
          pointBorderColor: '#7ae2cf',
          pointBorderWidth: 2,
          pointRadius: 4,
          pointHoverRadius: 6
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(255, 255, 255, 0.05)'
            },
            ticks: {
              color: '#a0aec0'
            }
          },
          x: {
            grid: {
              display: false
            },
            ticks: {
              color: '#a0aec0'
            }
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });
    
    // Three.js background animation
    function initThreeJSBackground() {
      const canvas = document.getElementById('particleCanvas');
      
      const scene = new THREE.Scene();
      const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
      
      const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
      renderer.setSize(window.innerWidth, window.innerHeight);
      renderer.setClearColor(0x000000, 0);
      
      // Create particles
      const particleCount = 100;
      const particles = new THREE.Group();
      
      for (let i = 0; i < particleCount; i++) {
        const geometry = new THREE.SphereGeometry(0.1, 8, 8);
        const material = new THREE.MeshBasicMaterial({
          color: new THREE.Color('#7ae2cf'),
          transparent: true,
          opacity: Math.random() * 0.5 + 0.1
        });
        
        const particle = new THREE.Mesh(geometry, material);
        
        // Random position
        particle.position.x = (Math.random() - 0.5) * 20;
        particle.position.y = (Math.random() - 0.5) * 20;
        particle.position.z = (Math.random() - 0.5) * 20 - 10;
        
        // Custom properties for animation
        particle.userData = {
          speed: Math.random() * 0.02 + 0.01,
          direction: new THREE.Vector3(
            (Math.random() - 0.5) * 0.04,
            (Math.random() - 0.5) * 0.04,
            (Math.random() - 0.5) * 0.04
          ),
          rotationSpeed: Math.random() * 0.02 + 0.005
        };
        
        particles.add(particle);
      }
      
      scene.add(particles);
      
      camera.position.z = 5;
      
      // Add subtle ambient lighting
      const ambientLight = new THREE.AmbientLight(0x7ae2cf, 0.5);
      scene.add(ambientLight);
      
      function animate() {
        requestAnimationFrame(animate);
        
        // Update particles
        particles.children.forEach(particle => {
          particle.position.x += particle.userData.direction.x;
          particle.position.y += particle.userData.direction.y;
          particle.position.z += particle.userData.direction.z;
          
          particle.rotation.x += particle.userData.rotationSpeed;
          particle.rotation.y += particle.userData.rotationSpeed;
          
          // Reset if out of bounds
          if (
            particle.position.x > 10 || particle.position.x < -10 ||
            particle.position.y > 10 || particle.position.y < -10 ||
            particle.position.z > 10 || particle.position.z < -20
          ) {
            particle.position.x = (Math.random() - 0.5) * 20;
            particle.position.y = (Math.random() - 0.5) * 20;
            particle.position.z = -15;
          }
          
          // Pulse effect
          const scale = 0.8 + Math.sin(Date.now() * 0.001 + particle.position.x) * 0.2;
          particle.scale.set(scale, scale, scale);
        });
        
        // Rotate entire particle system
        particles.rotation.y += 0.001;
        
        renderer.render(scene, camera); // Added this line to render the scene
      }
      
      initThreeJSBackground(); // Call the function to start the animation
    }
    // Call initThreeJSBackground when the window loads, or after the DOM is ready.
    // For simplicity, calling it directly here. If you have issues, consider window.onload or DOMContentLoaded.
    if (document.readyState === 'complete' || (document.readyState !== 'loading' && !document.documentElement.doScroll)) {
      initThreeJSBackground();
    } else {
      document.addEventListener('DOMContentLoaded', initThreeJSBackground);
    }
  </script>
</body>
</html>