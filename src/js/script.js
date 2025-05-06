// --- Global Variables & Setup ---
const preloader = document.getElementById("preloader");
const navbar = document.getElementById("navbar");
const navLinks = navbar.querySelectorAll(
  ".nav-link:not(.mobile-menu .nav-link)"
); // Exclude mobile links for scrollspy
const navTextColorElements = navbar.querySelectorAll(".nav-text-color");
const menuButton = document.getElementById("menuButton");
const closeMenu = document.getElementById("closeMenu");
const mobileMenu = document.getElementById("mobileMenu");
const mobileNavLinks = mobileMenu.querySelectorAll(".nav-link");
const heroSection = document.getElementById("home");
const galleryItems = document.querySelectorAll(".gallery-item");
const lightbox = document.getElementById("lightbox");
const lightboxImage = document.getElementById("lightboxImage");
const lightboxClose = document.getElementById("lightboxClose");
const bookingForm = document.getElementById("bookingForm");
const contactForm = document.getElementById("contactForm");
const whyUsItems = document.querySelectorAll(".why-us-item");
const packageCards = document.querySelectorAll(".package-card");

// --- Preloader Logic (Infinity Loader & Fade Out) ---
function initPreloader() {
  // Because only Chrome supports offset-path, feGaussianBlur for now.
  const isChrome =
    /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
  const infinityChromeLoader = document.querySelector(".infinityChrome");
  const infinityLoader = document.querySelector(".infinity");

  if (infinityChromeLoader && infinityLoader) {
    if (isChrome) {
      infinityChromeLoader.style.display = "block";
      infinityLoader.style.display = "none";
    } else {
      infinityChromeLoader.style.display = "none";
      infinityLoader.style.display = "block";
    }
  } else {
    console.error("Preloader elements not found!");
  }

  // Fade out the preloader after a delay (or use window.onload)
  window.addEventListener("load", () => {
    setTimeout(() => {
      // You can adjust or remove the timeout
      if (preloader) {
        preloader.classList.add("fade-out");
      }
    }, 500); // Short delay after load event
  });
}
initPreloader(); // Run the preloader logic

// --- Navbar Scroll & Style ---
function handleScroll() {
  const isTop = window.scrollY < 50;
  navbar.classList.toggle("scrolled", !isTop);

  // Active Nav Link Highlighting
  let currentSectionId = "";
  let sections = document.querySelectorAll("section[id]");
  sections.forEach((section) => {
    const sectionTop = section.offsetTop - navbar.offsetHeight - 100; // Adjust offset
    const sectionBottom = sectionTop + section.offsetHeight;
    if (window.scrollY >= sectionTop && window.scrollY < sectionBottom) {
      currentSectionId = section.getAttribute("id");
    }
  });
  // Handle hero section specifically if no other section is active near top
  if (
    !currentSectionId &&
    window.scrollY < heroSection.offsetHeight - navbar.offsetHeight
  ) {
    currentSectionId = "home";
  }

  navLinks.forEach((link) => {
    link.classList.remove("active");
    const href = link.getAttribute("href");
    if (href === `#${currentSectionId}`) {
      link.classList.add("active");
    }
  });
  mobileNavLinks.forEach((link) => {
    // Update mobile links too
    link.classList.remove("active");
    const href = link.getAttribute("href");
    if (href === `#${currentSectionId}`) {
      link.classList.add("active");
    }
  });
}
window.addEventListener("scroll", handleScroll);
handleScroll(); // Initial check

// --- Mobile Menu ---
menuButton.addEventListener("click", () => {
  mobileMenu.classList.add("active");
  document.body.style.overflow = "hidden";
});
closeMenu.addEventListener("click", () => {
  mobileMenu.classList.remove("active");
  document.body.style.overflow = "";
});
mobileNavLinks.forEach((link) => {
  link.addEventListener("click", () => {
    mobileMenu.classList.remove("active");
    document.body.style.overflow = "";
  });
});

// --- Hero Section Animation (Three.js - Adjusted colors) ---
let heroScene, heroCamera, heroRenderer, heroParticles;

