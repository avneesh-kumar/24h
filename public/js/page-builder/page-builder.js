class PageBuilder {
    constructor() {
        this.sections = [];
        this.currentSection = null;
        this.init();
    }

    init() {
        this.bindEvents();
        this.loadPage();
    }

    bindEvents() {
        // Add section buttons
        $('.section-buttons button').on('click', (e) => {
            const type = $(e.target).data('section');
            this.addSection(type);
        });

        // Save page
        $('#savePage').on('click', () => this.savePage());

        // Preview page
        $('#previewPage').on('click', () => this.previewPage());

        // Make sections sortable
        this.initSortable();
    }

    initSortable() {
        $('#pageSections').sortable({
            handle: '.section-handle',
            update: (event, ui) => this.updateSectionOrder()
        });
    }

    addSection(type) {
        const section = {
            id: 'section_' + Date.now(),
            type: type,
            content: this.getDefaultContent(type)
        };

        this.sections.push(section);
        this.renderSection(section);
    }

    renderSection(section) {
        const template = this.getSectionTemplate(section.type);
        const $section = $(template);
        $section.attr('data-section-id', section.id);
        
        $('#pageSections').append($section);
        this.bindSectionEvents($section);
    }

    bindSectionEvents($section) {
        // Edit button
        $section.find('.edit-section').on('click', () => {
            this.editSection($section);
        });

        // Delete button
        $section.find('.delete-section').on('click', () => {
            this.deleteSection($section);
        });
    }

    editSection($section) {
        const sectionId = $section.data('section-id');
        const section = this.sections.find(s => s.id === sectionId);
        
        if (section) {
            this.currentSection = section;
            this.loadProperties(section);
        }
    }

    loadProperties(section) {
        const properties = this.getSectionProperties(section.type);
        $('#sectionProperties').html(properties);
        this.bindPropertyEvents();
    }

    bindPropertyEvents() {
        // Bind events for property inputs
        $('#sectionProperties input, #sectionProperties textarea').on('change', (e) => {
            this.updateSectionContent(e);
        });
    }

    updateSectionContent(e) {
        const $input = $(e.target);
        const property = $input.attr('name');
        const value = $input.val();

        if (this.currentSection) {
            this.currentSection.content[property] = value;
            this.updateSectionPreview();
        }
    }

    updateSectionPreview() {
        if (this.currentSection) {
            const $section = $(`[data-section-id="${this.currentSection.id}"]`);
            this.updateSectionContent($section, this.currentSection.content);
        }
    }

    savePage() {
        $.ajax({
            url: '/admin/page-builder/save',
            method: 'POST',
            data: {
                sections: this.sections
            },
            success: (response) => {
                toastr.success('Page saved successfully');
            },
            error: (error) => {
                toastr.error('Error saving page');
            }
        });
    }

    previewPage() {
        // Open preview in new window
        window.open('/admin/page-builder/preview', '_blank');
    }

    loadPage() {
        $.ajax({
            url: '/admin/page-builder/load',
            method: 'GET',
            success: (response) => {
                this.sections = response.sections;
                this.renderSections();
            }
        });
    }

    renderSections() {
        $('#pageSections').empty();
        this.sections.forEach(section => this.renderSection(section));
    }

    updateSectionOrder() {
        const newOrder = [];
        $('#pageSections .section').each((index, element) => {
            const sectionId = $(element).data('section-id');
            const section = this.sections.find(s => s.id === sectionId);
            if (section) {
                section.order = index;
                newOrder.push(section);
            }
        });
        this.sections = newOrder;
    }

    deleteSection($section) {
        const sectionId = $section.data('section-id');
        this.sections = this.sections.filter(s => s.id !== sectionId);
        $section.remove();
    }
}

// Initialize page builder when document is ready
$(document).ready(() => {
    window.pageBuilder = new PageBuilder();
}); 