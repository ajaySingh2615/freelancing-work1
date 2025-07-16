/**
 * MBBS Destinations Page JavaScript
 * Enhances interactivity and user experience
 */

document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('countrySearch');
    const countryCards = document.querySelectorAll('.country-card');
    const searchBtn = document.querySelector('.search-btn');
    const searchBox = document.querySelector('.search-box');
    const searchClear = document.getElementById('searchClear');
    const searchSuggestions = document.getElementById('searchSuggestions');
    const resultCount = document.getElementById('resultCount');
    const filterTags = document.querySelectorAll('.filter-tag');
    
    let activeFilter = 'all';
    let currentSearchTerm = '';
    
    // Search suggestions data
    const suggestions = [
        { text: 'Russia', type: 'country', icon: 'fas fa-flag' },
        { text: 'Georgia', type: 'country', icon: 'fas fa-flag' },
        { text: 'Kazakhstan', type: 'country', icon: 'fas fa-flag' },
        { text: 'Egypt', type: 'country', icon: 'fas fa-flag' },
        { text: 'Nepal', type: 'country', icon: 'fas fa-flag' },
        { text: 'China', type: 'country', icon: 'fas fa-flag' },
        { text: 'Germany', type: 'country', icon: 'fas fa-flag' },
        { text: 'Italy', type: 'country', icon: 'fas fa-flag' },
        { text: 'Poland', type: 'country', icon: 'fas fa-flag' },
        { text: 'Belarus', type: 'country', icon: 'fas fa-flag' },
        { text: 'Latvia', type: 'country', icon: 'fas fa-flag' },
        { text: 'Uzbekistan', type: 'country', icon: 'fas fa-flag' },
        { text: 'MBBS', type: 'program', icon: 'fas fa-graduation-cap' },
        { text: 'Medicine', type: 'program', icon: 'fas fa-stethoscope' },
        { text: 'Medical University', type: 'university', icon: 'fas fa-university' },
        { text: 'Budget friendly', type: 'feature', icon: 'fas fa-dollar-sign' },
        { text: 'Popular destination', type: 'feature', icon: 'fas fa-fire' },
        { text: 'Europe', type: 'region', icon: 'fas fa-map-marker-alt' },
        { text: 'Asia', type: 'region', icon: 'fas fa-map-marker-alt' }
    ];
    
    // Enhanced search functionality
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentSearchTerm = this.value.toLowerCase();
            
            // Show/hide clear button
            if (currentSearchTerm.length > 0) {
                searchClear.classList.add('show');
            } else {
                searchClear.classList.remove('show');
            }
            
            // Show suggestions
            showSuggestions(currentSearchTerm);
            
            // Perform search
            performSearch();
        });
        
        // Focus and blur events for suggestions
        searchInput.addEventListener('focus', function() {
            if (currentSearchTerm.length > 0) {
                showSuggestions(currentSearchTerm);
            }
        });
        
        searchInput.addEventListener('blur', function() {
            // Delay hiding suggestions to allow clicking
            setTimeout(() => {
                hideSuggestions();
            }, 200);
        });
    }
    
    // Clear search functionality
    if (searchClear) {
        searchClear.addEventListener('click', function() {
            searchInput.value = '';
            currentSearchTerm = '';
            searchClear.classList.remove('show');
            hideSuggestions();
            performSearch();
            searchInput.focus();
        });
    }
    
    // Search button functionality
    if (searchBtn) {
        searchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            performSearch();
            hideSuggestions();
        });
    }
    
    // Filter functionality
    filterTags.forEach(tag => {
        tag.addEventListener('click', function() {
            // Remove active class from all tags
            filterTags.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked tag
            this.classList.add('active');
            
            // Set active filter
            activeFilter = this.dataset.filter;
            
            // Perform search with current filter
            performSearch();
        });
    });
    
    // Set initial active filter
    filterTags[0].classList.add('active');
    
    // Enhanced search function
    function performSearch() {
        let visibleCards = 0;
        
        // Add loading state
        searchBox.classList.add('loading');
        
        // Simulate search delay for better UX
        setTimeout(() => {
            countryCards.forEach(card => {
                const countryName = card.querySelector('.country-name').textContent.toLowerCase();
                const countryDescription = card.querySelector('.country-description').textContent.toLowerCase();
                const studentsCount = card.querySelector('.students-count').textContent.toLowerCase();
                const region = card.dataset.region;
                const categories = card.dataset.category ? card.dataset.category.split(',') : [];
                
                let matchesSearch = true;
                let matchesFilter = true;
                
                // Check search term
                if (currentSearchTerm.length > 0) {
                    matchesSearch = countryName.includes(currentSearchTerm) || 
                                   countryDescription.includes(currentSearchTerm) ||
                                   studentsCount.includes(currentSearchTerm);
                }
                
                // Check filter
                if (activeFilter !== 'all') {
                    if (activeFilter === 'europe' || activeFilter === 'asia') {
                        matchesFilter = region === activeFilter;
                    } else {
                        matchesFilter = categories.includes(activeFilter);
                    }
                }
                
                if (matchesSearch && matchesFilter) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.3s ease-in-out';
                    visibleCards++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Update result count
            updateResultCount(visibleCards);
            
            // Show no results message
            showNoResultsMessage(visibleCards === 0 && (currentSearchTerm.length > 0 || activeFilter !== 'all'));
            
            // Remove loading state
            searchBox.classList.remove('loading');
        }, 300);
    }
    
    // Show suggestions function
    function showSuggestions(searchTerm) {
        if (searchTerm.length === 0) {
            hideSuggestions();
            return;
        }
        
        const filteredSuggestions = suggestions.filter(suggestion => 
            suggestion.text.toLowerCase().includes(searchTerm)
        ).slice(0, 6);
        
        if (filteredSuggestions.length === 0) {
            hideSuggestions();
            return;
        }
        
        let suggestionsHTML = '';
        filteredSuggestions.forEach(suggestion => {
            const highlightedText = suggestion.text.replace(
                new RegExp(`(${searchTerm})`, 'gi'), 
                '<span class="suggestion-match">$1</span>'
            );
            
            suggestionsHTML += `
                <div class="suggestion-item" data-suggestion="${suggestion.text}">
                    <i class="${suggestion.icon} suggestion-icon"></i>
                    <span class="suggestion-text">${highlightedText}</span>
                </div>
            `;
        });
        
        searchSuggestions.innerHTML = suggestionsHTML;
        searchSuggestions.classList.add('show');
        
        // Add click event to suggestions
        searchSuggestions.querySelectorAll('.suggestion-item').forEach(item => {
            item.addEventListener('click', function() {
                const suggestionText = this.dataset.suggestion;
                searchInput.value = suggestionText;
                currentSearchTerm = suggestionText.toLowerCase();
                searchClear.classList.add('show');
                hideSuggestions();
                performSearch();
            });
        });
    }
    
    // Hide suggestions function
    function hideSuggestions() {
        searchSuggestions.classList.remove('show');
    }
    
    // Update result count function
    function updateResultCount(count) {
        const countText = count === 1 ? '1 Country' : `${count} Countries`;
        resultCount.textContent = countText;
    }
    
    // Country card animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeIn 0.6s ease-in-out';
                entry.target.style.opacity = '1';
            }
        });
    }, observerOptions);
    
    // Observe all country cards
    countryCards.forEach(card => {
        card.style.opacity = '0';
        observer.observe(card);
    });
    
    // Button hover effects
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Country cards hover effects
    countryCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
            this.style.boxShadow = '0 12px 24px rgba(0, 0, 0, 0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 4px 10px rgba(0, 0, 0, 0.1)';
        });
    });
    
    // Track button clicks for analytics
    const trackButtons = document.querySelectorAll('.btn[data-track]');
    trackButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.dataset.track;
            const country = this.closest('.country-card').dataset.country;
            
            // Analytics tracking (replace with your analytics code)
            console.log(`Button clicked: ${action} for country: ${country}`);
            
            // You can add Google Analytics or other tracking here
            if (typeof gtag !== 'undefined') {
                gtag('event', 'click', {
                    'event_category': 'Destinations',
                    'event_label': `${action} - ${country}`,
                    'value': 1
                });
            }
        });
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Enhanced keyboard navigation
    document.addEventListener('keydown', function(e) {
        // Escape key clears search and hides suggestions
        if (e.key === 'Escape' && searchInput === document.activeElement) {
            searchInput.value = '';
            currentSearchTerm = '';
            searchClear.classList.remove('show');
            hideSuggestions();
            performSearch();
            searchInput.blur();
        }
        
        // Enter key performs search
        if (e.key === 'Enter' && searchInput === document.activeElement) {
            e.preventDefault();
            hideSuggestions();
            performSearch();
            
            // Focus on first visible card if search has results
            setTimeout(() => {
                const firstVisibleCard = document.querySelector('.country-card[style*="display: block"], .country-card:not([style*="display: none"])');
                if (firstVisibleCard) {
                    firstVisibleCard.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }, 400);
        }
        
        // Arrow key navigation for suggestions
        if (e.key === 'ArrowDown' && searchSuggestions.classList.contains('show')) {
            e.preventDefault();
            const suggestions = searchSuggestions.querySelectorAll('.suggestion-item');
            const currentActive = searchSuggestions.querySelector('.suggestion-item.active');
            
            if (currentActive) {
                currentActive.classList.remove('active');
                const nextSuggestion = currentActive.nextElementSibling || suggestions[0];
                nextSuggestion.classList.add('active');
            } else {
                suggestions[0].classList.add('active');
            }
        }
        
        if (e.key === 'ArrowUp' && searchSuggestions.classList.contains('show')) {
            e.preventDefault();
            const suggestions = searchSuggestions.querySelectorAll('.suggestion-item');
            const currentActive = searchSuggestions.querySelector('.suggestion-item.active');
            
            if (currentActive) {
                currentActive.classList.remove('active');
                const prevSuggestion = currentActive.previousElementSibling || suggestions[suggestions.length - 1];
                prevSuggestion.classList.add('active');
            } else {
                suggestions[suggestions.length - 1].classList.add('active');
            }
        }
        
        // Enter key on active suggestion
        if (e.key === 'Enter' && searchSuggestions.classList.contains('show')) {
            const activeSuggestion = searchSuggestions.querySelector('.suggestion-item.active');
            if (activeSuggestion) {
                e.preventDefault();
                activeSuggestion.click();
            }
        }
    });
    
    // Performance optimization: Debounce search
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Apply debounce to search if needed for large datasets
    if (countryCards.length > 20) {
        const debouncedSearch = debounce(function() {
            searchInput.dispatchEvent(new Event('input'));
        }, 300);
        
        searchInput.removeEventListener('input', debouncedSearch);
        searchInput.addEventListener('input', debouncedSearch);
    }
    
    // Add loading skeleton for better UX
    function showLoadingSkeleton() {
        const skeleton = document.createElement('div');
        skeleton.className = 'loading-skeleton';
        skeleton.innerHTML = `
            <div class="skeleton-card">
                <div class="skeleton-header">
                    <div class="skeleton-flag"></div>
                    <div class="skeleton-info">
                        <div class="skeleton-name"></div>
                        <div class="skeleton-count"></div>
                    </div>
                </div>
                <div class="skeleton-content">
                    <div class="skeleton-text"></div>
                    <div class="skeleton-text"></div>
                    <div class="skeleton-buttons"></div>
                </div>
            </div>
        `;
        return skeleton;
    }
    
    // Show/hide no results message
    function showNoResultsMessage(show) {
        let noResultsMsg = document.querySelector('.no-results-message');
        
        if (show && !noResultsMsg) {
            noResultsMsg = document.createElement('div');
            noResultsMsg.className = 'no-results-message';
            noResultsMsg.innerHTML = `
                <div class="no-results-content">
                    <i class="fas fa-search"></i>
                    <h3>No countries found</h3>
                    <p>Try adjusting your search terms or browse all destinations below.</p>
                </div>
            `;
            document.querySelector('.countries-grid').appendChild(noResultsMsg);
        } else if (!show && noResultsMsg) {
            noResultsMsg.remove();
        }
    }
    
    // Initialize tooltips for flag icons
    const flagIcons = document.querySelectorAll('.flag-icon');
    flagIcons.forEach(flag => {
        flag.setAttribute('title', flag.parentElement.nextElementSibling.querySelector('.country-name').textContent);
    });
    
    // Add click to copy functionality for country information
    const countryNames = document.querySelectorAll('.country-name');
    countryNames.forEach(name => {
        name.addEventListener('click', function() {
            const countryInfo = this.closest('.country-card').querySelector('.country-description').textContent;
            navigator.clipboard.writeText(countryInfo).then(() => {
                // Show temporary notification
                showNotification('Country information copied to clipboard!');
            });
        });
    });
    
    // Show notification function
    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }
    
    // Initialize page
    console.log('MBBS Destinations page initialized');
    
    // Initialize search functionality
    updateResultCount(countryCards.length);
    performSearch(); // Initial search to set up the page
    
    // Add some additional CSS for JavaScript enhancements
    const style = document.createElement('style');
    style.textContent = `
        .no-results-message {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            background: var(--white);
            border-radius: var(--medium-radius);
            box-shadow: var(--medium-shadow);
        }
        
        .no-results-content i {
            font-size: 3rem;
            color: var(--light-text);
            margin-bottom: 1rem;
        }
        
        .no-results-content h3 {
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }
        
        .no-results-content p {
            color: var(--light-text);
        }
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--primary-color);
            color: var(--white);
            padding: 1rem 1.5rem;
            border-radius: var(--medium-radius);
            box-shadow: var(--large-shadow);
            z-index: 1000;
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.3s ease;
        }
        
        .notification.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .search-box.loading .search-btn i {
            animation: spin 1s linear infinite;
        }
        
        .suggestion-item.active {
            background: var(--light-bg);
            color: var(--primary-color);
        }
        
        .suggestion-item.active .suggestion-icon {
            color: var(--primary-color);
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .search-box.loading {
            animation: pulse 1.5s ease-in-out infinite;
        }
    `;
    document.head.appendChild(style);
}); 