function initHeroAnimation() {
  const container = document.getElementById("heroCanvasContainer");
  if (!container) return;
  const canvas = document.getElementById("heroCanvas");
  heroScene = new THREE.Scene();
  heroCamera = new THREE.PerspectiveCamera(
    75,
    container.offsetWidth / container.offsetHeight,
    0.1,
    1000
  );
  heroCamera.position.z = 5;
  heroRenderer = new THREE.WebGLRenderer({
    canvas: canvas,
    alpha: true,
    antialias: true,
  }); // Added antialias
  heroRenderer.setSize(container.offsetWidth, container.offsetHeight);
  heroRenderer.setPixelRatio(window.devicePixelRatio);
  const particleCount = 5000;
  const positions = new Float32Array(particleCount * 3);
  const colors = new Float32Array(particleCount * 3);
  const color = new THREE.Color();
  for (let i = 0; i < particleCount; i++) {
    const i3 = i * 3;
    positions[i3] = (Math.random() - 0.5) * 20;
    positions[i3 + 1] = (Math.random() - 0.5) * 10;
    positions[i3 + 2] = (Math.random() - 0.5) * 10;
    color.setHSL(
      0.5 + Math.random() * 0.1,
      0.7,
      0.7 + Math.random() * 0.2
    ); /* Brighter particles for dark bg */
    colors[i3] = color.r;
    colors[i3 + 1] = color.g;
    colors[i3 + 2] = color.b;
  }
  const particlesGeometry = new THREE.BufferGeometry();
  particlesGeometry.setAttribute(
    "position",
    new THREE.BufferAttribute(positions, 3)
  );
  particlesGeometry.setAttribute("color", new THREE.BufferAttribute(colors, 3));
  const particleMaterial = new THREE.PointsMaterial({
    size: 0.04,
    vertexColors: true,
    transparent: true,
    opacity: 0.9,
    sizeAttenuation: true,
  });
  heroParticles = new THREE.Points(particlesGeometry, particleMaterial);
  heroScene.add(heroParticles);
  animateHero();
  window.addEventListener("resize", onHeroWindowResize, false);
}

function animateHero() {
  requestAnimationFrame(animateHero);
  const time = Date.now() * 0.0002;
  if (heroParticles) {
    heroParticles.rotation.y = time * 0.1;
    const positions = heroParticles.geometry.attributes.position.array;
    for (let i = 0; i < positions.length; i += 3) {
      positions[i + 1] += Math.sin(i * 0.1 + time * 2) * 0.002;
    }
    heroParticles.geometry.attributes.position.needsUpdate = true;
  }
  if (heroRenderer && heroScene && heroCamera)
    heroRenderer.render(heroScene, heroCamera);
}

function onHeroWindowResize() {
  const container = document.getElementById("heroCanvasContainer");
  if (!container || !heroCamera || !heroRenderer) return;
  heroCamera.aspect = container.offsetWidth / container.offsetHeight;
  heroCamera.updateProjectionMatrix();
  heroRenderer.setSize(container.offsetWidth, container.offsetHeight);
}
initHeroAnimation();

