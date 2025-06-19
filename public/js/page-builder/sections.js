// Section templates
const SectionTemplates = {
    hero: `
        <div class="section hero-section">
            <div class="section-handle">
                <i class="fas fa-grip-vertical"></i>
            </div>
            <div class="section-content">
                <h2 class="title"></h2>
                <p class="description"></p>
                <div class="buttons"></div>
            </div>
            <div class="section-actions">
                <button class="edit-section"><i class="fas fa-edit"></i></button>
                <button class="delete-section"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    `,
    features: `
        <div class="section features-section">
            <div class="section-handle">
                <i class="fas fa-grip-vertical"></i>
            </div>
            <div class="section-content">
                <h2 class="title"></h2>
                <div class="features-grid"></div>
            </div>
            <div class="section-actions">
                <button class="edit-section"><i class="fas fa-edit"></i></button>
                <button class="delete-section"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    `,
    testimonials: `
        <div class="section testimonials-section">
            <div class="section-handle">
                <i class="fas fa-grip-vertical"></i>
            </div>
            <div class="section-content">
                <h2 class="title"></h2>
                <div class="testimonials-slider"></div>
            </div>
            <div class="section-actions">
                <button class="edit-section"><i class="fas fa-edit"></i></button>
                <button class="delete-section"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    `
};

// Default content for each section type
const DefaultContent = {
    hero: {
        title: 'Welcome to Our Site',
        description: 'Add your description here',
        buttonText: 'Learn More',
        buttonUrl: '#'
    },
    features: {
        title: 'Our Features',
        features: [
            {
                title: 'Feature 1',
                description: 'Description for feature 1',
                icon: 'fa-star'
            },
            {
                title: 'Feature 2',
                description: 'Description for feature 2',
                icon: 'fa-heart'
            }
        ]
    },
    testimonials: {
        title: 'What Our Clients Say',
        testimonials: [
            {
                name: 'John Doe',
                position: 'CEO',
                content: 'Great service!',
                image: ''
            }
        ]
    }
};

// Property templates for each section type
const PropertyTemplates = {
    hero: `
        <div class="property-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="property-group">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="property-group">
            <label>Button Text</label>
            <input type="text" name="buttonText" class="form-control">
        </div>
        <div class="property-group">
            <label>Button URL</label>
            <input type="text" name="buttonUrl" class="form-control">
        </div>
    `,
    features: `
        <div class="property-group">
            <label>Section Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="features-list">
            <!-- Features will be added here -->
        </div>
        <button class="btn btn-primary add-feature">Add Feature</button>
    `,
    testimonials: `
        <div class="property-group">
            <label>Section Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="testimonials-list">
            <!-- Testimonials will be added here -->
        </div>
        <button class="btn btn-primary add-testimonial">Add Testimonial</button>
    `
};

// Extend PageBuilder class with section-specific methods
Object.assign(PageBuilder.prototype, {
    getSectionTemplate(type) {
        return SectionTemplates[type] || '';
    },

    getDefaultContent(type) {
        return DefaultContent[type] || {};
    },

    getSectionProperties(type) {
        return PropertyTemplates[type] || '';
    },

    updateSectionContent($section, content) {
        switch (content.type) {
            case 'hero':
                $section.find('.title').text(content.title);
                $section.find('.description').text(content.description);
                $section.find('.buttons').html(`
                    <a href="${content.buttonUrl}" class="btn btn-primary">${content.buttonText}</a>
                `);
                break;
            case 'features':
                $section.find('.title').text(content.title);
                const featuresHtml = content.features.map(feature => `
                    <div class="feature">
                        <i class="fas ${feature.icon}"></i>
                        <h3>${feature.title}</h3>
                        <p>${feature.description}</p>
                    </div>
                `).join('');
                $section.find('.features-grid').html(featuresHtml);
                break;
            case 'testimonials':
                $section.find('.title').text(content.title);
                const testimonialsHtml = content.testimonials.map(testimonial => `
                    <div class="testimonial">
                        <img src="${testimonial.image}" alt="${testimonial.name}">
                        <p>${testimonial.content}</p>
                        <h4>${testimonial.name}</h4>
                        <span>${testimonial.position}</span>
                    </div>
                `).join('');
                $section.find('.testimonials-slider').html(testimonialsHtml);
                break;
        }
    }
}); 