(() => {
    "use strict";
    const { Component, useState, useEffect, createElement, Fragment } = window.React;

    // --- Services / Modules ---

    /**
     * Handles all client-side navigation, data fetching, and history management.
     */
    const navigationService = {
        /**
         * Fetches page content from the server via AJAX.
         * @param {string} url - The URL to load.
         * @returns {Promise<string>} The HTML content.
         */
        async fetchPage(url) {
            const response = await fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (!response.ok) {
                throw new Error(`Failed to fetch page: ${response.statusText}`);
            }
            return await response.text();
        },

        /**
         * Updates the main content area with new HTML.
         * @param {string} html - The HTML to inject.
         */
        updateContent(html) {
            const contentArea = document.getElementById('dynamic-content');
            if (contentArea) {
                contentArea.innerHTML = html;
            } else {
                console.error('Dynamic content area not found.');
            }
        },

        /**
         * Pushes a new state to the browser's history.
         * @param {string} url - The new URL to show in the address bar.
         */
        updateHistory(url) {
            window.history.pushState({ path: url }, '', url);
        },

        /**
         * Updates the active class on the sidebar navigation links.
         * @param {string} activeId - The 'data-id' of the link to mark as active.
         */
        updateSidebarUI(activeId) {
            document.querySelectorAll('#sidebar .nav-link').forEach(nav => {
                nav.classList.remove('active');
                if (nav.getAttribute('data-id') === activeId) {
                    nav.classList.add('active');
                }
            });
        }
    };

    // --- React Components (Functional) ---

    /**
     * A simple loading spinner overlay.
     * @param {{isLoading: boolean}} props
     */
    const Loader = ({ isLoading }) => {
        if (!isLoading) {
            return null;
        }
        return createElement('div', {
            className: 'position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-white opacity-75',
            style: { zIndex: 9999 }
        }, createElement('div', { className: 'spinner-border text-primary' }));
    };


    // --- React Components (Class-based) ---

    /**
     * The main application component. Manages state and event listeners.
     */
    class App extends Component {
        constructor(props) {
            super(props);
            this.state = {
                isLoading: false
            };
            this.handleSidebarClick = this.handleSidebarClick.bind(this);
        }

        componentDidMount() {
            // Listen for clicks on sidebar links
            const sidebar = document.getElementById('sidebar');
            sidebar?.addEventListener('click', this.handleSidebarClick);

            // Handle browser back/forward buttons
            window.onpopstate = () => {
                // A simple refresh is the easiest way to handle state restoration without a full router
                window.location.reload();
            };
        }

        componentWillUnmount() {
            const sidebar = document.getElementById('sidebar');
            sidebar?.removeEventListener('click', this.handleSidebarClick);
        }

        /**
         * Handles clicks on sidebar links with the 'ajax-link' class.
         * @param {MouseEvent} e - The click event.
         */
        async handleSidebarClick(e) {
            const link = e.target.closest('.ajax-link');
            if (!link) return;

            e.preventDefault();
            this.setState({ isLoading: true });

            try {
                const url = link.getAttribute('href');
                const linkId = link.getAttribute('data-id');

                // 1. Fetch new page content
                const html = await navigationService.fetchPage(url);

                // 2. Update the DOM
                navigationService.updateContent(html);
                navigationService.updateHistory(url);
                navigationService.updateSidebarUI(linkId);

            } catch (error) {
                console.error("Navigation error:", error);
                // Optionally, show an error message to the user here
            } finally {
                this.setState({ isLoading: false });
            }
        }

        render() {
            return createElement(Fragment, null,
                createElement(Loader, { isLoading: this.state.isLoading })
            );
        }
    }

    
    // --- Render the App ---
    const rootElement = document.getElementById('react-root');
    if (rootElement) {
        window.ReactDOM.createRoot(rootElement).render(createElement(App));
    } else {
        console.error('React root element not found.');
    }

})();