// --- About Us p5.js Background (Adjusted Colors) ---
// Keep this only if p5.js is needed elsewhere, otherwise remove the script tag and this code
let aboutSketch = function (p) {
  let blades = [];
  let wind = 0;
  class GrassBlade {
    /* ... (GrassBlade class) ... */
    constructor(x, y, h, w) {
      this.baseX = x;
      this.baseY = y;
      this.height = h;
      this.width = w;
      this.tipOffset = 0;
      this.bendFactor = p.random(0.5, 1.5);
      this.color = p.color(
        122,
        226,
        207,
        p.random(15, 40)
      ); /* More transparent */
    }
    update(windForce) {
      this.tipOffset =
        p.sin(windForce + this.baseX * 0.05) *
        this.height *
        0.1 *
        this.bendFactor;
    }
    display() {
      p.noStroke();
      p.fill(this.color);
      p.beginShape();
      p.vertex(this.baseX - this.width / 2, this.baseY);
      p.vertex(this.baseX + this.width / 2, this.baseY);
      p.vertex(this.baseX + this.tipOffset, this.baseY - this.height);
      p.endShape(p.CLOSE);
    }
  }
  p.setup = function () {
    let container = document.getElementById("aboutCanvasContainer");
    if (!container) return;
    let canvas = p.createCanvas(container.offsetWidth, container.offsetHeight);
    canvas.parent("aboutCanvas");
    for (let x = 0; x < p.width; x += p.random(5, 15)) {
      let h = p.random(p.height * 0.1, p.height * 0.3);
      let w = p.random(2, 5);
      blades.push(new GrassBlade(x, p.height, h, w));
    }
  };
  p.draw = function () {
    p.clear();
    wind += 0.02;
    for (let blade of blades) {
      blade.update(wind);
      blade.display();
    }
  };
  p.windowResized = function () {
    let container = document.getElementById("aboutCanvasContainer");
    if (!container) return;
    p.resizeCanvas(container.offsetWidth, container.offsetHeight);
    blades = [];
    for (let x = 0; x < p.width; x += p.random(5, 15)) {
      let h = p.random(p.height * 0.1, p.height * 0.3);
      let w = p.random(2, 5);
      blades.push(new GrassBlade(x, p.height, h, w));
    }
  };
};
if (typeof p5 !== "undefined") {
  // Check if p5 exists before creating sketch
  new p5(aboutSketch);
}

// --- Gallery Lightbox ---
galleryItems.forEach((item) => {
  item.addEventListener("click", () => {
    const imgSrc = item.querySelector(".gallery-image").getAttribute("src");
    if (imgSrc && lightboxImage && lightbox && lightboxClose) {
      lightboxImage.setAttribute("src", imgSrc);
      lightbox.classList.add("active");
      document.body.style.overflow = "hidden";
    }
  });
});
if (lightboxClose)
  lightboxClose.addEventListener("click", () => {
    lightbox.classList.remove("active");
    lightboxImage.setAttribute("src", "");
    document.body.style.overflow = "";
  });
if (lightbox)
  lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox) {
      lightbox.classList.remove("active");
      lightboxImage.setAttribute("src", "");
      document.body.style.overflow = "";
    }
  });

// --- Why Us & Package Animations (GSAP ScrollTrigger) ---
gsap.registerPlugin(ScrollTrigger);
whyUsItems.forEach((item, index) => {
  gsap.from(item, {
    scrollTrigger: {
      trigger: item,
      start: "top 85%",
      toggleActions: "play none none none",
    },
    opacity: 0,
    y: 50,
    duration: 0.6,
    delay: index * 0.1,
    ease: "power2.out",
  });
  const iconContainer = item.querySelector(".icon-container");
  if (iconContainer) {
    item.addEventListener("mouseenter", () =>
      gsap.to(iconContainer, {
        scale: 1.1,
        y: -5,
        duration: 0.3,
        ease: "back.out(1.7)",
      })
    );
    item.addEventListener("mouseleave", () =>
      gsap.to(iconContainer, {
        scale: 1,
        y: 0,
        duration: 0.3,
        ease: "back.out(1.7)",
      })
    );
  }
});
packageCards.forEach((card, index) => {
  gsap.from(card, {
    scrollTrigger: {
      trigger: card,
      start: "top 90%",
      toggleActions: "play none none none",
    },
    opacity: 0,
    y: 60,
    duration: 0.5,
    delay: (index % 4) * 0.1,
    ease: "power1.out",
  });
});

