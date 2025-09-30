/**
 * Searchable Dropdown Component
 * Makes any select element searchable by typing letters to filter options
 */
class SearchableDropdown {
    constructor(selectElement) {
        this.select = selectElement;
        this.originalOnChange = this.select.onchange;
        this.searchTerm = '';
        this.searchTimeout = null;
        this.init();
    }

    init() {
        // Store original options
        this.allOptions = Array.from(this.select.options).map(opt => ({
            value: opt.value,
            text: opt.text,
            element: opt,
            hands: opt.getAttribute('data-hands'),
            usableBy: opt.getAttribute('data-usable-by')
        }));

        // Add event listeners
        this.select.addEventListener('keydown', (e) => this.handleKeyDown(e));
        this.select.addEventListener('focus', () => this.resetSearch());
    }

    handleKeyDown(e) {
        // Allow normal navigation keys
        if (['ArrowUp', 'ArrowDown', 'Enter', 'Escape', 'Tab'].includes(e.key)) {
            if (e.key === 'Escape') {
                this.resetSearch();
            }
            return;
        }

        // Handle letter/number input for searching
        if (e.key.length === 1) {
            e.preventDefault();
            this.searchTerm += e.key.toLowerCase();
            this.filterOptions();

            // Clear search term after 1 second of no typing
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.resetSearch();
            }, 1000);
        } else if (e.key === 'Backspace') {
            e.preventDefault();
            this.searchTerm = this.searchTerm.slice(0, -1);
            this.filterOptions();
        }
    }

    filterOptions() {
        if (!this.searchTerm) {
            this.showAllOptions();
            return;
        }

        // Filter options based on search term
        const filtered = this.allOptions.filter(opt => 
            opt.text.toLowerCase().includes(this.searchTerm)
        );

        // Clear current options (except first one which is usually the placeholder)
        while (this.select.options.length > 1) {
            this.select.remove(1);
        }

        // Add filtered options
        filtered.forEach((opt, index) => {
            if (index === 0 && opt.value === '0') return; // Skip placeholder if it's in filtered results
            
            const option = document.createElement('option');
            option.value = opt.value;
            option.text = opt.text;
            if (opt.hands) option.setAttribute('data-hands', opt.hands);
            if (opt.usableBy) option.setAttribute('data-usable-by', opt.usableBy);
            this.select.add(option);
        });

        // Auto-select first filtered result if available
        if (filtered.length > 0) {
            const firstNonPlaceholder = filtered.find(opt => opt.value !== '0');
            if (firstNonPlaceholder) {
                this.select.value = firstNonPlaceholder.value;
                // Trigger the original onchange event
                if (this.originalOnChange) {
                    this.originalOnChange.call(this.select);
                }
            }
        }

        // Show visual feedback
        this.showSearchFeedback();
    }

    showAllOptions() {
        // Clear current options
        while (this.select.options.length > 0) {
            this.select.remove(0);
        }

        // Restore all original options
        this.allOptions.forEach(opt => {
            const option = document.createElement('option');
            option.value = opt.value;
            option.text = opt.text;
            if (opt.hands) option.setAttribute('data-hands', opt.hands);
            if (opt.usableBy) option.setAttribute('data-usable-by', opt.usableBy);
            this.select.add(option);
        });
    }

    resetSearch() {
        this.searchTerm = '';
        this.showAllOptions();
        this.removeSearchFeedback();
    }

    showSearchFeedback() {
        // Remove existing feedback
        this.removeSearchFeedback();

        // Create feedback element
        const feedback = document.createElement('div');
        feedback.className = 'search-feedback';
        feedback.textContent = `Searching: ${this.searchTerm}`;
        feedback.style.cssText = `
            position: absolute;
            background: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            z-index: 1000;
            pointer-events: none;
            margin-top: -30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        `;

        // Position it above the select
        this.select.parentElement.style.position = 'relative';
        this.select.parentElement.appendChild(feedback);
    }

    removeSearchFeedback() {
        const existing = this.select.parentElement.querySelector('.search-feedback');
        if (existing) {
            existing.remove();
        }
    }
}

// Initialize all select elements as searchable dropdowns
function initSearchableDropdowns() {
    const selects = document.querySelectorAll('select');
    selects.forEach(select => {
        new SearchableDropdown(select);
    });
}

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSearchableDropdowns);
} else {
    initSearchableDropdowns();
}
