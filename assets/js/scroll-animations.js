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
    // Check which page we're on
    const isAboutPage =
      window.location.pathname.includes("about.php") ||
      document.body.classList.contains("about-page");
    const isDestinationsPage =
      window.location.pathname.includes("destinations.php") ||
      document.body.classList.contains("destinations-page");

    if (isAboutPage) {
      // About page specific animations
      this.addAboutHeroAnimations();
      this.addCompanyStoryAnimations();
      this.addTeamSectionAnimations();
      this.addValuesSectionAnimations();
      this.addAboutCtaAnimations();
      this.addMediaHighlightsAnimations();
    } else if (isDestinationsPage) {
      // Destinations page specific animations
      this.addDestinationsHeroAnimations();
      this.addSearchSectionAnimations();
      this.addCountriesGridAnimations();
      this.addDestinationsCtaAnimations();
    } else {
      // Index page animations
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
    }

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

  // ========== ABOUT PAGE SPECIFIC ANIMATIONS ==========

  // 1. About Hero Section - Multi-stage reveal with counter animations
  addAboutHeroAnimations() {
    const section = document.querySelector(".about-hero");
    if (!section) return;

    section.setAttribute("data-animation", "about-hero-section");

    // Tagline
    const tagline = section.querySelector(".about-hero-tagline");
    if (tagline) {
      tagline.setAttribute("data-animation", "hero-tagline");
      tagline.style.opacity = "0";
      tagline.style.transform = "translateY(20px)";
    }

    // Title
    const title = section.querySelector(".about-hero-title");
    if (title) {
      title.setAttribute("data-animation", "hero-title");
      title.style.opacity = "0";
      title.style.transform = "translateY(40px)";
    }

    // Hero Image
    const heroImage = section.querySelector(".hero-image");
    if (heroImage) {
      heroImage.setAttribute("data-animation", "hero-image");
      heroImage.style.opacity = "0";
      heroImage.style.transform = "scale(0.9) translateY(30px)";
    }

    // Stats with counter animation
    const stats = section.querySelectorAll(".hero-stat-item");
    stats.forEach((stat, index) => {
      stat.setAttribute("data-animation", "hero-stat-counter");
      stat.setAttribute("data-delay", index * 150);
      stat.style.opacity = "0";
      stat.style.transform = "translateY(30px) scale(0.95)";
    });
  }

  // 2. Company Story Section - Alternating content with images
  addCompanyStoryAnimations() {
    const section = document.querySelector(".company-story-section");
    if (!section) return;

    section.setAttribute("data-animation", "company-story-section");

    // Story Header
    const header = section.querySelector(".story-header");
    if (header) {
      header.setAttribute("data-animation", "story-header");
      header.style.opacity = "0";
      header.style.transform = "translateY(40px)";
    }

    // Story Content blocks
    const storyContents = section.querySelectorAll(".story-content");
    storyContents.forEach((content, index) => {
      content.setAttribute("data-animation", "story-content");
      content.setAttribute("data-delay", index * 300);

      const textContent = content.querySelector(".story-text");
      const imageContent = content.querySelector(".story-image");

      if (textContent) {
        textContent.style.opacity = "0";
        textContent.style.transform = content.classList.contains("reverse")
          ? "translateX(60px)"
          : "translateX(-60px)";
      }

      if (imageContent) {
        imageContent.style.opacity = "0";
        imageContent.style.transform = content.classList.contains("reverse")
          ? "translateX(-60px)"
          : "translateX(60px)";
      }
    });

    // MVV Cards (Mission, Vision, Values)
    const mvvCards = section.querySelectorAll(".mvv-card");
    mvvCards.forEach((card, index) => {
      card.setAttribute("data-animation", "mvv-card");
      card.setAttribute("data-delay", index * 200);
      card.style.opacity = "0";
      card.style.transform = "translateY(50px) rotateX(20deg)";
    });
  }

  // 3. Team Section - Profile card animations
  addTeamSectionAnimations() {
    const section = document.querySelector(".team-section");
    if (!section) return;

    section.setAttribute("data-animation", "team-section");

    // Team Header
    const header = section.querySelector(".team-header");
    if (header) {
      header.setAttribute("data-animation", "team-header");
      header.style.opacity = "0";
      header.style.transform = "translateY(40px)";
    }

    // Team Members with staggered entrance
    const teamMembers = section.querySelectorAll(".team-member");
    teamMembers.forEach((member, index) => {
      member.setAttribute("data-animation", "team-member");
      member.setAttribute("data-delay", index * 250);
      member.style.opacity = "0";
      member.style.transform = "translateY(60px) scale(0.9)";

      // Member image specific animation
      const memberImage = member.querySelector(".member-image");
      if (memberImage) {
        memberImage.style.transform = "scale(1.1)";
      }
    });
  }

  // 4. Values Section - Grid animations with culture cards
  addValuesSectionAnimations() {
    const section = document.querySelector(".values-section");
    if (!section) return;

    section.setAttribute("data-animation", "values-section");

    // Values Header
    const header = section.querySelector(".values-header");
    if (header) {
      header.setAttribute("data-animation", "values-header");
      header.style.opacity = "0";
      header.style.transform = "translateY(40px)";
    }

    // Value Cards with dynamic grid animation
    const valueCards = section.querySelectorAll(".value-card");
    valueCards.forEach((card, index) => {
      card.setAttribute("data-animation", "value-card");
      card.setAttribute(
        "data-delay",
        Math.floor(index / 3) * 200 + (index % 3) * 150
      );
      card.style.opacity = "0";
      card.style.transform = "translateY(50px) rotateY(15deg)";
    });

    // Culture Section
    const cultureSection = section.querySelector(".culture-section");
    if (cultureSection) {
      const cultureHeader = cultureSection.querySelector(".culture-header");
      if (cultureHeader) {
        cultureHeader.setAttribute("data-animation", "culture-header");
        cultureHeader.style.opacity = "0";
        cultureHeader.style.transform = "translateY(40px)";
      }

      // Culture Cards
      const cultureCards = cultureSection.querySelectorAll(".culture-card");
      cultureCards.forEach((card, index) => {
        card.setAttribute("data-animation", "culture-card");
        card.setAttribute("data-delay", index * 200);
        card.style.opacity = "0";
        card.style.transform = "translateY(50px) scale(0.95)";
      });
    }
  }

  // 5. About CTA Section - Split animation with illustration
  addAboutCtaAnimations() {
    const section = document.querySelector(".about-cta-section");
    if (!section) return;

    section.setAttribute("data-animation", "about-cta-section");

    // CTA Image/Illustration
    const ctaImage = section.querySelector(".cta-image");
    if (ctaImage) {
      ctaImage.setAttribute("data-animation", "cta-image");
      ctaImage.style.opacity = "0";
      ctaImage.style.transform = "translateX(-50px) scale(0.95)";
    }

    // CTA Content
    const ctaContent = section.querySelector(".cta-content");
    if (ctaContent) {
      ctaContent.setAttribute("data-animation", "cta-content");
      ctaContent.style.opacity = "0";
      ctaContent.style.transform = "translateX(50px)";
    }

    // CTA Buttons
    const ctaButtons = section.querySelectorAll(
      ".cta-btn-primary, .cta-btn-secondary"
    );
    ctaButtons.forEach((button, index) => {
      button.setAttribute("data-animation", "cta-button");
      button.setAttribute("data-delay", index * 150);
      button.style.opacity = "0";
      button.style.transform = "translateY(20px)";
    });
  }

  // 6. Media Highlights Section - Logo wall with wave animation
  addMediaHighlightsAnimations() {
    const section = document.querySelector(".media-highlights-section");
    if (!section) return;

    section.setAttribute("data-animation", "media-highlights-section");

    // Media Header
    const header = section.querySelector(".media-highlights-header");
    if (header) {
      header.setAttribute("data-animation", "media-header");
      header.style.opacity = "0";
      header.style.transform = "translateY(40px)";
    }

    // Media Logo Items with wave effect
    const logoItems = section.querySelectorAll(".media-logo-item");
    logoItems.forEach((logo, index) => {
      logo.setAttribute("data-animation", "media-logo");
      logo.setAttribute(
        "data-delay",
        Math.floor(index / 5) * 100 + (index % 5) * 120
      );
      logo.style.opacity = "0";
      logo.style.transform = "translateY(40px) scale(0.8)";
    });
  }

  // ========== DESTINATIONS PAGE SPECIFIC ANIMATIONS ==========

  // 1. Destinations Hero Section - Breadcrumb and title reveal
  addDestinationsHeroAnimations() {
    const section = document.querySelector(".destinations-hero");
    if (!section) return;

    section.setAttribute("data-animation", "destinations-hero-section");

    // Breadcrumb navigation
    const breadcrumb = section.querySelector(".breadcrumb");
    if (breadcrumb) {
      breadcrumb.setAttribute("data-animation", "destinations-breadcrumb");
      breadcrumb.style.opacity = "0";
      breadcrumb.style.transform = "translateY(-20px)";
    }

    // Hero title
    const title = section.querySelector(".hero-title");
    if (title) {
      title.setAttribute("data-animation", "destinations-hero-title");
      title.style.opacity = "0";
      title.style.transform = "translateY(40px)";
    }
  }

  // 2. Search Section - Progressive reveal with interactive elements
  addSearchSectionAnimations() {
    const section = document.querySelector(".search-section");
    if (!section) return;

    section.setAttribute("data-animation", "search-section");

    // Search header/subtitle
    const searchHeader = section.querySelector(".search-header");
    if (searchHeader) {
      searchHeader.setAttribute("data-animation", "search-header");
      searchHeader.style.opacity = "0";
      searchHeader.style.transform = "translateY(30px)";
    }

    // Search box with sliding effect
    const searchBox = section.querySelector(".search-box");
    if (searchBox) {
      searchBox.setAttribute("data-animation", "search-box");
      searchBox.style.opacity = "0";
      searchBox.style.transform = "translateY(40px) scale(0.95)";
    }

    // Search stats
    const searchStats = section.querySelector(".search-stats");
    if (searchStats) {
      searchStats.setAttribute("data-animation", "search-stats");
      searchStats.style.opacity = "0";
      searchStats.style.transform = "translateY(20px)";
    }

    // Filter tags with staggered animation
    const filterTags = section.querySelectorAll(".filter-tag");
    filterTags.forEach((tag, index) => {
      tag.setAttribute("data-animation", "search-filter-tag");
      tag.setAttribute("data-delay", index * 100);
      tag.style.opacity = "0";
      tag.style.transform = "translateY(30px) scale(0.9)";
    });
  }

  // 3. Countries Grid Section - Dynamic card animations
  addCountriesGridAnimations() {
    const section = document.querySelector(".countries-section");
    if (!section) return;

    section.setAttribute("data-animation", "countries-grid-section");

    // Country cards with masonry-like staggered effect
    const countryCards = section.querySelectorAll(".country-card");
    countryCards.forEach((card, index) => {
      card.setAttribute("data-animation", "country-card");
      // Calculate stagger based on grid position (assuming 3 columns)
      const row = Math.floor(index / 3);
      const col = index % 3;
      const delay = row * 150 + col * 100;
      card.setAttribute("data-delay", delay);
      card.style.opacity = "0";
      card.style.transform = "translateY(60px) scale(0.95)";

      // Country flag with special animation
      const flag = card.querySelector(".country-flag");
      if (flag) {
        flag.style.transform = "scale(0.8) rotate(5deg)";
      }

      // Country actions buttons
      const actions = card.querySelectorAll(".country-actions .btn");
      actions.forEach((btn, btnIndex) => {
        btn.style.opacity = "0";
        btn.style.transform = "translateY(20px)";
      });
    });

    // No countries fallback message
    const noCountries = section.querySelector(".no-countries");
    if (noCountries) {
      noCountries.setAttribute("data-animation", "no-countries-message");
      noCountries.style.opacity = "0";
      noCountries.style.transform = "translateY(40px) scale(0.95)";
    }
  }

  // 4. Destinations CTA Section - Final call to action
  addDestinationsCtaAnimations() {
    const section = document.querySelector(".cta-section");
    if (!section) return;

    section.setAttribute("data-animation", "destinations-cta-section");

    // CTA title
    const title = section.querySelector(".cta-title");
    if (title) {
      title.setAttribute("data-animation", "destinations-cta-title");
      title.style.opacity = "0";
      title.style.transform = "translateY(40px)";
    }

    // CTA description
    const description = section.querySelector(".cta-description");
    if (description) {
      description.setAttribute(
        "data-animation",
        "destinations-cta-description"
      );
      description.style.opacity = "0";
      description.style.transform = "translateY(30px)";
    }

    // CTA buttons
    const buttons = section.querySelectorAll(".cta-buttons .btn");
    buttons.forEach((button, index) => {
      button.setAttribute("data-animation", "destinations-cta-button");
      button.setAttribute("data-delay", index * 150);
      button.style.opacity = "0";
      button.style.transform = "translateY(30px) scale(0.95)";
    });
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
      // Index page animations
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

      // About page animations
      case "hero-tagline":
        this.animateHeroTagline(element);
        break;
      case "hero-title":
        this.animateHeroTitle(element);
        break;
      case "hero-image":
        this.animateHeroImage(element);
        break;
      case "hero-stat-counter":
        this.animateHeroStatCounter(element);
        break;
      case "story-content":
        this.animateStoryContent(element);
        break;
      case "mvv-card":
        this.animateMvvCard(element);
        break;
      case "team-member":
        this.animateTeamMember(element);
        break;
      case "value-card":
        this.animateValueCard(element);
        break;
      case "culture-card":
        this.animateCultureCard(element);
        break;
      case "cta-image":
        this.animateCtaImage(element);
        break;
      case "cta-content":
        this.animateCtaContent(element);
        break;
      case "cta-button":
        this.animateCtaButton(element);
        break;
      case "media-logo":
        this.animateMediaLogo(element);
        break;

      // Destinations page animations
      case "destinations-breadcrumb":
        this.animateDestinationsBreadcrumb(element);
        break;
      case "destinations-hero-title":
        this.animateDestinationsHeroTitle(element);
        break;
      case "search-header":
        this.animateSearchHeader(element);
        break;
      case "search-box":
        this.animateSearchBox(element);
        break;
      case "search-stats":
        this.animateSearchStats(element);
        break;
      case "search-filter-tag":
        this.animateSearchFilterTag(element);
        break;
      case "country-card":
        this.animateCountryCard(element);
        break;
      case "no-countries-message":
        this.animateNoCountriesMessage(element);
        break;
      case "destinations-cta-title":
        this.animateDestinationsCtaTitle(element);
        break;
      case "destinations-cta-description":
        this.animateDestinationsCtaDescription(element);
        break;
      case "destinations-cta-button":
        this.animateDestinationsCtaButton(element);
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

  // ========== ABOUT PAGE ANIMATION METHODS ==========

  animateHeroTagline(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0)";
  }

  animateHeroTitle(element) {
    element.style.transition = "all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0)";
  }

  animateHeroImage(element) {
    element.style.transition = "all 1s cubic-bezier(0.34, 1.56, 0.64, 1)";
    element.style.opacity = "1";
    element.style.transform = "scale(1) translateY(0)";
  }

  animateHeroStatCounter(element) {
    element.style.transition =
      "all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) scale(1)";

    // Add counter animation for stats
    const numberElement = element.querySelector(".stat-number");
    if (numberElement) {
      this.animateCounter(numberElement);
    }
  }

  animateStoryContent(element) {
    element.style.transition = "all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)";

    const textContent = element.querySelector(".story-text");
    const imageContent = element.querySelector(".story-image");

    if (textContent) {
      textContent.style.transition =
        "all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
      textContent.style.opacity = "1";
      textContent.style.transform = "translateX(0)";
    }

    if (imageContent) {
      imageContent.style.transition =
        "all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
      imageContent.style.opacity = "1";
      imageContent.style.transform = "translateX(0)";
    }
  }

  animateMvvCard(element) {
    element.style.transition =
      "all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) rotateX(0)";
  }

  animateTeamMember(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) scale(1)";

    // Special image animation for team members
    const memberImage = element.querySelector(".member-image");
    if (memberImage) {
      memberImage.style.transition =
        "all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
      memberImage.style.transform = "scale(1)";
    }
  }

  animateValueCard(element) {
    element.style.transition =
      "all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) rotateY(0)";
  }

  animateCultureCard(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) scale(1)";
  }

  animateCtaImage(element) {
    element.style.transition = "all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateX(0) scale(1)";
  }

  animateCtaContent(element) {
    element.style.transition = "all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateX(0)";
  }

  animateCtaButton(element) {
    element.style.transition =
      "all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0)";
  }

  animateMediaLogo(element) {
    element.style.transition =
      "all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) scale(1)";
  }

  // ========== DESTINATIONS PAGE ANIMATION METHODS ==========

  animateDestinationsBreadcrumb(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0)";
  }

  animateDestinationsHeroTitle(element) {
    element.style.transition = "all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0)";
  }

  animateSearchHeader(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0)";
  }

  animateSearchBox(element) {
    element.style.transition = "all 1s cubic-bezier(0.34, 1.56, 0.64, 1)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) scale(1)";
  }

  animateSearchStats(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0)";
  }

  animateSearchFilterTag(element) {
    element.style.transition =
      "all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) scale(1)";
  }

  animateCountryCard(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) scale(1)";

    // Special flag animation
    const flag = element.querySelector(".country-flag");
    if (flag) {
      flag.style.transition = "all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
      flag.style.transform = "scale(1) rotate(0deg)";
    }

    // Animate action buttons with stagger
    const actions = element.querySelectorAll(".country-actions .btn");
    actions.forEach((btn, index) => {
      setTimeout(() => {
        btn.style.transition =
          "all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
        btn.style.opacity = "1";
        btn.style.transform = "translateY(0)";
      }, 200 + index * 100);
    });
  }

  animateNoCountriesMessage(element) {
    element.style.transition = "all 1s cubic-bezier(0.34, 1.56, 0.64, 1)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0) scale(1)";
  }

  animateDestinationsCtaTitle(element) {
    element.style.transition = "all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0)";
  }

  animateDestinationsCtaDescription(element) {
    element.style.transition = "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
    element.style.opacity = "1";
    element.style.transform = "translateY(0)";
  }

  animateDestinationsCtaButton(element) {
    element.style.transition =
      "all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
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