// --- Form Validation ---
function validateForm(form) {
  let isValid = true;
  const requiredInputs = form.querySelectorAll("[required]");
  const emailInputs = form.querySelectorAll('input[type="email"]');
  form
    .querySelectorAll(".form-input")
    .forEach((input) => input.classList.remove("error"));
  form
    .querySelectorAll(".error-message")
    .forEach((msg) => msg.classList.add("hidden"));
  form
    .querySelector("#formSuccessMessage, #contactFormSuccessMessage")
    ?.classList.add("hidden");
  form
    .querySelector("#formErrorMessage, #contactFormErrorMessage")
    ?.classList.add("hidden");

  requiredInputs.forEach((input) => {
    const errorMsg = form.querySelector(`#${input.id}Error`);
    let inputValid = false;
    if (input.type === "checkbox") inputValid = input.checked;
    else if (input.type === "radio") {
      const radioGroup = form.querySelectorAll(`input[name="${input.name}"]`);
      inputValid = Array.from(radioGroup).some((radio) => radio.checked);
    } else inputValid = input.value.trim() !== "";
    if (!inputValid) {
      isValid = false;
      input.classList.add("error");
      if (errorMsg) errorMsg.classList.remove("hidden");
    }
  });
  emailInputs.forEach((input) => {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const errorMsg = form.querySelector(`#${input.id}Error`);
    if (input.value.trim() !== "" && !emailPattern.test(input.value)) {
      isValid = false;
      input.classList.add("error");
      if (errorMsg) errorMsg.classList.remove("hidden");
    }
  });
  if (form.id === "bookingForm") {
    const checkin = form.querySelector("#checkin");
    const checkout = form.querySelector("#checkout");
    const dateOrderError = form.querySelector("#dateOrderError");
    const checkinError = form.querySelector("#checkinError");
    const today = new Date().toISOString().split("T")[0];
    if (
      checkin &&
      checkout &&
      checkin.value &&
      checkout.value &&
      checkout.value <= checkin.value
    ) {
      isValid = false;
      checkout.classList.add("error");
      if (dateOrderError) dateOrderError.classList.remove("hidden");
    }
    if (checkin && checkin.value && checkin.value < today) {
      isValid = false;
      checkin.classList.add("error");
      if (checkinError) {
        checkinError.textContent = "Check-in date cannot be in the past.";
        checkinError.classList.remove("hidden");
      }
    }
  }
  return isValid;
}
if (bookingForm)
  bookingForm.addEventListener("submit", function (e) {
    e.preventDefault();
    if (validateForm(this)) {
      console.log("Booking Form Data:", new FormData(this));
      this.querySelector("#formSuccessMessage")?.classList.remove("hidden");
      this.querySelector("#formErrorMessage")?.classList.add("hidden");
      this.reset();
    } else {
      this.querySelector("#formErrorMessage")?.classList.remove("hidden");
      this.querySelector("#formSuccessMessage")?.classList.add("hidden");
      console.log("Booking form validation failed");
    }
  });
if (contactForm)
  contactForm.addEventListener("submit", function (e) {
    e.preventDefault();
    if (validateForm(this)) {
      console.log("Contact Form Data:", new FormData(this));
      this.querySelector("#contactFormSuccessMessage")?.classList.remove(
        "hidden"
      );
      this.querySelector("#contactFormErrorMessage")?.classList.add("hidden");
      this.reset();
    } else {
      this.querySelector("#contactFormErrorMessage")?.classList.remove(
        "hidden"
      );
      this.querySelector("#contactFormSuccessMessage")?.classList.add("hidden");
      console.log("Contact form validation failed");
    }
  });

// --- Customer Reviews Swiper Carousel ---
var swiper = new Swiper(".progress-slide-carousel", {
  loop: true,
  grabCursor: true, // Add grab cursor
  slidesPerView: 1, // Show 1 slide on mobile
  spaceBetween: 30, // Space between slides
  breakpoints: {
    // when window width is >= 768px
    768: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    // when window width is >= 1024px
    1024: {
      slidesPerView: 3,
      spaceBetween: 40,
    },
  },
  autoplay: {
    delay: 3500, // Slower autoplay
    disableOnInteraction: false,
  },
  pagination: {
    el: ".progress-slide-carousel .swiper-pagination",
    type: "progressbar",
  },
  // Removed fraction option as progressbar is used
});

// -----------------------------------------
// --- Customer Reviews Swiper Carousel ---
var swiper = new Swiper(".progress-slide-carousel", {
  // Selects the HTML element
  loop: true, // Enables continuous looping
  grabCursor: true, // Shows grab cursor on hover
  slidesPerView: 1, // Default: Show 1 slide (mobile)
  spaceBetween: 30, // Space between slides
  breakpoints: {
    // when window width is >= 768px (md)
    768: {
      slidesPerView: 2, // Show 2 slides
      spaceBetween: 30,
    },
    // when window width is >= 1024px (lg)
    1024: {
      slidesPerView: 3, // Show 3 slides
      spaceBetween: 40,
    },
  },
  autoplay: {
    delay: 3500, // Autoplay delay in ms
    disableOnInteraction: false, // Autoplay continues after user interaction
  },
  pagination: {
    el: ".progress-slide-carousel .swiper-pagination", // Pagination element
    type: "progressbar", // Use progress bar type pagination
  },
});

