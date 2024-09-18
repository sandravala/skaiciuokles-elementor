var omniApiKeyValidText = 'Omnisend prijungtas';
var omniApiKeyNotValidText = 'Omnisend neprijungtas. Įvesk galiojantį API raktą ir spausk mygtuką "Prijungti Omnisend"';


var OmniControl = elementor.modules.controls.BaseMultiple.extend({

    onReady: function() {

        var control = this;

        // Cache the input elements
        this.omniInput = this.$el.find('.omni_input');
        this.omniResponse = this.$el.find('.omni_response');
        this.checkButton = this.$el.find('.check_api');
        this.loader = this.$el.find('.loader');

        var valuesToSave = {};
        
        var omniApiValue = this.getControlValue('omniApi') ? this.getControlValue('omniApi') : '';
        this.savedOmniResponse = this.getControlValue('omniResponse');

        this.loader.hide();
        this.omniInput.val(omniApiValue);
        this.getOmniResponseText();

        this.omniInput.on('input', function() {
            valuesToSave.omniApi = jQuery(this).val();
            valuesToSave.omniResponse = false;
            control.saveValue(valuesToSave);
            control.getOmniResponseText();
        });

        this.checkButton.on('click', function() {
            control.checkApiKey(control.getControlValue('omniApi'));        
        });

    },

    saveValue: function(value) {
        this.setValue(value);
    },

    getOmniResponseText: function() {

        var omni = this.getControlValue('omniResponse');

        if (omni === false || omni === null || omni === undefined || omni === '') {
            this.omniResponse.text(omniApiKeyNotValidText).addClass('not_valid').removeClass('valid');
            this.checkButton.show();
        } else {
            this.omniResponse.text(omniApiKeyValidText).addClass('valid').removeClass('not_valid');
            this.checkButton.hide();
        }
    },

    checkApiKey: function(apiKey) {
        var control = this;
        var originalButtonText = control.checkButton.find('.button-text').text();
        
        function setResponse(valid) {
            control.saveValue({omniResponse : valid}); 
            control.getOmniResponseText();

            control.checkButton.find('.button-text').text(originalButtonText);
            control.checkButton.prop('disabled', false);  // Re-enable the button
            control.loader.hide();
        };

        control.checkButton.find('.button-text').text('Jungiama');
        control.loader.show();
        control.checkButton.prop('disabled', true);  // Optionally disable the button while checking

        jQuery(document).ready(function ($) {
            $.ajax({
                url: my_widget_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'skaiciuokle_check_omni_api',
                    omni: apiKey,
                },
                success: (response) => {
                    if (response.success) {
                       setResponse(true);
                    } else {
                        setResponse(false);
                    }
                },
                error: (error) => {
                    console.error('Error during AJAX request:', error);
                    setResponse(false);
                }
            });
        });

    },


});

elementor.addControlView('omni_control', OmniControl);