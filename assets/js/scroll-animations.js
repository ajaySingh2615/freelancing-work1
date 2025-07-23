/**
 * Scroll-Based Animations for Sunrise Global Education
 * Advanced scroll animations using Intersection Observer API
 * and CSS transforms for smooth, performant animations
 */

class ScrollAnimations {
  constructor() {
    this.observerOptions = {
      threshold: [0.1, 0.3, 0.6],
      rootMargin: "-50px 0px -50px 0px",
    };

    this.observer = new IntersectionObserver(
      this.handleIntersection.bind(this),
      this.observerOptions
    );

    this.animatedElements = new Set();
    this.init();
  }

  init() {
    // Wait for DOM to be ready
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", () =>
        this.setupAnimations()
      );
    } else {
      this.setupAnimations();
    }
  }

  setupAnimations() {
    this.addMediaPartnersAnimations();
    this.addAboutSectionAnimations();
    this.addDestinationsAnimations();
    this.addServicesAnimations();
    this.addUniversitiesAnimations();
    this.addWhyChooseUsAnimations();
    this.addWorkingProcessAnimations();
    this.addTestimonialAnimations();
    this.addBlogSectionAnimations();
    this.addContactSectionAnimations();
    this.addStickyButtonAnimation();
    this.startObserving();
  }

  // 1. Media Partners Section - Staggered fade-in with slide up
  addMediaPartnersAnimations() {
    const section = document.querySelector(".media-partners-section");
    if (!section) return;

    section.setAttribute("data-animation", "media-partners");

    const partners = section.querySelectorAll(".media-partner-item");
    partners.forEach((partner, index) => {
      partner.setAttribute("data-animation", "partner-item");
      partner.setAttribute("data-delay", index * 150);
      partner.style.opacity = "0";
      partner.style.transform = "translateY(30px)";
    });
  }

  // 2. About Section - Multi-stage reveal
  addAboutSectionAnimations() {
    const section = document.querySelector(".about-section");
    if (!section) return;

    section.setAttribute("data-animation", "about-section");

    // Title animation
    const title = section.querySelector(".about-question");
    if (title) {
      title.setAttribute("data-animation", "title-reveal");
      title.style.opacity = "0";
      title.style.transform = "translateY(40px)";
    }

    // Intro text
    const intro = section.querySelector(".about-intro");
    if (intro) {
      intro.setAttribute("data-animation", "intro-fade");
      intro.style.opacity = "0";
      intro.style.transform = "translateY(30px)";
    }

    // Highlight cards with stagger
    const cards = section.querySelectorAll(".highlight-card");
    cards.forEach((card, index) => {
      card.setAttribute("data-animation", "highlight-card");
      card.setAttribute("data-delay", index * 200);
      card.style.opacity = "0";
      card.style.transform = "translateY(40px) scale(0.95)";
    });

    // Action buttons
    const actions = section.querySelector(".about-actions");
    if (actions) {
      actions.setAttribute("data-animation", "actions-reveal");
      actions.style.opacity = "0";
      actions.style.transform = "translateY(30px)";
    }
  }

  // 3. Study Destinations - Dynamic grid animation
  addDestinationsAnimations() {
    const section = document.querySelector(".study-destinations-section");
    if (!section) return;

    section.setAttribute("data-animation", "destinations-section");

    // Title
    const title = section.querySelector(".destinations-question");
    if (title) {
      title.setAttribute("data-animation", "title-slide-up");
      title.style.opacity = "0";
      title.style.transform = "translateY(50px)";
    }

    // Destination items with wave effect
    const destinations = section.querySelectorAll(".destination-item");
    destinations.forEach((dest, index) => {
      dest.setAttribute("data-animation", "destination-item");
      dest.setAttribute(
        "data-delay",
        Math.floor(index / 4) * 100 + (index % 4) * 150
      );
      dest.style.opacity = "0";
      dest.style.transform = "translateY(40px) scale(0.9)";
    });

    // View all link
    const viewAll = section.querySelector(".view-all-link");
    if (viewAll) {
      viewAll.setAttribute("data-animation", "view-all-bounce");
      viewAll.style.opacity = "0";
      viewAll.style.transform = "translateY(30px)";
    }
  }

  // 4. Services Section - Split animation
  addServicesAnimations() {
    const section = document.querySelector(".services-section");
    if (!section) return;

    section.setAttribute("data-animation", "services-section");

    // Header
    const header = section.querySelector(".services-header");
    if (header) {
      header.setAttribute("data-animation", "header-fade-up");
      header.style.opacity = "0";
      header.style.transform = "translateY(40px)";
    }

    // Left services
    const leftServices = section.querySelectorAll(
      ".services-left .service-group"
    );
    leftServices.forEach((service, index) => {
      service.setAttribute("data-animation", "service-slide-right");
      service.setAttribute("data-delay", index * 300);
      service.style.opacity = "0";
      service.style.transform = "translateX(-60px)";
    });

    // Center image
    const centerImage = section.querySelector(".services-image");
    if (centerImage) {
      centerImage.setAttribute("data-animation", "image-zoom-in");
      centerImage.style.opacity = "0";
      centerImage.style.transform = "scale(0.8)";
    }

    // Right services
    const rightServices = section.querySelectorAll(
      ".services-right .service-group"
    );
    rightServices.forEach((service, index) => {
      service.setAttribute("data-animation", "service-slide-left");
      service.setAttribute("data-delay", index * 300);
      service.style.opacity = "0";
      service.style.transform = "translateX(60px)";
    });
  }

  // 5. Universities Section - Logo wall animation
  addUniversitiesAnimations() {
    const section = document.querySelector(".universities-section");
    if (!section) return;

    section.setAttribute("data-animation", "universities-section");

    // Title
    const title = section.querySelector(".section-heading h2");
    if (title) {
      title.setAttribute("data-animation", "title-typewriter");
      title.style.opacity = "0";
    }

    // Logo items with matrix effect
    const logos = section.querySelectorAll(".logo-item");
    logos.forEach((logo, index) => {
      logo.setAttribute("data-animation", "logo-matrix");
      logo.setAttribute(
        "data-delay",
        Math.floor(index / 4) * 200 + (index % 4) * 100
      );
      logo.style.opacity = "0";
      logo.style.transform = "rotateY(90deg) scale(0.5)";
    });

    // Action buttons
    const actions = section.querySelector(".universities-actions");
    if (actions) {
      actions.setAttribute("data-animation", "actions-slide-up");
      actions.style.opacity = "0";
      actions.style.transform = "translateY(40px)";
    }
  }

  // 6. Why Choose Us Section - Card flip animations
  addWhyChooseUsAnimations() {
    const section = document.querySelector(".why-choose-us-section");
    if (!section) return;

    section.setAttribute("data-animation", "why-choose-section");

    // Title
    const title = section.querySelector(".why-choose-us-title");
    if (title) {
      title.setAttribute("data-animation", "title-glow");
      title.style.opacity = "0";
      title.style.transform = "translateY(30px)";
    }

    // Benefit cards with flip effect
    const cards = section.querySelectorAll(".benefit-card");
    cards.forEach((card, index) => {
      card.setAttribute("data-animation", "benefit-card-flip");
      card.setAttribute("data-delay", index * 250);
      card.style.opacity = "0";
      card.style.transform = "rotateX(-90deg)";
    });

    // Benefits image
    const image = section.querySelector(".benefits-image");
    if (image) {
      image.setAttribute("data-animation", "image-slide-left");
      image.style.opacity = "0";
      image.style.transform = "translateX(80px)";
    }
  }

  // 7. Working Process Section - Sequential step animation
  addWorkingProcessAnimations() {
    const section = document.querySelector(".working-process-section");
    if (!section) return;

    section.setAttribute("data-animation", "process-section");

    // Header
    const header = section.querySelector(".process-header");
    if (header) {
      header.setAttribute("data-animation", "header-reveal");
      header.style.opacity = "0";
      header.style.transform = "translateY(40px)";
    }

    // Process steps with connecting lines
    const steps = section.querySelectorAll(".process-step");
    const arrows = section.querySelectorAll(".process-arrow");

    steps.forEach((step, index) => {
      step.setAttribute("data-animation", "process-step");
      step.setAttribute("data-delay", index * 500);
      step.style.opacity = "0";
      step.style.transform = "translateY(60px) scale(0.8)";
    });

    arrows.forEach((arrow, index) => {
      arrow.setAttribute("data-animation", "process-arrow");
      arrow.setAttribute("data-delay", (index + 1) * 500 + 200);
      arrow.style.opacity = "0";
      arrow.style.transform = "scaleX(0)";
    });
  }

  // 8. Testimonial Section - Split reveal
  addTestimonialAnimations() {
    const section = document.querySelector(".testimonial-section");
    if (!section) return;

    section.setAttribute("data-animation", "testimonial-section");

    // Left content
    const leftContent = section.querySelector(".testimonial-left");
    if (leftContent) {
      leftContent.setAttribute("data-animation", "testimonial-left");
      leftContent.style.opacity = "0";
      leftContent.style.transform = "translateX(-50px)";
    }

    // Right image
    const rightImage = section.querySelector(".testimonial-right");
    if (rightImage) {
      rightImage.setAttribute("data-animation", "testimonial-right");
      rightImage.style.opacity = "0";
      rightImage.style.transform = "translateX(50px) scale(0.9)";
    }

    // Stats with counter animation
    const stats = section.querySelectorAll(".stat-item");
    stats.forEach((stat, index) => {
      stat.setAttribute("data-animation", "stat-counter");
      stat.setAttribute("data-delay", index * 300);
      stat.style.opacity = "0";
      stat.style.transform = "translateY(30px)";
    });
  }

  // 9. Blog/News Sections - Card cascade
  addBlogSectionAnimations() {
    const blogSections = document.querySelectorAll(
      ".blog-section, .news-section"
    );

    blogSections.forEach((section) => {
      section.setAttribute("data-animation", "blog-section");

      // Header
      const header = section.querySelector(".section-header, .news-header");
      if (header) {
        header.setAttribute("data-animation", "blog-header");
        header.style.opacity = "0";
        header.style.transform = "translateY(40px)";
      }

      // Blog/News cards
      const cards = section.querySelectorAll(".blog-card, .news-card");
      cards.forEach((card, index) => {
        card.setAttribute("data-animation", "blog-card");
        card.setAttribute("data-delay", index * 200);
        card.style.opacity = "0";
        card.style.transform = "translateY(50px) rotateX(20deg)";
      });
    });
  }

  // 10. Contact Section - Smooth reveal
  addContactSectionAnimations() {
    const section = document.querySelector(".contact-section");
    if (!section) return;

    section.setAttribute("data-animation", "contact-section");

    // Contact image
    const image = section.querySelector(".contact-image");
    if (image) {
      image.setAttribute("data-animation", "contact-image");
      image.style.opacity = "0";
      image.style.transform = "translateX(-40px)";
    }

    // Contact content
    const content = section.querySelector(".contact-content");
    if (content) {
      content.setAttribute("data-animation", "contact-content");
      content.style.opacity = "0";
      content.style.transform = "translateX(40px)";
    }
  }

  // 11. Sticky Button - Entrance animation
  addStickyButtonAnimation() {
    const stickyBtn = document.querySelector(".sticky-consultation");
    if (stickyBtn) {
      stickyBtn.setAttribute("data-animation", "sticky-entrance");
      stickyBtn.style.opacity = "0";
      stickyBtn.style.transform = "translateY(100px)";
    }
  }

  // Intersection Observer Handler
  handleIntersection(entries) {
    entries.forEach((entry) => {
      if (entry.isIntersecting && entry.intersectionRatio >= 0.1) {
        this.animateElement(entry.target);
      }
    });
  }

  // Start observing all animated elements
  startObserving() {
    const animatedElements = document.querySelectorAll("[data-animation]");
    animatedElements.forEach((element) => {
      this.observer.observe(element);
    });
  }

  // Animate individual elements
  animateElement(element) {
    if (this.animatedElements.has(element)) return;

    this.animatedElements.add(element);
    const animationType = element.getAttribute("data-animation");
    const delay = parseInt(element.getAttribute("data-delay")) || 0;

    setTimeout(() => {
      element.classList.add("animate-in");
      this.triggerSpecificAnimation(element, animationType);
    }, delay);
  }

  // Trigger specific animations based on type
  triggerSpecificAnimation(element, type) {
    switch (type) {
      case "partner-item":
        this.animatePartnerItem(element);
        break;
      case "title-reveal":
        this.animateTitleReveal(element);
        break;
      case "highlight-card":
        this.animateHighlightCard(element);
        break;
      case "destination-item":
        this.animateDestinationItem(element);
        break;
      case "service-slide-right":
        this.animateServiceSlideRight(element);
        break;
      case "service-slide-left":
        this.animateServiceSlideLeft(element);
        break;
      case "logo-matrix":
        this.animateLogoMatrix(element);
        break;
      case "benefit-card-flip":
        this.animateBenefitCardFlip(element);
        break;
      case "process-step":
        this.animateProcessStep(element);
        break;
      case "process-arrow":
        this.animateProcessArrow(element);
        break;
      case "stat-counter":
        this.animateStatCounter(element);
        break;
      case "blog-card":
        this.animateBlogCard(element);
        break;
      default:
        this.animateDefault(element);
    }
  }

  // Individual animation methods
  animatePartnerItem(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0)";
  }

  animateTitleReveal(element) {
    element.style.transition = "all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0)";
  }

  animateHighlightCard(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) scale(1)";
  }

  animateDestinationItem(element) {
    element.style.transition =
      "all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) scale(1)";
  }

  animateServiceSlideRight(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateX(0)";
  }

  animateServiceSlideLeft(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateX(0)";
  }

  animateLogoMatrix(element) {
    element.style.transition =
      "all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
    element.style.opacity = "1";
    element.style.transform = "rotateY(0) scale(1)";
  }

  animateBenefitCardFlip(element) {
    element.style.transition =
      "all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
    element.style.opacity = "1";
    element.style.transform = "rotateX(0)";
  }

  animateProcessStep(element) {
    element.style.transition = "all 1s cubic-bezier(0.34, 1.56, 0.64, 1)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) scale(1)";
  }

  animateProcessArrow(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "scaleX(1)";
  }

  animateStatCounter(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0)";

    // Add counter animation
    const numberElement = element.querySelector(".stat-number");
    if (numberElement) {
      this.animateCounter(numberElement);
    }
  }

  animateBlogCard(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) rotateX(0)";
  }

  animateDefault(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) scale(1)";
  }

  // Counter animation for stats
  animateCounter(element) {
    const target = parseInt(element.textContent.replace(/\D/g, ""));
    const duration = 2000;
    const increment = target / (duration / 16);
    let current = 0;

    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        element.textContent =
          target + (element.textContent.includes("+") ? "+" : "");
        clearInterval(timer);
      } else {
        element.textContent =
          Math.floor(current) + (element.textContent.includes("+") ? "+" : "");
      }
    }, 16);
  }
}

// Initialize animations when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
  new ScrollAnimations();
});

// Export for external use
window.ScrollAnimations = ScrollAnimations;
