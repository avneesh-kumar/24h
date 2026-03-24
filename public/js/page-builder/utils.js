const PageBuilderUtils = {
    generateId() {
        return 'section_' + Date.now();
    },

    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },

    validateSection(section) {
        if (!section.type) return false;
        if (!section.content) return false;
        return true;
    },

    formatDate(date) {
        return new Date(date).toLocaleDateString();
    },

    sanitizeHtml(html) {
        const temp = document.createElement('div');
        temp.textContent = html;
        return temp.innerHTML;
    },

    getImageUrl(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (e) => resolve(e.target.result);
            reader.onerror = (e) => reject(e);
            reader.readAsDataURL(file);
        });
    },

    showNotification(message, type = 'success') {
        toastr[type](message);
    },

    confirmDelete(message = 'Are you sure you want to delete this section?') {
        return confirm(message);
    },

    handleError(error) {
        console.error('Page Builder Error:', error);
        this.showNotification('An error occurred. Please try again.', 'error');
    }
};

// Add utility methods to PageBuilder class
Object.assign(PageBuilder.prototype, PageBuilderUtils); 