// --- Reviews p5.js Background (Adjusted Colors) ---
// Keep this only if p5.js is needed elsewhere, otherwise remove the script tag and this code
let reviewsSketch = function (p) {
  let particles = [];
  class Particle {
    /* ... (Particle class) ... */
    constructor() {
      this.pos = p.createVector(p.random(p.width), p.random(p.height));
      this.vel = p.createVector(p.random(-0.3, 0.3), p.random(-0.3, 0.3));
      this.size = p.random(2, 4);
      this.color = p.color(
        122,
        226,
        207,
        p.random(10, 35)
      ); /* Very subtle alpha */
    } // Adjusted alpha
    update() {
      this.pos.add(this.vel);
      this.edges();
    }
    edges() {
      if (this.pos.x > p.width + this.size) this.pos.x = -this.size;
      if (this.pos.x < -this.size) this.pos.x = p.width + this.size;
      if (this.pos.y > p.height + this.size) this.pos.y = -this.size;
      if (this.pos.y < -this.size) this.pos.y = p.height + this.size;
    }
    show() {
      p.noStroke();
      p.fill(this.color);
      p.ellipse(this.pos.x, this.pos.y, this.size);
    }
  }
  p.setup = function () {
    let container = document.getElementById("reviewsCanvasContainer");
    if (!container) return;
    let canvas = p.createCanvas(container.offsetWidth, container.offsetHeight);
    canvas.parent("reviewsCanvas");
    for (let i = 0; i < 80; i++) particles.push(new Particle());
  };
  p.draw = function () {
    p.clear();
    for (let particle of particles) {
      particle.update();
      particle.show();
    }
  };
  p.windowResized = function () {
    let container = document.getElementById("reviewsCanvasContainer");
    if (!container) return;
    p.resizeCanvas(container.offsetWidth, container.offsetHeight);
    particles = [];
    for (let i = 0; i < 80; i++) particles.push(new Particle());
  };
};
if (typeof p5 !== "undefined") {
  // Check if p5 exists before creating sketch
  new p5(reviewsSketch);
}

// --- CountDown For Numbers
function animateCountUp(el, target, suffix = "", duration = 2000) {
  let start = 0;
  let startTime = null;

  function updateCount(currentTime) {
    if (!startTime) startTime = currentTime;
    const progress = currentTime - startTime;
    const rate = Math.min(progress / duration, 1);
    const value = Math.floor(rate * target);

    el.textContent = value + suffix;

    if (rate < 1) {
      requestAnimationFrame(updateCount);
    }
  }

  requestAnimationFrame(updateCount);
}

function initCountUpAnimations() {
  const counters = document.querySelectorAll(".count-up");
  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const target = parseInt(el.getAttribute("data-target"));
          const suffix = el.getAttribute("data-suffix") || "";
          animateCountUp(el, target, suffix);
          observer.unobserve(el); // animate only once
        }
      });
    },
    { threshold: 0.6 }
  );

  counters.forEach((counter) => observer.observe(counter));
}

// const swiper = new Swiper('.swiper', {
//     slidesPerView: 1,
//     spaceBetween: 10,
//     breakpoints: {
//       640: { slidesPerView: 2, spaceBetween: 15 },
//       768: { slidesPerView: 3, spaceBetween: 20 },
//       1024: { slidesPerView: 4, spaceBetween: 25 }
//     },
//     loop: true,
//     autoplay: {
//       delay: 3000,
//       disableOnInteraction: false
//     },
//     pagination: {
//       el: '.swiper-pagination',
//       clickable: true
//     }
//   });

document.addEventListener("DOMContentLoaded", initCountUpAnimations);

// Initialize scrollspy on load
document.addEventListener("DOMContentLoaded", handleScroll);
