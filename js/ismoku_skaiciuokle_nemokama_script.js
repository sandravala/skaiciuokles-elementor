class MyCustomWidgetHandler extends elementorModules.frontend.handlers.Base {
    
    getDefaultSettings() {
        return {
            selectors: {
                form: '#ismoku_skaiciuokle',
                submitButton: '#ismoku_skaiciuokle button[type="submit"]',
                resetButton: '#ismoku_skaiciuokle button[type="reset"].formbox__btn-reset',
                sendButton: '#ismoku_skaiciuokle button[type="button"].formbox__btn-send',
                alertContainer: '#ismoku_skaiciuokle #alert-container-skaiciuokle',
                resultContainer: '#result-container-skaiciuokle',
                gimdymoDatosInput: '#ismoku_skaiciuokle #gimdymoDatosInput',
                npmNaudosisLabel: '#ismoku_skaiciuokle #npm-naudosis-label',
                mamosPajamuLabel: '#ismoku_skaiciuokle #mamos-pajamos-label',
                tecioPajamuLabel: '#ismoku_skaiciuokle #tecio-pajamos-label',
                motinystesCheck: '#ismoku_skaiciuokle #motinystesCheck',
                vpaCheck: '#ismoku_skaiciuokle #vpaCheck',
                tevystesCheck: '#ismoku_skaiciuokle #tevystesCheck',
                vpaTrukme18Radio: '#ismoku_skaiciuokle #vpaTrukme18Radio',
                vpaTrukme24Radio: '#ismoku_skaiciuokle #vpaTrukme24Radio',
                mamosRadio: '#ismoku_skaiciuokle #mamosRadio',
                tecioRadio: '#ismoku_skaiciuokle #tecioRadio',
                npmTaipRadio: '#ismoku_skaiciuokle #npmTaipRadio',
                npmNeRadio: '#ismoku_skaiciuokle #npmNeRadio',
                mamosDUpajamos: '#ismoku_skaiciuokle #mamosDUpajamos',
                mamosIVpajamos: '#ismoku_skaiciuokle #mamosIVpajamos',
                mamosIslaidos30: '#ismoku_skaiciuokle #mamosIslaidos30',
                mamosIslaidosFaktas: '#ismoku_skaiciuokle #mamosIslaidosFaktas',
                tecioDUpajamos: '#ismoku_skaiciuokle #tecioDUpajamos',
                tecioIVpajamos: '#ismoku_skaiciuokle #tecioIVpajamos',
                tecioIslaidos30: '#ismoku_skaiciuokle #tecioIslaidos30',
                tecioIslaidosFaktas: '#ismoku_skaiciuokle #tecioIslaidosFaktas',
                mamosPajamuInput: '#ismoku_skaiciuokle #mamosPajamuInput',
                mamosIslaiduInput: '#ismoku_skaiciuokle #mamosIslaiduInput',
                tecioPajamuInput: '#ismoku_skaiciuokle #tecioPajamuInput',
                tecioIslaiduInput: '#ismoku_skaiciuokle #tecioIslaiduInput',
                gimdymoDatosInput: '#ismoku_skaiciuokle #gimdymoDatosInput',
                emailInput: '#ismoku_skaiciuokle #emailInput',
                nameInput: '#ismoku_skaiciuokle #nameInput',
                klaida: '#ismoku_skaiciuokle .klaida',
                widgetIdInput: '#ismoku_skaiciuokle #widget_id',
                postIdInput: '#ismoku_skaiciuokle #post_id',
                nonceInput: '#ismoku_skaiciuokle #nonce_skaiciuokle',
            },
        };
    }


    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $form: this.$element.find(selectors.form),
            $submitButton: this.$element.find(selectors.submitButton),
            $resetButton: this.$element.find(selectors.resetButton),
            $sendButton: this.$element.find(selectors.sendButton),
            $alertContainer: this.$element.find(selectors.alertContainer),
            $resultContainer: this.$element.find(selectors.resultContainer),
            $gimdymoDatosInput: this.$element.find(selectors.gimdymoDatosInput),
            $npmNaudosisLabel: this.$element.find(selectors.npmNaudosisLabel),
            $mamosPajamuLabel: this.$element.find(selectors.mamosPajamuLabel),
            $tecioPajamuLabel: this.$element.find(selectors.tecioPajamuLabel),
            $motinystesCheck: this.$element.find(selectors.motinystesCheck),
            $vpaCheck: this.$element.find(selectors.vpaCheck),
            $tevystesCheck: this.$element.find(selectors.tevystesCheck),
            $vpaTrukme18Radio: this.$element.find(selectors.vpaTrukme18Radio),
            $vpaTrukme24Radio: this.$element.find(selectors.vpaTrukme24Radio),
            $mamosRadio: this.$element.find(selectors.mamosRadio),
            $tecioRadio: this.$element.find(selectors.tecioRadio),
            $npmTaipRadio: this.$element.find(selectors.npmTaipRadio),
            $npmNeRadio: this.$element.find(selectors.npmNeRadio),
            $mamosDUpajamos: this.$element.find(selectors.mamosDUpajamos),
            $mamosIVpajamos: this.$element.find(selectors.mamosIVpajamos),
            $mamosIslaidos30: this.$element.find(selectors.mamosIslaidos30),
            $mamosIslaidosFaktas: this.$element.find(selectors.mamosIslaidosFaktas),
            $tecioDUpajamos: this.$element.find(selectors.tecioDUpajamos),
            $tecioIVpajamos: this.$element.find(selectors.tecioIVpajamos),
            $tecioIslaidos30: this.$element.find(selectors.tecioIslaidos30),
            $tecioIslaidosFaktas: this.$element.find(selectors.tecioIslaidosFaktas),
            $mamosPajamuInput: this.$element.find(selectors.mamosPajamuInput),
            $mamosIslaiduInput: this.$element.find(selectors.mamosIslaiduInput),
            $tecioPajamuInput: this.$element.find(selectors.tecioPajamuInput),
            $tecioIslaiduInput: this.$element.find(selectors.tecioIslaiduInput),
            $gimdymoDatosInput: this.$element.find(selectors.gimdymoDatosInput),
            $emailInput: this.$element.find(selectors.emailInput),
            $nameInput: this.$element.find(selectors.nameInput),
            $klaidos: this.$element.find(selectors.klaida),
            $testBtn: this.$element.find(selectors.testBtn),
            $post_id_input: this.$element.find(selectors.postIdInput),
            $widget_id_input: this.$element.find(selectors.widgetIdInput),
            $nonce_input: this.$element.find(selectors.nonceInput),

        };
    }
    
    onInit() {

        super.onInit();

        this.createDateInput();

        //get widget settings data
        this.duomenysSkaiciavimams = this.getElementSettings();
        this.mokamaSkaiciuokle = this.duomenysSkaiciavimams['skaiciuokles_tipas'];
        this.vdu = this.duomenysSkaiciavimams['vdu_control'];
        this.tevystesTarifas = parseFloat(this.duomenysSkaiciavimams['tevystes_tarifas'].toString().replace(',', '.'));
        this.motinystesTarifas = parseFloat(this.duomenysSkaiciavimams['motinystes_tarifas'].toString().replace(',', '.'));
        this.neperleidziamuMenesiuTarifas = parseFloat(this.duomenysSkaiciavimams['npm_tarifas'].toString().replace(',', '.'));
        this.tarifasAtostogos18men = parseFloat(this.duomenysSkaiciavimams['vpa_18_tarifas'].toString().replace(',', '.'));
        this.tarifasAtostogos24men = [
            parseFloat(this.duomenysSkaiciavimams['vpa_24_tarifas_1'].toString().replace(',', '.')), 
            parseFloat(this.duomenysSkaiciavimams['vpa_24_tarifas_2'].toString().replace(',', '.'))
        ];
        this.mokesciaiNuoIsmoku = parseFloat(this.duomenysSkaiciavimams['mokesciu_tarifas'].toString().replace(',', '.'));
        this.bazineSocIsmoka = parseFloat(this.duomenysSkaiciavimams[ 'bazine_soc_ismoka'].toString().replace(',', '.'));
        this.minimumas = parseFloat(this.duomenysSkaiciavimams['minimumas'].toString().replace(',', '.'));

        //nemokama skaiciuokle
        this.nemokamaSkaiciuokle = !this.mokamaSkaiciuokle;
        
        //create variables for calculations
        
        this.motinystesIsmokaRodyti = false;
        this.tevystesIsmokaRodyti = false;
        this.vpaIsmokaRodyti = !this.mokamaSkaiciuokle;
        
        this.mamaArTetisVpa = null;
        this.vpaTrukme = null; 
        this.naudosisNpm = null;
        this.mamosPajamuTipas = null;
        this.mamosPajamos = null;
        this.mamosIslaiduTipas = null;
        this.mamosIslaidos = null;
        this.tecioPajamuTipas = null;
        this.tecioPajamos = null;
        this.tecioIslaiduTipas = null;
        this.tecioIslaidos = null;
        this.gimdymoData = null;

        this.vpaIsmokos = {};
        this.bendrosSumos = {};
        this.vpaIsmokuPaaiskinimai = '';
        this.postId = this.elements.$post_id_input.attr('value');
        this.widgetId = this.elements.$widget_id_input.attr('value');

        this.uzpraeitasKetvirtis = this.ketvirtisIsmokoms(new Date());
        this.sisKetvirtis = {
            metai: new Date().getFullYear(),
            ketvirtis: 'vdu_' + (Math.floor(new Date().getMonth() / 3) + 1)
        }

        //ketv baigiasi 03 31, 06 30, 09 30, 12 31 ir per 71 d nuo jo pabaigos tiketina gauti nauja info
        let duomenysAtnaujinimui = {
            vdu_1: new Date(this.sisKetvirtis.metai + '-06-12'),
            vdu_2: new Date(this.sisKetvirtis.metai + '-09-10'),
            vdu_3: new Date(this.sisKetvirtis.metai + '-12-11'),
            vdu_4: new Date(this.sisKetvirtis.metai + '-03-13')
        }

        let largestDate = null;
        let vduNaujausias = null;
        for (let key in duomenysAtnaujinimui) {
            let currentDate = duomenysAtnaujinimui[key];
            if (currentDate < new Date()) {
                if (!largestDate || currentDate > largestDate) {
                    largestDate = currentDate;
                    vduNaujausias = key;
                }
            }
        }
        if(vduNaujausias === null) {
            this.sisKetvirtis.metai -= 1;
            vduNaujausias = 'vdu_4'
        }

        if (typeof elementor === 'undefined') {
            if(!this.vdu && !this.vdu[this.sisKetvirtis.metai] && !this.vdu[this.sisKetvirtis.metai][vduNaujausias]) {
                this.fetchVduData(this.vdu, this.sisKetvirtis.metai, vduNaujausias, this.postId, this.widgetId);
            } 
        }

    }


    bindEvents() {

        const elements = this.getDefaultElements();
        
        elements.$motinystesCheck.on('click', () => this.rodytiLaukusIsmokosSkaiciavimui('motinystesCheck'));
        elements.$vpaCheck.on('click', () => this.rodytiLaukusIsmokosSkaiciavimui('vpaCheck'));
        elements.$tevystesCheck.on('click', () => this.rodytiLaukusIsmokosSkaiciavimui('tevystesCheck'));

        elements.$vpaTrukme18Radio.on('click', () => {
            this.rodytiLaukusIsmokosSkaiciavimui('vpaTrukme18Radio');
            
        });
        elements.$vpaTrukme24Radio.on('click', () => {
            this.rodytiLaukusIsmokosSkaiciavimui('vpaTrukme24Radio');
            
        });

        elements.$mamosRadio.on('click', () => {
            this.rodytiLaukusIsmokosSkaiciavimui('mamosRadio');
            this.nemokamaSkaiciuokle ? this.rodytiLaukusIsmokosSkaiciavimui('mamosDUpajamos') : null;
        });
        elements.$tecioRadio.on('click', () => {
            this.rodytiLaukusIsmokosSkaiciavimui('tecioRadio');
            this.nemokamaSkaiciuokle ? this.rodytiLaukusIsmokosSkaiciavimui('tecioDUpajamos') : null;
        });

        elements.$npmTaipRadio.on('click', () => {
            this.rodytiLaukusIsmokosSkaiciavimui('npmTaipRadio');
            this.nemokamaSkaiciuokle ? this.rodytiLaukusIsmokosSkaiciavimui(this.mamaArTetisVpa > 1 ? 'mamosDUpajamos' : 'tecioDUpajamos') : null;
        });
        elements.$npmNeRadio.on('click', () => this.rodytiLaukusIsmokosSkaiciavimui('npmNeRadio'));

        elements.$mamosDUpajamos.on('click', () => this.rodytiLaukusIsmokosSkaiciavimui('mamosDUpajamos'));
        elements.$mamosIVpajamos.on('click', () => this.rodytiLaukusIsmokosSkaiciavimui('mamosIVpajamos'));

        elements.$mamosIslaidos30.on('click', () => this.rodytiLaukusIsmokosSkaiciavimui('mamosIslaidos30'));
        elements.$mamosIslaidosFaktas.on('click', () => this.rodytiLaukusIsmokosSkaiciavimui('mamosIslaidosFaktas'));

        elements.$tecioDUpajamos.on('click', () => this.rodytiLaukusIsmokosSkaiciavimui('tecioDUpajamos'));
        elements.$tecioIVpajamos.on('click', () => this.rodytiLaukusIsmokosSkaiciavimui('tecioIVpajamos'));

        elements.$tecioIslaidos30.on('click', () => this.rodytiLaukusIsmokosSkaiciavimui('tecioIslaidos30'));
        elements.$tecioIslaidosFaktas.on('click', () => this.rodytiLaukusIsmokosSkaiciavimui('tecioIslaidosFaktas'));  

        elements.$mamosPajamuInput.on('input', () => {this.rodytiLaukusIsmokosSkaiciavimui('mamosPajamuInput');});	
        elements.$mamosIslaiduInput.on('input', () => {this.rodytiLaukusIsmokosSkaiciavimui('mamosIslaiduInput');});	
        elements.$tecioPajamuInput.on('input', () => {this.rodytiLaukusIsmokosSkaiciavimui('tecioPajamuInput');});	
        elements.$tecioIslaiduInput.on('input', () => {this.rodytiLaukusIsmokosSkaiciavimui('tecioIslaiduInput');});	
        elements.$gimdymoDatosInput.on('change', () => {
            this.rodytiLaukusIsmokosSkaiciavimui('gimdymoDatosInput');
            const nonce_input = elements.$nonce_input;
            jQuery(document).ready(function ($) {

                $.ajax({
                    url: my_widget_ajax.ajax_url, // Replace with your AJAX URL
                    type: 'POST',
                    data: {
                        action: 'generate_nonce_for_ajax' // The action name defined in PHP
                    },
                    success: function(response) {
                        if (response.success) {
                            nonce_input.attr('value', response.data.nonce);
                        } else {
                            console.error('Failed to fetch nonce:', response.data);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', error);
                    }
                });
            });
        
        });	

        elements.$emailInput.on('input', () => {
            if(!this.validateEmail(elements.$emailInput.val())) {

                this.elements.$alertContainer.text('Įveskite savo kontaktinius duomenis');
                this.$element.find('#emailInputFieldset').addClass('klaida');
                this.$element.find('#alert').removeClass('nerodyti');
            } else {
                if(this.validateName(elements.$nameInput.val())) {
                this.$element.find('#alert').addClass('nerodyti');
                }
                this.$element.find('#emailInputFieldset').removeClass('klaida');
            }
        
        });

        elements.$nameInput.on('input', () => {
            if(!this.validateName(elements.$nameInput.val())) {

                this.elements.$alertContainer.text('Įveskite savo kontaktinius duomenis');
                this.$element.find('#nameInputFieldset').addClass('klaida');
                this.$element.find('#alert').removeClass('nerodyti');
            } else {
                if(this.validateEmail(elements.$emailInput.val())) {
                this.$element.find('#alert').addClass('nerodyti');
                }
                this.$element.find('#nameInputFieldset').removeClass('klaida');
            }
        
        });
        
        this.elements.$submitButton.on('click', this.onFormSubmit.bind(this));
        this.elements.$resetButton.on('click', this.onReset.bind(this));
        this.elements.$sendButton.on('click', this.onSend.bind(this));
    }

    fetchVduData(vdu, sieMetai, vduNaujausias, postId, widgetId) {

        const ketv = vduNaujausias.slice(-1);

        if (!vdu) {

            const metai = [ sieMetai - 1, sieMetai ];
            const ketvirciai = [ 1, ketv ];

            this.getOspData(metai, ketvirciai, postId, widgetId);

        } else if (!this.vdu[sieMetai] || !this.vdu[sieMetai][vduNaujausias]) {

            this.getOspData(sieMetai, ketv, postId, widgetId);

        }
    }

    getOspData(sieMetai, ketv, postId, widgetId) {
        jQuery(document).ready(function ($) {
            $.ajax({
                url: my_widget_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'set_vdu',
                    metai: sieMetai,
                    ketvirtis: ketv,
                    post_id: postId,
                    widget_id: widgetId
                },
                success: (response) => {
                    // Check if the response indicates success
                    if (response.success) {
                    } else {
                        console.error('Error:', response);
                    }
                },
                error: (error) => {
                    console.error('AJAX Error:', error);
                }
            });
        });
    }

    rodytiLaukusIsmokosSkaiciavimui(ismoka) {

        switch(ismoka) {
            case 'motinystesCheck' : 
                this.motinystesIsmokaRodyti = !this.motinystesIsmokaRodyti;
                this.isjungtiLaukus();
                break;
            case 'tevystesCheck' :
                this.tevystesIsmokaRodyti = !this.tevystesIsmokaRodyti;
                this.isjungtiLaukus();
                break;
            case 'vpaCheck' :
                this.vpaIsmokaRodyti = !this.vpaIsmokaRodyti;
                this.isjungtiLaukus();
                break;
            case 'vpaTrukme18Radio' :
                this.vpaTrukme = 18;
                this.$element.find('#vpa-trukme').removeClass('klaida');
                break;
            case 'vpaTrukme24Radio' :
                this.vpaTrukme = 24;
                this.$element.find('#vpa-trukme').removeClass('klaida');
                break;
            case 'tecioRadio' : 
                this.mamaArTetisVpa = 2;
                this.rodytiLaukus([ '#tecio-pajamu-tipas' ], true);
                this.elements.$npmNaudosisLabel.text('Mama naudosis 2 neperleidžiamais VPA mėnesiais?');
                this.$element.find('#vpa-ims').removeClass('klaida');
                this.rodytiLaukus([ '#npm-naudosis' ], true);
                this.naudosisNpm ? this.rodytiLaukus([ '#mamos-pajamu-tipas' ], true) : this.motinystesIsmokaRodyti ? null : this.rodytiLaukus([ '#mamos-pajamu-tipas' ], false);
                break;
            case 'mamosRadio' : 
                this.mamaArTetisVpa = 1;
                this.rodytiLaukus([ '#mamos-pajamu-tipas' ], true);
                this.elements.$npmNaudosisLabel.text('Tėtis naudosis 2 neperleidžiamais VPA mėnesiais?');
                this.$element.find('#vpa-ims').removeClass('klaida');
                this.rodytiLaukus([ '#npm-naudosis' ], true);
                this.naudosisNpm ? this.rodytiLaukus([ '#tecio-pajamu-tipas' ], true) : this.tevystesIsmokaRodyti ? null : this.rodytiLaukus([ '#tecio-pajamu-tipas' ], false);
                break;
            case 'mamosDUpajamos' :
                this.mamosPajamuTipas = 1;
                this.elements.$mamosIslaidos30.checked = false;
                this.elements.$mamosIslaidosFaktas.checked = false;
                this.elements.$mamosPajamuLabel.text('Mamos vidutinis darbo užmokestis prieš mokesčius');
                this.elements.$mamosPajamuInput.attr('min', 0);
                this.elements.$mamosPajamuInput.attr('value', 0);
                this.pastabaDelIvGrindu('#mamos-pajamos', false);
                this.rodytiLaukus([ '#mamos-islaidu-tipas', '#mamos-faktines-islaidos' ], false);
                this.rodytiLaukus([ '#mamos-pajamos' ], true);
                this.$element.find('#mamos-pajamu-tipas').removeClass('klaida');
                break;
            case 'mamosIVpajamos' : 
                this.mamosPajamuTipas = 2;
                this.mamosPajamos = 924;
                this.elements.$mamosIslaidos30.checked = false;
                this.elements.$mamosIslaidosFaktas.checked = false;
                this.elements.$mamosPajamuLabel.text('Grynos gaunamos vidutinės mamos pajamos iš IDV');
                this.elements.$mamosPajamuInput.attr('min', this.minimumas);
                this.elements.$mamosPajamuInput.attr('value', this.minimumas);
                this.pastabaDelIvGrindu('#mamos-pajamos', true);
                this.rodytiLaukus([ '#mamos-islaidu-tipas', '#mamos-pajamos' ], true);
                this.rodytiLaukus([ '#mamos-faktines-islaidos' ], false);
                this.$element.find('#mamos-pajamu-tipas').removeClass('klaida');
                break;
            case 'tecioDUpajamos' :
                this.tecioPajamuTipas = 1;
                this.elements.$tecioIslaidos30.checked = false;
                    this.elements.$tecioIslaidosFaktas.checked = false;
                this.elements.$tecioPajamuLabel.text('Tėčio vidutinis darbo užmokestis prieš mokesčius');
                this.elements.$tecioPajamuInput.attr('min', 0);
                this.elements.$tecioPajamuInput.attr('value', 0);
                this.pastabaDelIvGrindu('#tecio-pajamos', false);
                this.rodytiLaukus([ '#tecio-pajamos' ], true);
                this.rodytiLaukus([ '#tecio-islaidu-tipas', '#faktines-tecio-islaidos' ], false);
                this.$element.find('#tecio-pajamu-tipas').removeClass('klaida');
                break;
            case 'tecioIVpajamos' : 
                this.tecioPajamuTipas = 2;
                this.tecioPajamos = 924;
                this.elements.$tecioIslaidos30.checked = false;
                this.elements.$tecioIslaidosFaktas.checked = false;
                this.elements.$tecioPajamuLabel.text('Grynos gaunamos vidutinės tėčio pajamos iš IDV');
                this.elements.$tecioPajamuInput.attr('min', this.minimumas);
                this.elements.$tecioPajamuInput.attr('value', this.minimumas);
                this.pastabaDelIvGrindu('#tecio-pajamos', true);
                this.rodytiLaukus([ '#tecio-islaidu-tipas', '#tecio-pajamos' ], true);
                this.rodytiLaukus([ '#tecio-faktines-islaidos' ], false);
                this.$element.find('#tecio-pajamu-tipas').removeClass('klaida');
                break;
            case 'mamosIslaidosFaktas' :
                this.mamosIslaiduTipas = 2;
                this.rodytiLaukus([ '#mamos-faktines-islaidos' ], true);
                this.$element.find('#mamos-islaidu-tipas').removeClass('klaida');
                break;
            case 'mamosIslaidos30' :
                this.mamosIslaiduTipas = 1;
                this.rodytiLaukus([ '#mamos-faktines-islaidos' ], false);
                this.$element.find('#mamos-islaidu-tipas').removeClass('klaida');
                break;
            case 'tecioIslaidosFaktas' :
                this.tecioIslaiduTipas = 2;
                this.rodytiLaukus([ '#tecio-faktines-islaidos' ], true);
                this.$element.find('#tecio-islaidu-tipas').removeClass('klaida');
                break;
            case 'tecioIslaidos30' :
                this.tecioIslaiduTipas = 1;
                this.rodytiLaukus([ '#tecio-faktines-islaidos' ], false);
                this.$element.find('#tecio-islaidu-tipas').removeClass('klaida');
                break;
            case 'npmTaipRadio' :
                this.naudosisNpm = 1;
                this.mamaArTetisVpa === 1 ? this.rodytiLaukus([ '#tecio-pajamu-tipas' ], true) : this.mamaArTetisVpa === 2 ? this.rodytiLaukus([ '#mamos-pajamu-tipas' ], true) : null;
                this.$element.find('#npm-naudosis').removeClass('klaida');
                break;
            case 'npmNeRadio' :
                this.naudosisNpm = 0;
                this.mamaArTetisVpa === 1 && !this.tevystesIsmokaRodyti ? this.rodytiLaukus([ '#tecio-pajamu-tipas', '#tecio-pajamos' ], false) : this.mamaArTetisVpa === 2 && !this.motinystesIsmokaRodyti? this.rodytiLaukus([ '#mamos-pajamu-tipas', '#mamos-pajamos' ], false) : null;
                this.$element.find('#npm-naudosis').removeClass('klaida');
                break;
            case 'mamosPajamuInput' :
                this.$element.find('#mamos-pajamos').removeClass('klaida');
                this.mamosPajamos = this.elements.$mamosPajamuInput.val();
                break;
            case 'mamosIslaiduInput' :
                this.$element.find('#mamos-islaidos').removeClass('klaida');
                this.mamosIslaidos = this.elements.$mamosIslaiduInput.val();
                break;
            case 'tecioPajamuInput' :
                this.$element.find('#tecio-pajamos').removeClass('klaida');
                this.tecioPajamos = this.elements.$tecioPajamuInput.val();
                break;
            case 'tecioIslaiduInput' :
                this.$element.find('#tecio-islaidos').removeClass('klaida');
                this.tecioIslaidos = this.elements.$tecioIslaiduInput.val();
                break;
            case 'gimdymoDatosInput' :
                this.$element.find('#gimdymo-data').removeClass('klaida');
                this.gimdymoData = this.elements.$gimdymoDatosInput.val();
                break;

        }

        if(this.$element.find('#result-container-skaiciuokle').length > 0 && this.$element.find('#result-container-skaiciuokle').children().length > 0) {
            console.log('yra lentele');
            const result = this.skaiciuotiIsmokas(this.tevystesTarifas, this.motinystesTarifas, this.neperleidziamuMenesiuTarifas, this.tarifasAtostogos18men, this.tarifasAtostogos24men, this.mokesciaiNuoIsmoku, this.vdu, this.bazineSocIsmoka, this.motinystesIsmokaRodyti, this.tevystesIsmokaRodyti, this.vpaIsmokaRodyti, this.vpaTrukme, this.mamaArTetisVpa, this.naudosisNpm, this.mamosPajamuTipas, this.mamosPajamos, this.mamosIslaiduTipas, this.mamosIslaidos, this.tecioPajamuTipas, this.tecioPajamos, this.tecioIslaiduTipas, this.tecioIslaidos, this.gimdymoData);
            const resultContainer = this.elements.$resultContainer;
            resultContainer.html(result);  
            if(this.elements.$sendButton.length > 0) {
                this.elements.$sendButton.parent().removeClass('nerodyti');
                this.$element.find('#email').removeClass('nerodyti');
                this.elements.$resetButton.parent().addClass('nerodyti');
            } 
        }

    }

    pastabaDelIvGrindu(laukelisPoKuriuoPridetiPastaba, arPrideti) {
        const pastabosLaukas = document.getElementById( "pastaba" + laukelisPoKuriuoPridetiPastaba);
        if (arPrideti) {
        const ivPajamuPastaba = pastabosLaukas ? pastabosLaukas : document.createElement("div");
        
        const targetElement = this.$element.find(laukelisPoKuriuoPridetiPastaba).get(0);

        // Ensure the target element is found before attempting to insert
        if (targetElement) {
            targetElement.insertAdjacentElement("afterend", ivPajamuPastaba);

            // Set attributes and styles using native DOM methods
            ivPajamuPastaba.id = "pastaba" + laukelisPoKuriuoPridetiPastaba;
            ivPajamuPastaba.style.padding = "0px 0px 32px 32px";
            ivPajamuPastaba.innerHTML = `Jūsų vidutinės mėnesinės pajamos turi būti ne mažesnės, nei ${this.minimumas} €. Jei vidutinės mėnesinės pajamos mažesnės, galimai išmoka nebūtų skiriama, todėl preliminarūs apskaičiavimai negali būti atliekami.`;
        }
    } else if (pastabosLaukas) {
        // Remove the note element if it exists
        pastabosLaukas.remove();
    }
    }

    isjungtiLaukus() {

        let vpaLaukai = [ '#vpa-trukme', '#vpa-ims'];
        let mLaukai = [ ['#mamos-pajamu-tipas', '#mamos-pajamos'], ['#mamos-islaidu-tipas', '#mamos-faktines-islaidos'] ];
        let tLaukai = [ ['#tecio-pajamu-tipas', '#tecio-pajamos'], ['#tecio-islaidu-tipas', '#tecio-fakties-islaidos'] ];
        let bendriLaukai = [ '#gimdymo-data' ];

        let vpaRadios = [ '#vpaTrukme18Radio', '#vpaTrukme24Radio', '#tecioRadio', '#mamosRadio', '#npmTaipRadio', 'npmNeRadio' ];
        let mRadios = [ '#mamosDUpajamos', '#mamosIVpajamos', '#mamosIslaidos30', '#mamosIslaidosFaktas' ];
        let tRadios = [ '#tecioDUpajamos', '#tecioIVpajamos', '#tecioIslaidos30', '#tecioIslaidosFaktas' ];
        
	
        this.vpaIsmokaRodyti || this.motinystesIsmokaRodyti || this.tevystesIsmokaRodyti ? this.rodytiLaukus(bendriLaukai, true) : this.rodytiLaukus(bendriLaukai, false);	
        
        switch (true) { 
                case !this.vpaIsmokaRodyti && !this.motinystesIsmokaRodyti && !this.tevystesIsmokaRodyti:
                this.rodytiLaukus([...vpaLaukai, ...mLaukai[0], ...mLaukai[1], ...tLaukai[0], ...tLaukai[1]], false);
                this.atzymetiRadios([ ...vpaRadios, ...tRadios, ...mRadios ]);
                      break;
                case !this.vpaIsmokaRodyti && !this.motinystesIsmokaRodyti && this.tevystesIsmokaRodyti:
                   this.rodytiLaukus([ ...vpaLaukai, ...mLaukai[0], ...mLaukai[1] ], false);
                this.atzymetiRadios([...vpaRadios, ...mRadios]);
                    this.rodytiLaukus([tLaukai[0][0]], true);
                       break;
            case !this.vpaIsmokaRodyti && this.motinystesIsmokaRodyti && !this.tevystesIsmokaRodyti:
                    this.rodytiLaukus([...vpaLaukai, ...tLaukai[0], ...tLaukai[1] ], false);
                this.atzymetiRadios([...vpaRadios, ...tRadios]);
                    this.rodytiLaukus([mLaukai[0][0]], true);
                    break;
                case !this.vpaIsmokaRodyti && this.motinystesIsmokaRodyti && this.tevystesIsmokaRodyti:
                this.rodytiLaukus(vpaLaukai, false);
                this.atzymetiRadios(vpaRadios);
                    this.rodytiLaukus([ mLaukai[0][0], tLaukai[0][0] ], true);
                       break;
            case this.vpaIsmokaRodyti && this.motinystesIsmokaRodyti && this.tevystesIsmokaRodyti:
                    this.rodytiLaukus([ ...vpaLaukai, mLaukai[0][0], tLaukai[0][0] ], true);
                    break;
            case this.vpaIsmokaRodyti && !this.motinystesIsmokaRodyti && this.tevystesIsmokaRodyti:
                if(this.mamaArTetisVpa === 2 && !this.naudosisNpm) {
                    this.rodytiLaukus( [...mLaukai[0], ...mLaukai[1] ], false);
                    this.atzymetiRadios(mRadios);
                };
                    this.rodytiLaukus([ ...vpaLaukai, tLaukai[0][0] ], true);
                       break;
            case this.vpaIsmokaRodyti && this.motinystesIsmokaRodyti && !this.tevystesIsmokaRodyti:
                if(this.mamaArTetisVpa === 1 && !this.naudosisNpm) {
                    this.rodytiLaukus( [...tLaukai[0], ...tLaukai[1] ], false); 
                    this.atzymetiRadios(tRadios);
                };
                    this.rodytiLaukus([ ...vpaLaukai, mLaukai[0][0] ], true);
                       break;
            case this.vpaIsmokaRodyti && !this.motinystesIsmokaRodyti && !this.tevystesIsmokaRodyti:
                this.rodytiLaukus(vpaLaukai, true);
                if (!this.naudosisNpm) {
                    if(this.mamaArTetisVpa === 2) {
                        this.rodytiLaukus( [...mLaukai[0], ...mLaukai[1] ], false);
                        this.atzymetiRadios([ ...mRadios ]);
                    }
                    if(this.mamaArTetisVpa === 1) {
                       this.rodytiLaukus( [...tLaukai[0], ...tLaukai[1] ], false);
                        this.atzymetiRadios([ ...tRadios ]);
                    }
                } 
                    break;
        }
    }
    
    atzymetiRadios(radios) {
    
        radios.forEach(radio => {
            this.$element.find(radio).checked = false;
        }); 
    }
    
    rodytiLaukus(visiLaukuIDArray, rodytiTrueOrFalse) {
        visiLaukuIDArray.forEach(laukoID => {rodytiTrueOrFalse ? this.$element.find(laukoID).removeClass('nerodyti') : this.$element.find(laukoID).addClass('nerodyti');} )
    };

    createDateInput() {

        const dateInput = this.elements.$gimdymoDatosInput;

        jQuery(document).ready(function ($) {
            dateInput.datepicker({
                dateFormat: 'yy-mm-dd',
                monthNames: ["Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis"],
                monthNamesShort: ["Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis"],
                dayNamesMin: ["S", "Pr", "A", "T", "K", "Pn", "Š"],
                firstDay: 1,
                changeMonth: true,
                changeYear: true,
            });

        });
    }

    updateWidgetContent(propertyName) {

    
            switch (propertyName) {
                case 'skaiciuokles_tipas':
                    this.mokamaSkaiciuokle = this.getElementSettings('skaiciuokles_tipas');
                    this.nemokamaSkaiciuokle = !this.mokamaSkaiciuokle;
                    break;
        
                case 'vdu_control':
                    this.vdu = this.getElementSettings('vdu_control');
                    break;
        
                case 'tevystes_tarifas':
                    this.tevystesTarifas = parseFloat(this.getElementSettings('tevystes_tarifas').toString().replace(',', '.'));
                    break;
        
                case 'motinystes_tarifas':
                    this.motinystesTarifas = parseFloat(this.getElementSettings('motinystes_tarifas').toString().replace(',', '.'));
                    break;
        
                case 'npm_tarifas':
                    this.neperleidziamuMenesiuTarifas = parseFloat(this.getElementSettings('npm_tarifas').toString().replace(',', '.'));
                    break;
        
                case 'vpa_18_tarifas':
                    this.tarifasAtostogos18men = parseFloat(this.getElementSettings('vpa_18_tarifas').toString().replace(',', '.'));
                    break;
        
                case 'vpa_24_tarifas_1':
                case 'vpa_24_tarifas_2':
                    this.tarifasAtostogos24men = [
                        parseFloat(this.getElementSettings('vpa_24_tarifas_1').toString().replace(',', '.')), 
                        parseFloat(this.getElementSettings('vpa_24_tarifas_2').toString().replace(',', '.'))
                    ];
                    break;
        
                case 'mokesciu_tarifas':
                    this.mokesciaiNuoIsmoku = parseFloat(this.getElementSettings('mokesciu_tarifas').toString().replace(',', '.'));
                    break;
        
                case 'bazine_soc_ismoka':
                    this.bazineSocIsmoka = parseFloat(this.getElementSettings('bazine_soc_ismoka').toString().replace(',', '.'));
                    break;
        
                case 'minimumas':
                    this.minimumas = parseFloat(this.getElementSettings('minimumas').toString().replace(',', '.'));
                    break;
        
                default:
                    return;  
            };        

	}

    /**
	 * On Element Change
	 *
	 * Runs every time a control value is changed by the user in the editor.
	 *
	 * @param {string} propertyName - The ID of the control that was changed.
	 */
	onElementChange( propertyName ) {
		if ( 'omni' !== propertyName ) {
			this.updateWidgetContent(propertyName);
		}

	}


    skaiciuotiIsmokas(tevystesTarifas, motinystesTarifas, neperleidziamuMenesiuTarifas, tarifasAtostogos18men, tarifasAtostogos24men, mokesciaiNuoIsmoku, vdu, bazineSocIsmoka, motinystesIsmokaRodyti, tevystesIsmokaRodyti, vpaIsmokaRodyti, vpaTrukme, mamaArTetisVpa, naudosisNpm, mamosPajamuTipas, mamosPajamos, mamosIslaiduTipas, mamosIslaidos, tecioPajamuTipas, tecioPajamos, tecioIslaiduTipas, tecioIslaidos, gimdymoData) {

        // SKAICIUOJAME LUBAS IR GRINDIS
        // iki 2023 07 01 buvo 6 bazines soc ismokos dydziai, nuo 07 01 - 8
        let minIsmoka = bazineSocIsmoka * 8; //  8 bazinės socialinės išmokos dydžiai galioję praeitą ketvirtį (paskutinis patvirtintas dydis) iki teisės gauti išmoką atsiradimo dienos.
        minIsmoka.toFixed(2);
        minIsmoka = parseFloat(minIsmoka);

        // PASIRENKAM, KURI KETVIRTI IMTI (IMA PRIESPASKUTINI)


        let duomenysMaxIsmokai = this.ketvirtisIsmokoms(new Date(gimdymoData));

        function flatten(arr) {
            return arr.reduce((flat, sub_arr) => flat.concat(sub_arr.slice(1)), []);
        };

        function findLastPositive(obj) {
            let values = [];
            for (let year in obj) {
                for (let quarter in obj[year]) {
                    if (parseFloat(obj[year][quarter].toString().replace(',', '.')) > 0) {
                        values.push(parseFloat(obj[year][quarter].toString().replace(',', '.')));
                    }
                }
            }
            return values.length > 0 ? values[values.length - 1] : 0;
        }
        
        let maxIsmoka;
        if(vdu) {
            maxIsmoka = (vdu[duomenysMaxIsmokai.metai] && vdu[duomenysMaxIsmokai.metai][duomenysMaxIsmokai.ketvirtis] && parseFloat(vdu[duomenysMaxIsmokai.metai][duomenysMaxIsmokai.ketvirtis].toString().replace(',', '.')) > 0) ?
            parseFloat(vdu[duomenysMaxIsmokai.metai][duomenysMaxIsmokai.ketvirtis].toString().replace(',', '.')) * 2 :
            (duomenysMaxIsmokai.metai < Object.keys(vdu)[0] ? parseFloat(vdu[Object.keys(vdu)[0]]["vdu_1"].toString().replace(',', '.')) * 2 : findLastPositive(vdu) * 2);
        } else {
            maxIsmoka = 1902.70;
        }
        
        maxIsmoka.toFixed(2);


        // PASIDAROM LENTELE SU ISMOKU SARASU PAMENESIUI

        let menesiai = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        let gimimoDiena = new Date(gimdymoData);
        function diena(dataDienai) {
            let gimtadienis = dataDienai.getDate() > 9 ? dataDienai.getDate() : '0' + dataDienai.getDate();
            return gimtadienis;
        }

        let d = new Date(gimimoDiena);
        d.setDate(d.getDate() - 70);
        // nuo gimdymo datos atimam 10 savaiciu, -70 d., nepriskaiciuoti prasymo svarstymo datos ir ismokejimo datos
        let motinystesIsmokosData = d.getFullYear() + " " + menesiai[d.getMonth()] + " " + diena(d); // plius 1 mėn., nes skaičiuoja nuo 0 (t.y. pirmas mėnuo yra 0)
        let tevystesIsmokosPabaiga = (gimimoDiena.getFullYear() + 1) + " " + menesiai[gimimoDiena.getMonth() - 1] + " " + diena(gimimoDiena); // minus vienas, nes getMonth() nuo 1, o array menesiai nuo 0

        let gDiena = gimimoDiena.getFullYear() + " " + menesiai[gimimoDiena.getMonth()] + " " + diena(gimimoDiena);
        let gMenuo = gimimoDiena.getMonth();
        let vpaPradzia = new Date(gimimoDiena);
        vpaPradzia.setDate(vpaPradzia.getDate() + 57);
        let vpaMenuo = vpaPradzia.getMonth() + 1 - gMenuo + 1;


        // PASIDAROME REIKALINGAS TARPINES DATAS

        function formatDate(date, format) {
            let currentYear = date.getFullYear();
            let currentMonth = date.getMonth();
            let currentDay = date.getDate();
            let formattedMonth = String(currentMonth + 1).padStart(2, '0'); // Adding 1 to adjust for 0-indexed months
            let formattedDay = String(currentDay).padStart(2, '0');

            let formattedDate;
            switch (true) {
                case format.localeCompare("yyyy-mm") === 0:
                    formattedDate = `${currentYear}-${formattedMonth}`;
                    break;
                case format.localeCompare("yyyy-mm-dd") === 0:
                    formattedDate = `${currentYear}-${formattedMonth}-${formattedDay}`;
                    break;
                case format.localeCompare("yyyy/mm/dd") === 0:
                    formattedDate = `${currentYear}/${formattedMonth}/${formattedDay}`;
                    break;
                default:
                    formattedDate = date;
            }
            return formattedDate;

        }

        function lastDay(y, m) {
            return new Date(y, m + 1, 0).getDate();
        }

        function countBusinessDays(startDate, endDate, holidays) {
            let workdays = 0;

            for (let day = new Date(startDate); day <= endDate; day.setDate(day.getDate() + 1)) {
                const dayOfWeek = day.getDay();
                const isWeekend = dayOfWeek === 0 || dayOfWeek === 6; // Saturday or Sunday
                const isHoliday = holidays.includes(day.toISOString().split('T')[0]);
                if (!isWeekend && !isHoliday) {
                    workdays++;
                }
            }

            return workdays;

        }

        function calculateEasterDate(year) {
            const a = year % 19;
            const b = Math.floor(year / 100);
            const c = year % 100;
            const d = Math.floor(b / 4);
            const e = b % 4;
            const f = Math.floor((b + 8) / 25);
            const g = Math.floor((b - f + 1) / 3);
            const h = (19 * a + b - d - g + 15) % 30;
            const i = Math.floor(c / 4);
            const k = c % 4;
            const l = (32 + 2 * e + 2 * i - h - k) % 7;
            const m = Math.floor((a + 11 * h + 22 * l) / 451);
            const month = Math.floor((h + l - 7 * m + 114) / 31);
            const day = ((h + l - 7 * m + 114) % 31) + 1;

            return new Date(year, month - 1, day);
        }

        function generatePublicHolidays(year) {

            const fixedHolidayDays = ['-01-01', '-02-16', '-03-11', '-05-01', '-06-24', '-07-06', '-08-15', '-11-01', '-11-02', '-12-24', '-12-25', '-12-26'];

            const fixedHolidays = [];

            fixedHolidayDays.forEach(element => {
                fixedHolidays.push(year + element);
            });

            const easter = calculateEasterDate(year);
            easter.setDate(easter.getDate() + 1);
            const easterMonday = new Date(easter);
            easterMonday.setDate(easter.getDate() + 1);

            const flexibleHolidays = [formatDate(easter, 'yyyy-mm-dd'), formatDate(easterMonday, 'yyyy-mm-dd')];

            const publicHolidays = [...fixedHolidays, ...flexibleHolidays];
            const holidaysOnWeekdays = [];


            publicHolidays.forEach(holiday => {
                const holidayOnWeekend = new Date(holiday).getDay() === 0 || new Date(holiday).getDay() === 6;
                if (!holidayOnWeekend) {
                    holidaysOnWeekdays.push(holiday);
                }
            });

            return holidaysOnWeekdays;
        }


        function addMonthsToDate(date, monthsToAdd) {
            const newDate = new Date(date);
            const currentMonth = newDate.getMonth();
            newDate.setMonth(currentMonth + monthsToAdd);

            let newCurrentMonth = currentMonth + monthsToAdd >= 0 ? (currentMonth + monthsToAdd) % 12 : 12 + (currentMonth + monthsToAdd) % 12;

            // Handling potential year adjustment in case new month has fewer days than current month. e.g. 2024-03-31 minus 1 month should result 2024-02-29, not 2024-03-02
            if (newDate.getMonth() !== newCurrentMonth) {
                newDate.setDate(0); // Move to the last day of the previous month
            }

            return newDate;
        }


        let avgBusinessDaysInAYear = countBusinessDays(new Date(gimimoDiena.getFullYear(), 0, 1), new Date(gimimoDiena.getFullYear(), 11, 31), generatePublicHolidays(gimimoDiena.getFullYear())) / 12;
        avgBusinessDaysInAYear = avgBusinessDaysInAYear.toFixed(1);

        const npmFirstStart = vpaPradzia;

        const npmFirstEnd = addMonthsToDate(new Date(npmFirstStart), 2);
        npmFirstEnd.setDate(npmFirstEnd.getDate());

        const npmLasttEnd = addMonthsToDate(new Date(gimimoDiena), vpaTrukme);
        npmLasttEnd.setDate(npmLasttEnd.getDate() - 1);

        const npmLastStart = addMonthsToDate(new Date(npmLasttEnd), -2);

        const vpaEnd = new Date(npmLastStart);
        vpaEnd.setDate(vpaEnd.getDate() - 1);

        const oneYear = addMonthsToDate(new Date(gimimoDiena), 12);
        oneYear.setDate(oneYear.getDate() - 1);

        const vpaStart = new Date(npmFirstEnd);
        vpaStart.setDate(vpaStart.getDate() + 1);

        // PASIDAROME BAZE SKAICIAVIMUI

        let bendraVpaIsmokuSuma = 0;
        let bendraVpaIsmokuSumaSuMokesciais = 0;
        let bendraVisuIsmokuSuma = 0;
        let bendraVisuIsmokuSumaSuMokesciais = 0;

        function ismokosSuma(bazeIsmokai, tarifas, kiekisDienomisArbaMenesiais, netaikytiLubu, countDaily) {
            let maxDaily = maxIsmoka / avgBusinessDaysInAYear;
            maxDaily = maxDaily.toFixed(2);
            let baseMax = countDaily ? maxDaily : maxIsmoka;
            let lubos = netaikytiLubu ? bazeIsmokai + 1 : baseMax;
            let bazeDidesneUzLubas = parseFloat(bazeIsmokai) > parseFloat(lubos);
            let galutineIsmoka = bazeDidesneUzLubas ? baseMax * tarifas / 100 * kiekisDienomisArbaMenesiais : bazeIsmokai * tarifas / 100 * kiekisDienomisArbaMenesiais;
            return galutineIsmoka.toFixed(2);
        }

        let mamosBazeIsmokai = mamosPajamuTipas == 1 ? mamosPajamos : mamosIslaiduTipas == 1 ? (mamosPajamos - (mamosPajamos * 0.3)) * 0.9 : (mamosPajamos - mamosIslaidos) * 0.9;
        let tecioBazeIsmokai = tecioPajamuTipas == 1 ? tecioPajamos : tecioIslaiduTipas == 1 ? (tecioPajamos - (tecioPajamos * 0.3)) * 0.9 : (tecioPajamos - tecioIslaidos) * 0.9;

        // pasidarome tuscius kintamuosius rezultatu isvedimui

        let vpaIsmokos = [];
        let tarifai = [];
        let bendrosSumos = [];
        let motinystesIsmokosEilute = [];
        let tevystesIsmokosEilute = [];

        // apskaiciuojame motinystes ismoka

        if (motinystesIsmokaRodyti) {

            let motinystesIsmokaSuMokesciais = ismokosSuma(mamosBazeIsmokai, motinystesTarifas, 4, true, false) * 1 < minIsmoka * 4 ? minIsmoka * 4 : ismokosSuma(mamosBazeIsmokai, motinystesTarifas, 4, true, false) * 1;
            let motinystesIsmoka = motinystesIsmokaSuMokesciais * (1 - mokesciaiNuoIsmoku / 100);
            motinystesIsmokosEilute = motinystesIsmokaRodyti && mamosPajamos > 0 ? [{ 'tarifas': motinystesTarifas.toLocaleString("lt-LT") + ' %', 'men': 'nuo ' + motinystesIsmokosData, 'suma': motinystesIsmokaSuMokesciais.toLocaleString("lt-LT") + " €", 'sumaPoMokesciu': parseFloat(motinystesIsmoka.toFixed(2)).toLocaleString("lt-LT") + " €", 'gavejas': 'mama' }] : [{ 'tarifas': '', 'men': '', 'suma': '', 'sumaPoMokesciu': '', 'gavejas': '' }];

            bendraVisuIsmokuSumaSuMokesciais += motinystesIsmokaSuMokesciais;
            bendraVisuIsmokuSuma += motinystesIsmoka;

        }
        // apskaiciuojame tevystes ismoka

        if (tevystesIsmokaRodyti) {

            let tevystesIsmokaSuMokesciais = ismokosSuma(tecioBazeIsmokai, tevystesTarifas, 1, false, false) * 1 < minIsmoka ? minIsmoka : ismokosSuma(tecioBazeIsmokai, tevystesTarifas, 1, false, false) * 1;
            let tevystesIsmoka = tevystesIsmokaSuMokesciais * (1 - mokesciaiNuoIsmoku / 100);
            tevystesIsmokosEilute = tevystesIsmokaRodyti && tecioPajamos > 0 ? [{ 'tarifas': tevystesTarifas.toLocaleString("lt-LT") + ' %', 'men': 'nuo ' + gDiena, 'suma': tevystesIsmokaSuMokesciais.toLocaleString("lt-LT") + " €", 'sumaPoMokesciu': parseFloat(tevystesIsmoka.toFixed(2)).toLocaleString("lt-LT") + " €", 'gavejas': 'tėtis' }] : [{ 'tarifas': '', 'men': '', 'suma': '', 'sumaPoMokesciu': '', 'gavejas': '' }];

            bendraVisuIsmokuSumaSuMokesciais += tevystesIsmokaSuMokesciais;
            bendraVisuIsmokuSuma += tevystesIsmoka;
        }
        //pasidarome vpa ismoku sarasa 

        if (vpaIsmokaRodyti) {


            let mamaVpa = mamaArTetisVpa === 1; // patikriniam, ar mama eis vpa (jei ne, tai vadinasi tetis)
            function pajamuBaze(arMamaVpa) {
                const baze = arMamaVpa ? mamosBazeIsmokai : tecioBazeIsmokai;
                return baze;
            }; //jei mama, tai ima mamos. jei tetis arba !mama - tai ima tecio

            let bazeSkaiciavimui = pajamuBaze(mamaVpa); // pasirenkam mamos ar tecio du skaiciuoti ismokoms pagrindinems
            let bazeNpmSkaiciavimui = pajamuBaze(!mamaVpa); // pasirenkam mamos ar tecio du skaiciuoti ismokoms npm

            function fillRateArray() {
                let gavejas = mamaVpa ? 'mama' : 'tėtis';
                let gavejasNpm = mamaVpa ? 'tėtis' : 'mama';
                let vienosDienosBazePagrTevo = bazeSkaiciavimui / avgBusinessDaysInAYear;
                let vienosDienosBazeAntroTevo = bazeNpmSkaiciavimui / avgBusinessDaysInAYear;
                vienosDienosBazePagrTevo = vienosDienosBazePagrTevo.toFixed(2);
                vienosDienosBazeAntroTevo = vienosDienosBazeAntroTevo.toFixed(2);

                tarifai.push({ 'start': npmFirstStart, 'end': npmFirstEnd, 'rate': neperleidziamuMenesiuTarifas, 'base': vienosDienosBazePagrTevo, 'receiver': gavejas, 'npm': true });

                if (vpaTrukme === 24) {
                    const vpaTarpinisPabaiga = oneYear;
                    const vpaTarpinisPradzia = new Date(vpaTarpinisPabaiga);
                    vpaTarpinisPradzia.setDate(vpaTarpinisPradzia.getDate() + 1);
                    tarifai.push({ 'start': vpaStart, 'end': vpaTarpinisPabaiga, 'rate': tarifasAtostogos24men[0], 'base': vienosDienosBazePagrTevo, 'receiver': gavejas, 'npm': false });
                    tarifai.push({ 'start': vpaTarpinisPradzia, 'end': vpaEnd, 'rate': tarifasAtostogos24men[1], 'base': vienosDienosBazePagrTevo, 'receiver': gavejas, 'npm': false });
                } else {
                    tarifai.push({ 'start': vpaStart, 'end': vpaEnd, 'rate': tarifasAtostogos18men, 'base': vienosDienosBazePagrTevo, 'receiver': gavejas, 'npm': false })
                }

                if (naudosisNpm) {
                    tarifai.push({ 'start': npmLastStart, 'end': npmLasttEnd, 'rate': neperleidziamuMenesiuTarifas, 'base': vienosDienosBazeAntroTevo, 'receiver': gavejasNpm, 'npm': true });
                }

            }

            fillRateArray();

            tarifai.forEach(el => {
                el.start = formatDate(el.start, "yyyy/mm/dd");
                el.end = formatDate(el.end, "yyyy/mm/dd");
            })

            tarifai.forEach(element => {
                generuotiIsmokosEilute(element.start, element.end, element.rate, element.base, element.receiver, element.npm)
            });

            bendrosSumos.push({ 'tarifas': '', 'men': 'Viso VPA išmokų:', 'suma': bendraVpaIsmokuSumaSuMokesciais.toLocaleString("lt-LT") + ' €', 'sumaPoMokesciu': bendraVpaIsmokuSuma.toLocaleString("lt-LT") + ' €', 'gavejas': '' });

            vpaIsmokos.forEach(ismoka => {
                ismoka.suma = ismoka.suma.toLocaleString("lt-LT") + " €";
                ismoka.sumaPoMokesciu = ismoka.sumaPoMokesciu.toLocaleString("lt-LT") + " €";
            })

        }

        function generuotiIsmokosEilute(start, end, rate, base, receiver, npm) {

            let currentStartDate = new Date(start);
            let finalEndDate = new Date(end);
            let finalEndYear = finalEndDate.getFullYear();
            let finalEndMonth = finalEndDate.getMonth();
            let npmText = npm ? '(npm***)' : '';

            while (currentStartDate < finalEndDate) {
                let factor = 1;
                let currentYear = currentStartDate.getFullYear();
                let currentMonth = currentStartDate.getMonth();
                let currentLastDay = lastDay(currentYear, currentMonth);
                let menuo = formatDate(currentStartDate, "yyyy-mm-dd") + " - ";

                if (currentStartDate.getDate() > 1) {
                    factor = ((currentLastDay - currentStartDate.getDate() + 1) / currentLastDay).toFixed(2);
                }

                if (currentMonth === finalEndMonth && currentYear === finalEndYear && currentLastDay > finalEndDate.getDate()) {
                    factor = (finalEndDate.getDate() / currentLastDay).toFixed(2);
                    menuo += formatDate(new Date(currentYear, currentMonth, finalEndDate.getDate()), "yyyy-mm-dd");
                } else {
                    menuo += formatDate(new Date(currentYear, currentMonth, currentLastDay), "yyyy-mm-dd");
                }

                let currentBusinessDays = factor === 1 ? 20.9 : countBusinessDays(new Date(currentYear, currentMonth, 1), new Date(currentYear, currentMonth, currentLastDay), generatePublicHolidays(currentYear));

                let suma = ismokosSuma(base, rate, currentBusinessDays, false, true);
                suma = suma < minIsmoka ? minIsmoka * factor : suma * factor;
                suma = parseFloat(suma.toFixed(2));
                let sumaPoMokesciu = suma * (1 - mokesciaiNuoIsmoku / 100);
                sumaPoMokesciu = parseFloat(sumaPoMokesciu.toFixed(2));

                bendraVpaIsmokuSumaSuMokesciais += suma;
                bendraVpaIsmokuSuma += sumaPoMokesciu;

                bendraVisuIsmokuSumaSuMokesciais += suma;
                bendraVisuIsmokuSuma += sumaPoMokesciu;

                vpaIsmokos.push({ 'tarifas': rate + ' % ' + npmText, 'men': menuo, 'suma': suma, 'sumaPoMokesciu': sumaPoMokesciu, 'gavejas': receiver });

                currentStartDate = addMonthsToDate(currentStartDate.setDate(1), 1);
            };

        }

        if (motinystesIsmokaRodyti || tevystesIsmokaRodyti) {
            bendrosSumos.push({ 'tarifas': '', 'men': 'Viso išmokų:', 'suma': bendraVisuIsmokuSumaSuMokesciais.toLocaleString("lt-LT") + ' €', 'sumaPoMokesciu': bendraVisuIsmokuSuma.toLocaleString("lt-LT") + ' €', 'gavejas': '' });
        }

        // pasidarome pavadinimus stulpeliu

        let mIsmokosPavadinimas = motinystesIsmokaRodyti && mamosPajamos > 0 ? 'Nėštumo ir gimdymo atostogų išmoka:' : '';
        let tIsmokosPavadinimas = tevystesIsmokaRodyti && tecioPajamos > 0 ? 'Tėvystės išmoka:' : '';
        let vpaIsmokosPavadinimas = vpaIsmokaRodyti && (tecioPajamos || mamosPajamos) > 0 ? this.nemokamaSkaiciuokle? 'Vaiko priežiūros atostogų išmokos detalizacija:' : 'Vaiko priežiūros atostogų išmoka:' : '';
        let bendrosSumosPavadinimas = (vpaIsmokaRodyti || motinystesIsmokaRodyti || tevystesIsmokaRodyti) && (tecioPajamos || mamosPajamos) > 0 ? 'bendraSuma' : '';
        let paaiskinimuPavadinimas = tecioPajamos || mamosPajamos > 0 ? 'Paaiškinimai:' : '';
        let pavadinimai = mamosPajamos > 0 || tecioPajamos > 0 ? ['tarifas', 'data*', 'suma**', 'suma (į rankas)', 'gavėjas'] : ['', '', '', '', ''];

        // funkcija eiluciu generavimui pagal duomenis

        function createRow(data, ismokuPavadinimas, nemokamaSkaiciuokle) {
            let rows = '';

            if (ismokuPavadinimas !== '') {
                if (ismokuPavadinimas === 'bendraSuma' && (mamosPajamos > 0 || tecioPajamos > 0)) {

                    const fontWeight = 'bold';

                    rows += `<tr>
                            <td colspan='5' style='text-align: center; font-size: .85em; letter-spacing: .1em; text-transform: uppercase; background-color: #D9E1E7; line-height: 2; '>IŠ VISO:</td>
                            </tr>`

                    for (let i = 0; i < data.length; i++) {
                        rows += `<tr>
                                <td colspan='2' style='text-align: left; font-size: .85em; text-transform: uppercase; padding-left: .3em; font-weight: ${fontWeight};'>${data[i].men}</td>
                                <td style='text-align: left; font-size: .85em; padding-left: .3em; font-weight: ${fontWeight};'><div class='bendra-suma' >${data[i].suma}</div></td>
                                <td style='text-align: left; font-size: .85em; padding-left: .3em; font-weight: ${fontWeight};'><div class='bendra-suma' >${data[i].sumaPoMokesciu}</div></td>
                                <td style='text-align: left; font-size: .85em; text-transform: uppercase; padding-left: .3em;'>${data[i].gavejas}</td>
                            </tr>`
                    }
                } else if (ismokuPavadinimas === 'tarifai') {

                    const fontWeight = 'bold';

                    rows += `<tr>
                            <td colspan='5' style='text-align: center; font-size: .85em; letter-spacing: .1em; text-transform: uppercase; background-color: #D9E1E7; line-height: 2; '>TARIFAI:</td>
                            </tr>`

                    for (let i = 0; i < data.length; i++) {
                        rows += `<tr>
                                <td style='text-align: left; font-size: .85em; text-transform: uppercase; padding-left: .3em; font-weight: ${fontWeight};'>${data[i].start}</td>
                                <td style='text-align: left; font-size: .85em; padding-left: .3em; font-weight: ${fontWeight};'>${data[i].end}</td>
                                <td style='text-align: left; font-size: .85em; padding-left: .3em; font-weight: ${fontWeight};'>${data[i].rate}</td>
                                <td style='text-align: left; font-size: .85em; text-transform: uppercase; padding-left: .3em;'>${data[i].base}</td>
                                <td style='text-align: left; font-size: .85em; text-transform: uppercase; padding-left: .3em;'>${data[i].receiver}</td>
                            </tr>`
                    }
                } else {
                    rows += `<tr>
                        <td colspan='5' style='text-align: center; font-size: .85em; letter-spacing: .1em; text-transform: uppercase; background-color: #D9E1E7; line-height: 2; '>${ismokuPavadinimas}</td>
                        </tr>`
                    
                    if (nemokamaSkaiciuokle) {
                        rows += `<tr>
                        <th style='text-align: left; font-size: .75em; text-transform: uppercase;padding-left: .3em; width: 10%;'>${pavadinimai[0]}</th>
                        <th style='text-align: left; font-size: .75em; text-transform: uppercase;padding-left: 1em;'">${pavadinimai[1]}</th>
                        <th style='text-align: left; font-size: .75em; text-transform: uppercase;padding-left: .3em;'">${pavadinimai[2]}</th>
                        <th style='text-align: left; font-size: .75em; text-transform: uppercase;padding-left: .3em;'">${pavadinimai[3]}</th>
                        <th style='text-align: left; font-size: .75em; text-transform: uppercase;padding-left: .3em;'">${pavadinimai[4]}</th>
                        </tr>`
                    };

                    
                    for (let i = 0; i < data.length; i++) {
                        const fontWeight = 'normal';
                        rows += `<tr>
                                <td style='text-align: left; font-size: .75em; text-transform: uppercase; padding-left: .3em;'>${data[i].tarifas}</td>
                                <td style='text-align: left; font-size: .75em; padding-left: .3em; font-weight: ${fontWeight};'><div class='datos-laukas'>${data[i].men}</div></td>
                                <td style='text-align: left; font-size: .75em; padding-left: .3em; font-weight: ${fontWeight};'>${data[i].suma}</td>
                                <td style='text-align: left; font-size: .75em; padding-left: .3em; font-weight: ${fontWeight};'>${data[i].sumaPoMokesciu}</td>
                                <td style='text-align: left; font-size: .75em; text-transform: uppercase; padding-left: .3em;'>${data[i].gavejas}</td>
                            </tr>`
                        if (data.length > 2 && i < data.length - 1) {
                            rows += `<tr></tr>`
                        }
                    }
                }

            }
            return rows;
        };

        function createExplanationRows(paaiskinimai) {
            let rows = '';
            paaiskinimai.forEach((paaiskinimas, index) => {
                if (paaiskinimas !== '') {  // Only create a row if the element exists
                    rows += `<tr><td colspan='5' style="text-align: left; font-size: .75em; padding-left: .3em; font-weight: normal;">${paaiskinimas}</td></tr>`;
                }
            });
            return rows;
        }

        // pasidarom paaiskinimu tekstus

        let paaiskinimai = mamosPajamos > 0 || tecioPajamos > 0 ? ['* - Preliminari teisės į išmoką atsiradimo data, t.y. nuo kada galima kreiptis dėl išmokos.', '', '** - preliminariai apskaičiuota išmokos suma pagal pateiktus duomenis (faktinės išmokos gali nežymiai kisti, priklausomai nuo gimdymo datos, atostogų, ligos ir pan.)', '', '', '', '', ''] : ['', '', '', '', '', '', '', ''];
        mamosPajamos > 0 && motinystesIsmokaRodyti ? paaiskinimai[1] = 'Tikslią datą nurodys jus prižiūrintis gydytojas.' : paaiskinimai[1] = '';
        mamosPajamos > 0 && motinystesIsmokaRodyti ? paaiskinimai[6] = 'Nėštumo ir gimdymo išmoka mokama visa iš karto už visą 126 dienų laikotarpį.' : paaiskinimai[6] = '';

        mamosPajamos > 0 && mamosBazeIsmokai > maxIsmoka ? paaiskinimai[3] += `Mamos pajamos viršija maksimalų galimą išmokos dydį, todėl išmokos skaičiuojamos nuo didžiausios galimos sumos (${maxIsmoka.toLocaleString("lt-LT")} Eur). ` : mamosPajamos > 0 && mamosBazeIsmokai < minIsmoka ? paaiskinimai[3] += `Mamos pajamos yra mažesnės už šiuo metu galiojantį minimalų dydį, todėl išmokos skaičiuojamos nuo mažiausios galimos sumos (${minIsmoka.toLocaleString("lt-LT")} Eur). ` : null;

        tecioPajamos > 0 && tecioBazeIsmokai < minIsmoka ? paaiskinimai[3] += `Tėčio pajamos yra mažesnės už šiuo metu galiojantį minimalų dydį, todėl išmokos skaičiuojamos nuo mažiausios galimos sumos (${minIsmoka.toLocaleString("lt-LT")} Eur).` : tecioPajamos > 0 && tecioBazeIsmokai > maxIsmoka ? paaiskinimai[3] += `Tėčio pajamos viršija šiuo metu galiojantį maksimalų galimą išmokos dydį, todėl išmokos skaičiuojamos nuo didžiausios galimos sumos (${maxIsmoka.toLocaleString("lt-LT")} Eur).` : null;

        vpaIsmokaRodyti && (tecioPajamos || mamosPajamos) > 0 ? paaiskinimai[4] = '*** - NPM yra 2 neperleidžiami mėnesiai mamai ir 2 neperleidžiami mėnesiai tėčiui. Didesnis tarifas taikomas tik neperleidžiamais VPA mėnesiais (NPM), ir jais atitinkamai gali pasinaudoti tik mama arba tėtis. Jei NPM naudoja tik vienas iš tėvų, išmoka pradingsta, o VPA sutrumpėja' : null;

        vpaIsmokaRodyti && (tecioPajamos || mamosPajamos) > 0 ? paaiskinimai[7] = 'Čia matote preliminariai apskaičiuotas išmokas pilnam mėnesiui. Pirmo ir paskutinio mėnesio (taip pat mėnesio eigoje keičiantis tarifams) VPA išmokų sumos bus mažesnės, priklausomai nuo to, kurią dieną prasidės ir baigsis teisė į VPA išmoką.' : null;

        (tecioPajamos > 0 && tecioPajamuTipas == 2) || (mamosPajamos > 0 && mamosPajamuTipas == 2) ? paaiskinimai[5] = 'Jei pajamas deklaruojate kartą metuose, galimai išmoką gausite tik kitais mokestiniais metais. Jei atliekate avansinius mokėjimus, būtinai išsiųskite SAV pranešimą mėnuo iki teisės į išmoką datos.' : null;

        // jeigu pasirenka idv 'Jei pajamas deklaruojate kartą metuose, galimai išmoką gausite tik kitais mokestiniais metais. Jei atliekate avansinius mokėjimus, būtinai išsiųskite SAV pranešimą mėnuo iki teisės į išmoką datos.'
        
        this.vpaIsmokuPaaiskinimai = paaiskinimai[3];

        // sugeneruojame rezultatu lentele
        let rezultatuLentele;
        if (this.nemokamaSkaiciuokle) {
           
            rezultatuLentele =
            `<table id='rezultatuLentele' class='rezultatuLentele gradient'  style='border-collapse: separate !important; border-spacing: .2em !important;'>
            <thead>
            ${createRow(bendrosSumos, bendrosSumosPavadinimas)}
            </thead>
            <tbody class='gradient'>
            ${createRow( vpaIsmokos.slice(0,1), vpaIsmokosPavadinimas, this.nemokamaSkaiciuokle)}
            </tbody>
            </table>
            `
        } else {
        rezultatuLentele =
            `<table id='rezultatuLentele' class='rezultatuLentele'  style='border-collapse: separate !important; border-spacing: .2em !important; position: relative;'>
            <thead>
            <tr>
            <th style='text-align: left; font-size: .75em; text-transform: uppercase;padding-left: .3em; width: 10%;'>${pavadinimai[0]}</th>
            <th style='text-align: left; font-size: .75em; text-transform: uppercase;padding-left: 1em;'">${pavadinimai[1]}</th>
            <th style='text-align: left; font-size: .75em; text-transform: uppercase;padding-left: .3em;'">${pavadinimai[2]}</th>
            <th style='text-align: left; font-size: .75em; text-transform: uppercase;padding-left: .3em;'">${pavadinimai[3]}</th>
            <th style='text-align: left; font-size: .75em; text-transform: uppercase;padding-left: .3em;'">${pavadinimai[4]}</th>
            </tr>
            </thead>
            <tbody>
            ${createRow(motinystesIsmokosEilute, mIsmokosPavadinimas)}
            ${createRow(tevystesIsmokosEilute, tIsmokosPavadinimas)}
            ${createRow(vpaIsmokos, vpaIsmokosPavadinimas)}
            ${createRow(bendrosSumos, bendrosSumosPavadinimas)}
            <tr><td colspan='5' class='segment' style='text-align: center; font-size: .85em; letter-spacing: .1em; text-transform: uppercase; background-color: #D9E1E7; line-height: 2; '>${paaiskinimuPavadinimas}</td></tr>
            ${createExplanationRows(paaiskinimai)}
            </tbody>
            </table>
            `
        }

        this.vpaIsmokos = vpaIsmokos;
        this.bendrosSumos = bendrosSumos;

        return rezultatuLentele;

    }

    ketvirtisIsmokoms(data) {
        let ketv;
        let ketvMaxIsmokai = {
            'metai': null,
            'ketvirtis': null
        };

        if (Math.floor(data.getMonth() / 3) <= 0) {
            ketvMaxIsmokai.metai = data.getFullYear() - 1;
            ketv = 4 + (Math.floor(data.getMonth() / 3));   
        } else {
            ketvMaxIsmokai.metai = data.getFullYear();
            ketv = Math.floor(data.getMonth() / 3);
        };
        ketvMaxIsmokai.ketvirtis = "vdu_" + ketv;
        return ketvMaxIsmokai;
    }

    onFormSubmit(event) {
        event.preventDefault();
        this.getAlert();

        if(this.$element.find('.klaida').length > 0){
            return;
        } 

        this.elements.$alertContainer.empty();
        this.$element.find('#alert').removeClass('nerodyti');


        const result = this.skaiciuotiIsmokas(this.tevystesTarifas, this.motinystesTarifas, this.neperleidziamuMenesiuTarifas, this.tarifasAtostogos18men, this.tarifasAtostogos24men, this.mokesciaiNuoIsmoku, this.vdu, this.bazineSocIsmoka, this.motinystesIsmokaRodyti, this.tevystesIsmokaRodyti, this.vpaIsmokaRodyti, this.vpaTrukme, this.mamaArTetisVpa, this.naudosisNpm, this.mamosPajamuTipas, this.mamosPajamos, this.mamosIslaiduTipas, this.mamosIslaidos, this.tecioPajamuTipas, this.tecioPajamos, this.tecioIslaiduTipas, this.tecioIslaidos, this.gimdymoData);

        if(this.nemokamaSkaiciuokle) {
            this.$element.find('#email').removeClass('nerodyti');
            this.elements.$sendButton.parent().removeClass('nerodyti');
        } else {
            this.elements.$resetButton.parent().removeClass('nerodyti');
        }
         
        
        this.$element.find('#rezultatai').removeClass('nerodyti');

        this.elements.$submitButton.parent().addClass('nerodyti');


        const resultContainer = this.elements.$resultContainer;
        resultContainer.html(result);  
        
    }

    onSend(event) {

        const email = this.elements.$emailInput.val();
        const name = this.elements.$nameInput.val();
        const postId = this.elements.$post_id_input.attr('value');
        const widgetId = this.elements.$widget_id_input.attr('value');
        const validationError = !this.validateEmail(email) || !this.validateName(name);

        if(validationError) {
            if (!this.validateEmail(email)) {
                this.$element.find('#emailInputFieldset').addClass('klaida');
            }  
            if (!this.validateName(name)) {
                this.$element.find('#nameInputFieldset').addClass('klaida');  
            }    
            this.elements.$alertContainer.text('Įveskite savo kontaktinius duomenis');
            this.$element.find('#alert').removeClass('nerodyti');
            return;
        }
        
        const formData = {
            vpaIsmokos: this.vpaIsmokos,
            bendrosSumos: this.bendrosSumos,
            vpaIsmokuPaaiskinimai: this.vpaIsmokuPaaiskinimai,
        };

        const resultContainer = this.$element.find('#result-container-cta');
        const resetBtnDiv = this.elements.$resetButton.parent();
        const sendBtnDiv = this.elements.$sendButton.parent();
        const emailDiv = this.$element.find('#email');
        const loader = this.$element.find('#loader').parent().parent();
        const check = this.$element.find('#check');
        const nonceValue = this.$element.find('#nonce_skaiciuokle').attr('value');

        loader.removeClass('nerodyti');
        sendBtnDiv.addClass('nerodyti');

        jQuery(document).ready(function ($) {

            $.ajax({
                url: my_widget_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'nemokama_skaiciuokle_send_email',
                    calcData: formData,
                    post_id: postId,
                    widget_id: widgetId,
                    source: 'vpa-skaiciuokle-nemokama',
                    name: name,
                    email: email,
                    nonce: nonceValue,
                },
                success: (response) => {

                    if(response.success) {
                    resultContainer.text('Pasitikrinkite savo el. paštą! VPA išmokų detalizacija - jau išsiųsta');
                    resultContainer.css({"color": "green"});
                    loader.addClass('nerodyti');
                    emailDiv.addClass('nerodyti');
                    check.removeClass('nerodyti');
                    setTimeout(function(){
                        check.addClass('nerodyti');
                    },3000);
                    setTimeout(function(){
                        resetBtnDiv.removeClass('nerodyti');
                    }, 3010);
                    } else {
                        resultContainer.text('Laiško išsiųsti nepavyko. Susisiekite su svetainės administratoriumi.');
                        resultContainer.css({"color": "red"});
                        loader.addClass('nerodyti');
                        emailDiv.addClass('nerodyti');
                        resetBtnDiv.removeClass('nerodyti');
                    }
                },
                error: (error) => {
                    console.error('Error:', error);
                    //alert('Error: ' + error.responseText);
                }
            });
        });
    }

    onReset(event) {

        event.preventDefault();
        location.reload();

    }

    getAlert(){
        
        if(this.vpaIsmokaRodyti  || this.motinystesIsmokaRodyti || this.tevystesIsmokaRodyti ) {
            
            let re = new RegExp(/(20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])/);
        
                this.generateAlert(this.gimdymoData === '' || this.gimdymoData === null, '#gimdymo-data');
                this.generateAlert(!re.test(this.gimdymoData), '#gimdymo-data', 'Įveskite gimdymo datą tinkamu formatu, t.y. "YYYY-MM-DD"');
            
            
                if (this.vpaIsmokaRodyti) {
                this.generateAlert(this.vpaTrukme === null, '#vpa-trukme');
                this.generateAlert(this.mamaArTetisVpa === null, '#vpa-ims');
                this.generateAlert(this.naudosisNpm === null, '#npm-naudosis');
            }
        
        
            
            if(this.mamaArTetisVpa === 1 || (this.mamaArTetisVpa === 2 && this.naudosisNpm) || this.motinystesIsmokaRodyti) {
            this.generateAlert(this.mamosPajamuTipas === null, '#mamos-pajamu-tipas');
            this.generateAlert(this.mamosPajamos <= 0 || isNaN(this.mamosPajamos), '#mamos-pajamos');
                if (this.mamosPajamuTipas === 2) {
                    this.generateAlert(this.mamosIslaiduTipas === null, '#mamos-islaidu-tipas');
                    if (this.mamosIslaiduTipas === 2) {
                        this.generateAlert(this.mamosIslaidos === 0 || isNaN(this.mamosIslaidos), '#mamos-faktines-islaidos');
                    }
                }
            }
            
            if(this.mamaArTetisVpa === 2 || (this.mamaArTetisVpa === 1 && this.naudosisNpm) || this.tevystesIsmokaRodyti) {
                this.generateAlert(this.tecioPajamuTipas === null, '#tecio-pajamu-tipas');
                this.generateAlert(this.tecioPajamos <= 0 || isNaN(this.tecioPajamos), '#tecio-pajamos');
                if (this.tecioPajamuTipas === 2) {
                    this.generateAlert(this.tecioIslaiduTipas === null, '#tecio-islaidu-tipas');
                    if (this.tecioIslaiduTipas === 2) {
                        this.generateAlert(this.tecioIslaidos === 0 || isNaN(this.tecioIslaidos), '#tecio-faktines-islaidos');
                    }
                }
            }
            
        }
        
    }

    generateAlert(conditionToGenerateAlert, fieldsetIDToAddStyling, alertText) {
        if (conditionToGenerateAlert) {
            this.$element.find(fieldsetIDToAddStyling).addClass('klaida');
            this.$element.find('#alert').removeClass('nerodyti');
            this.elements.$alertContainer.text(alertText ? alertText : 'Užpildykite raudonai pažymėtus laukelius ir spauskite "SKAIČIUOTI"');

          } else {
            this.$element.find(fieldsetIDToAddStyling).removeClass('klaida');
          }
    }

    validateEmail(email) {

        // Test for the minimum length the email can be
        if (email.trim().length < 6) {
            return false;
        }
    
        // Test for an @ character after the first position
        if (email.indexOf('@', 1) < 0) {
            return false;
        }
    
        // Split out the local and domain parts
        const parts = email.split('@', 2);
    
        // LOCAL PART
        // Test for invalid characters
        if (!parts[0].match(/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~\.-]+$/)) {
            return false;
        }
    
        // DOMAIN PART
        // Test for sequences of periods
        if (parts[1].match(/\.{2,}/)) {
            return false;
        }
    
        const domain = parts[1];
        // Split the domain into subs
        const subs = domain.split('.');
        if (subs.length < 2) {
            return false;
        }
    
        const subsLen = subs.length;
        for (let i = 0; i < subsLen; i++) {
            // Test for invalid characters
            if (!subs[i].match(/^[a-z0-9-]+$/i)) {
                return false;
            }
        }
    
        return true;
    };

    validateName(name) {
        // Trim the input to remove extra spaces
        const trimmedName = name.trim();
    
        // Check if the length is less than 2
        if (trimmedName.length < 2) {
            return false;
        }
    
        // Regular expression to allow only letters, spaces, hyphens, and apostrophes
        const nameRegex = /^[a-zA-ZĄČĘĖĮŠŲŪŽąčęėįšųūž\s'-]+$/;
    
        // Validate against the regular expression
        if (!nameRegex.test(trimmedName)) {
            return false;
        }
    
        // Check for potential script injection (disallowing `<`, `>`, and `&`)
        if (/[\<\>\/\\\&]/.test(trimmedName)) {
            return false;
        }
    
        return true;  // If all checks pass, the name is valid
    }
    


//class closing bracket
}

// Initialize the handler
jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/ismoku_skaiciuokle_nemokama.default', ($scope) => {
        new MyCustomWidgetHandler({ $element: $scope });
    });

});



