class MyCustomWidgetHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                form: '#ismoku_skaiciuokle_nemokama',
                submitButton: '#ismoku_skaiciuokle_nemokama button[type="submit"]',
                messageContainer: '#message-container-skaiciuokle',
            },
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $form: this.$element.find(selectors.form),
            $submitButton: this.$element.find(selectors.submitButton),
            $messageContainer: this.$element.find(selectors.messageContainer),  
        };
    }

    bindEvents() {
        this.elements.$submitButton.on('click', this.onFormSubmit.bind(this));
    }

    onFormSubmit(event) {
        event.preventDefault();

        const formData = this.elements.$form.serialize();
        const messageContainer = this.elements.$messageContainer;

        jQuery(document).ready(function($) {
            $.ajax({
                url: my_widget_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'nemokama_skaiciuokle_send_email',
                    data: formData,
                },
                success: (response) => {
                    // Show the success message
                    const successMessage = '<div class="success-message"><img src="" alt="Success"> ' + response.data.message + '</div>';
                    messageContainer.html(successMessage);
                },
                error: (error) => {
                    console.error('Error:', error);
                    //alert('Error: ' + error.responseText);
                }
            });
        });
    }
}

// Initialize the handler
jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/ismoku_skaiciuokle_nemokama.default', ($scope) => {
        new MyCustomWidgetHandler({ $element: $scope });
    });
});

