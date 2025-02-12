class MaxDuVpaSkaiciuokleHandler extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                vduMetinis: '#vdu_metinis',
                ismokaNpm: '#ismoka_npm',
                mainCalcBtn: '#main-calc-btn',
                resultDu: '#result-du',
                resultIsmoka: '#result-ismoka',
                additionalSection: '#additional-calc',
                duIsDs: '#du_is_ds',
                etatasIsDs: '#etatas_is_ds',
                additionalCalcBtn: '#additional-calc-btn',
                resultEtatas: '#result-etatas',
                clearBtn: '#clear-btn'
            }
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        const widgetId = this.$element.data('widget-id');
        return {
            vduMetinis: this.$element.find(selectors.vduMetinis),
            ismokaNpm: this.$element.find(selectors.ismokaNpm),
            mainCalcBtn: this.$element.find(selectors.mainCalcBtn),
            resultDu: this.$element.find(selectors.resultDu),
            resultIsmoka: this.$element.find(selectors.resultIsmoka),
            additionalSection: this.$element.find(selectors.additionalSection),
            duIsDs: this.$element.find(selectors.duIsDs),
            etatasIsDs: this.$element.find(selectors.etatasIsDs),
            additionalCalcBtn: this.$element.find(selectors.additionalCalcBtn),
            resultEtatas: this.$element.find(selectors.resultEtatas),
            clearBtn: this.$element.find(selectors.clearBtn)
        };
    }


    bindEvents() {
        this.elements.mainCalcBtn.on('click', (e) => {
            e.preventDefault();
            this.calculateMain();
        });

        this.elements.additionalCalcBtn.on('click', (e) => {
            e.preventDefault();
            this.calculateAdditional();
        });

        this.elements.clearBtn.on('click', (e) => {
            e.preventDefault();
            this.clearAll();
        });
    }

    calculateMain() {
        let vduVal = parseFloat(this.elements.vduMetinis.val());
        let ismokaVal = parseFloat(this.elements.ismokaNpm.val());
        if (isNaN(vduVal) || vduVal <= 0) {
            alert('Prašome įvesti teisingą VDU Metinis reikšmę.');
            return;
        }
        if (isNaN(ismokaVal) || ismokaVal < 0) {
            alert('Prašome įvesti teisingą Ismoka NPM reikšmę.');
            return;
        }
        let monthlyVDU = vduVal / 12;
        this.galimasDu = monthlyVDU - ismokaVal;
        // Assume answerText is set via widget settings and passed to the handler
        this.elements.resultDu.text('Du suma, kuri nemažina VPA išmokos: ' + monthlyVDU.toFixed(2));
        this.elements.additionalSection.show();
    }

    calculateAdditional() {
        if (typeof this.galimasDu === 'undefined') {
            alert('Pirmiausia atlikite pagrindinį skaičiavimą.');
            return;
        }
        let duIsDsVal = parseFloat(this.elements.duIsDs.val());
        if (isNaN(duIsDsVal) || duIsDsVal <= 0) {
            alert('Prašome įvesti teisingą Du is DS reikšmę (didesnę už 0).');
            return;
        }
        let etatoTipas = this.$element.find('input[name="etato_tipas-' + this.$element.data('widget-id') + '"]:checked').val();
        let etatas;
        if (etatoTipas === 'fiksuotas') {
            let etatasIsDsVal = parseFloat(this.elements.etatasIsDs.val());
            if (isNaN(etatasIsDsVal) || etatasIsDsVal <= 0) {
                alert('Prašome įvesti teisingą Etatas is DS reikšmę (didesnę už 0).');
                return;
            }
            etatas = this.galimasDu / (duIsDsVal / etatasIsDsVal);
        } else if (etatoTipas === 'valandinis') {
            etatas = this.galimasDu / duIsDsVal;
        } else {
            alert('Pasirinkite etato tipą.');
            return;
        }
        this.elements.resultEtatas.text('GALIMA ETATA: ' + etatas.toFixed(2));
    }

    clearAll() {
        this.elements.vduMetinis.val('');
        this.elements.ismokaNpm.val('');
        this.elements.resultDu.text('');
        this.elements.resultIsmoka.text('');
        this.galimasDu = undefined;
        this.elements.duIsDs.val('');
        this.elements.etatasIsDs.val('');
        this.elements.resultEtatas.text('');
        this.elements.additionalSection.hide();
    }
}

// Initialize the handler
jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/max_du_vpa_skaiciuokle.default', ($scope) => {
        new MaxDuVpaSkaiciuokleHandler({ $element: $scope });
    });

});
