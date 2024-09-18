var omniApiKeyValidText = 'Omnisend prijungtas';
var omniApiKeyNotValidText = 'Omnisend neprijungtas. Įvesk galiojantį API raktą ir spausk mygtuką "Prijungti Omnisend"';

var OmniControl = elementor.modules.controls.BaseMultiple.extend({

    onReady: function() {

         var control = this;

        // Cache the input elements
        this.omniInput = this.$el.find('.omni_input');
        this.omniResponse = this.$el.find('.omni_response');
        this.checkButton = this.$el.find('.check_api');

        var valuesToSave = {};
        
        var omniApiValue = this.getControlValue('omniApi') ? this.getControlValue('omniApi') : '';
        this.savedOmniResponse = this.getControlValue('omniResponse');

        this.omniInput.val(omniApiValue);
        this.getOmniResponseText();

        
        // Bind event to visible input
        this.omniInput.on('input', function() {

            valuesToSave.omniApi = jQuery(this).val();
            control.saveValue(valuesToSave);

        });

        this.checkButton.on('click', function() {

        });

    },

    saveValue: function(value) {
        this.setValue(value);
    },

    getOmniResponseText: function() {
        if (this.savedOmniResponse === false || this.savedOmniResponse === null || this.savedOmniResponse === undefined || this.savedOmniResponse === '') {
            this.omniResponse.text(omniApiKeyNotValidText).addClass('not_valid').removeClass('valid');
            this.checkButton.show();
        } else {
            this.omniResponse.text(omniApiKeyValidText).addClass('valid').removeClass('not_valid');
            this.checkButton.hide();
        }
    },

    checkApiKey: function(apiKey) {
        
    },


});

elementor.addControlView('omni_control', OmniControl);