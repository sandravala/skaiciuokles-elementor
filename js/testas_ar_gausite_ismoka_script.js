const answers = {
    nevykde_veiklos_ats: [
        'Išmokos galimai Jums nepriklausys. ', 
        'Išmokos Jums galimai nepriklauso, jei dirbote trumpiau nei 12 mėnesių per paskutinius 24 mėnesius iki teisės į išmoką dienos, kadangi gali pritrūkti sukaupto socialinio motinystės stažo. Socialiniam motinystės stažui sukaupti reikia bent 12 mėnesių per paskutinius 24 metus.',
    ],
    dirbo_uzsienyje_ats: [
        'Jei paskutinė darbovietė buvo ne Lietuvoje, tikėtina, kad motinystės išmokos Lietuvoje negalės būti skiriamos, nebent turite teisę persikelti turimą stažą.',
        'Jei dirbote ir mokėjote mokesčius ES ir/ar EEE valstybėse, sukauptą socialinį motinystės stažą galite persikelti į Lietuvą ir pretenduoti gauti motinystės išmokas Lietuvoje. Tačiau svarbu, kad paskutinė darbo vieta būtų buvusi Lietuvoje, kitaip motinystės išmokos gali būti neskirtos. Persikelti socialinį motinystės stažą galite kreipiantis į Sodrą, kur padės užpildyti prašymą, kad būtų gauta informacija apie jūsų įgytą socialinį motinystės stažą kitoje ES ir/ar EEE valstybėje.'
    ],
    dirbo_vpa_ats: [
        'Motinystės išmokos priklausys, net jeigu socialinio motinystės stažo ir pritrūko dėl to, kad asmuo buvo VPA ar buvo gaunamos VPA išmokos su kitu vaiku.',
        'Būnant VPA ir gaunant VPA išmokas, socialinis motinystės stažas nenutrūksta. Tačiau gali susidaryti situacijų, kuomet asmuo naudojosi VPA savo darbovietėje, nors iš Sodros nebegavo jokių išmokų. Tokiu atveju, jei su darbdaviu darbo santykiai nėra nutrūkę ir reikiamo socialinio motinystės stažo pritrūksta naujoms motinystės išmokoms su kitu vaiku dėl to, kad asmuo buvo VPA su prieš tai gimusiu vaiku – gali būti taikoma išimtis ir įskaitomas stažas. Tačiau visad rekomenduojame pasitikrinti savo sukauptą stažą. Tai galite padaryti prisijungę prie savo Sodros gyventojo paskyros ir kairėje pusėje pasirinkę “Nauja suvestinė” - jums bus reikalinga 37 suvestinė. Detalesnes instrukcijas ir video įrašą, kaip pasitikrinti turimą stažą bei sužinoti, kada ir kaip yra kaupiamas stažas ir kitus svarbius niuansus, kurie yra reikalingi norint gauti palankesnes motinystės išmokas - galite rasti ir prisijungę prie uždaros VPA grupės.'
    ],
    dirbo_su_VL_ats: [
        'Išmokos galimai Jums nepriklausys. ',
        'Deja, bet motinystės išmokos Jums galimai nepriklauso. Dirbantieji su verslo liudijimu nemoka pilnų VSD įmokų, į kurias nėra įtrauktas socialinio motinystės draudimas, todėl nėra sukaupiamas ir reikiamas socialinis motinystės stažas, ko pasekoje nėra skiriamos motinystės išmokos.'
    ],
    dirbo_su_DS_ilgiau_ats: [
        'Išmokos galimai Jums priklausys. ',
        'Tikėtina, kad reikiamą socialinį motinystės stažą būsite sukaupę, kurio reikia bent 12 mėnesių per paskutinius 24 metus ir motinystės išmokas gausite. Dirbant su DS, šis stažas kaupiasi nuo sutarties pasirašymo dienos ir neturi įtakos ar dirbote pertraukiamai, ar nepertraukiamai, šis stažas yra kaupiamas kas mėnesį, tad nebūtina dirbti nepertraukiamai, svarbu, kad šis socialinis motinystės stažas būtų sukauptas per paskutinius 24 mėnesius.'
    ],
    dirbo_su_DS_trumpiau_ats: [
        'Iš pateiktos informacijos kyla abejonių, ar turite sukaupę reikiamą socialinį motinystės stažą motinystės išmokoms gauti',
        'Tam , kad gautumėte motinystės išmokas, jums reikia turėti sukaupus reikalingą socialinį motinystės stažą. Iki motinystės išmokų skyrimo datos, jo turi būti sukaupta ne mažiau kaip 12 mėnesių per paskutinius 2 metus. Tad net jei buvo dirbama su pertraukomis, bet turimo motinystės stažo sukaupėte bent 12 mėnesių, jo turėtų pakakti. Jei dvejojate dėl savo sukaupto stažo, jį galite pasitikrinti, prisijungę prie savo Sodros gyventojo paskyros ir kairėje pusėje pasirinkę “Nauja suvestinė” - jums bus reikalinga 37 suvestinė. Svarbi informacija – tėvystės atostogoms, kurios skirtos tik tėčiams ir trunka 30 kalendorinių dienų – reikiamo stažo reikalavimas yra sumažintas, pakanka kai jo yra sukaupta bent 6 mėnesiai per paskutinius 24 mėnesius. Detalesnes instrukcijas ir video įrašą, kaip pasitikrinti turimą stažą, taip pat sužinoti, kada ir kaip yra kaupiamas stažas ir kitus svarbius niuansus, kurie yra reikalingi, norint gauti palankesnes motinystės išmokas - galite rasti ir prisijungę prie uždaros VPA grupės.'
    ],
    dirbo_miksuotai_ats: [
        'Reikėtų vertinti individualiai, ar Jums išmokos galimai priklauso. ',
        'Reikėtų individualiai vertinti, ar Jums tikrai priklauso motinystės išmokos. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant su Darbo sutartimi, stažas kaupiamas nuo pat darbo sutarties pasirašymo dienos ir visai nesvarbu, ar dirbote pertraukiamai, ar nepertraukiamai, šis stažas yra kaupiamas kas mėnesį. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio. Svarbu žinoti, kad visos draudžiamosios pajamos, nuo kurių mokėjote pilnas VSD įmokas, bus įtrauktos į išmokų apskaičiavimą. Pvz.: dirbote su DS ir su IDV, tuomet vertinamos tiek iš DS, tiek iš IDV gaunamos draudžiamosios pajamos. Bet jei dirbote su VL ir MB - tuomet jau kyla klausimų, ar tikrai priklausys motinystės išmokos, nes galimai neturite pilno valstybinio socialinio draudimo. Taip pat, visus kompleksiniu atvejus yra naudingiau vertinti individualiai, kadangi skirtingoms situacijoms, gali būti randami skirtingi sprendimai ir galimybės.'
    ],
    IDV_naudojosi_lengvatomis_ats: [
        'Išmokos galimai Jums nepriklausys. ',
        'Deja, bet tikėtina, kad motinystės išmokų negausite. Naudojantis IDV lengvata, nėra mokamos socialinio draudimo įmokos (VSD). Atitinkamai asmenys, nemokantys socialinio draudimo įmokų, nėra draudžiami ir todėl motinystės išmokų negauna. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio. Jums gali būti aktualu peržiūrėti video įrašą apie „Motinystės Išmokos dirbant su IDV“, jame visi šie „slidūs“ niuansai yra paaiškinami su kartu pateikiamais patarimais.'
    ],
    IDV_pajamos_mazesnes_ats: [
        'Reikėtų individualiai vertinti, ar išmokos Jums galimai priklausys. ',
        'Kadangi nurodėte, kad Jūsų metinės pajamos iš IDV sudaro mažiau, nei 18 000 €, reikėtų individualiai vertinti, ar uždirbtų pajamų kiekis suteiks reikalingą socialinį motinystės stažą, kuris yra reikalingas išmokos gauti. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio. Jums gali būti aktualu peržiūrėti video įrašą apie „Motinystės Išmokos dirbant su IDV“, jame visi šie „slidūs“ niuansai yra paaiškinami su kartu pateikiamais patarimais.'
    ],
    IDV_mokesciai_karta_per_metus_ats: [
        'Išmokos galimai Jums priklausys, bet gali būti neišmokėtos laiku. ',
        'Tikėtina, kad motinystės išmokos Jums priklausys, tik gali būti neišmokėtos laiku, kai mokesčiai mokami kartą per metus. Tokiu atveju rekomenduojama pradėti daryti avansinius mokėjimus ir siųsti SAV pranešimus Sodrai kas mėnesį. Detalias gaires, kaip tai padaryti su vaizdiniais pavyzdžiais ir paaiškinimais galite rasti prisijungę prie uždaros VPA grupės arba įsijus Atmintinę nr. 3, kurioje yra pateikiama instrukcija kaip atlikti šiuos mokėjimus ir išsiųsti SAV pranešimus Sodrai. Taip pat jums gali būti aktualu peržiūrėti video įrašą apie Motinystės Išmoks dirbant su IDV, jame visi šie „slidūs“ niuansai yra paaiškinami su kartu pateikiamais patarimais.'
    ],
    IDV_mokesciai_kas_menesi_ats: [
        'Išmokos galimai Jums priklausys. ',
        'Tikėtina, kad motinystės išmokos Jums priklauso ir gausite jas laiku, nes Sodra laiku matys visą informacija. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio. Taip pat jums gali būti aktualu peržiūrėti video įrašą apie „Motinystės Išmokos dirbant su IDV“, jame visi šie „slidūs“ niuansai yra paaiškinami su kartu pateikiamais patarimais.'
    ],
    MB_pajamos_paslaugos_pelnas_ats: [
        'Išmokos galimai Jums nepriklausys. ',
        'Kadangi gaunate pajamas tik pagal civilinę paslaugų teikimo sutartį arba pasiskirstant pelną, taigi, nesate drausti valstybiniu socialiniu draudimu ir tikėtina, kad motinystės išmokos Jums nepriklausys. Nebent kas mėnesį pelną išsiiminėjote avansu kaip asmeniniams poreikiams tenkinti skirtas lėšas – tokiu atveju VSD įmokos yra mokamos ir tikėtina, kad kaupiate socialinį motinystės stažą. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio.'
    ],
    MB_be_vsd_imoku_ats: [
        'Išmokos galimai Jums nepriklausys. ',
        'Deja, bet tikėtina, kad motinystės išmokų negausite. Nemokantys socialinio draudimo įmokų savarankiškai nėra draudžiami ir atitinkamai motinystės išmokų negauna. Nebent dirbate MB du darbo sutartimi. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio. Taip pat jums gali būti aktualu peržiūrėti video įrašą apie „Motinystės Išmokos dirbant su IDV arba turint savo MB“, jame visi šie „slidūs“ niuansai yra paaiškinami su kartu pateikiamais patarimais.'
    ],
    MB_vsd_imokos_savarankiskai_ats: [
        'Išmokos galimai Jums priklausys, bet šiuo atveju rekomenduotina situaciją vertinti ir individualiai. ',
        'Tikėtina, kad gausite motinystės išmokas. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio. Visgi, dėl komplikuoto MB ir socialinių garantijų santykio, praverstų detaliau įsivertinti, kokias įmokas ir kokiu formatu mokėjote. Tai galima būtų padaryti individualios konsultacijos metu.'
    ],
};

class TestasArGausiteIsmokaHandler extends elementorModules.frontend.handlers.Base {

    getDefaultSettings() {
        return {
            selectors: {
                radioBtns: 'input[type="radio"]',
                btnDiv: '#buttons',
                sendDiv: '#send-div',
                resetDiv: '#resetDiv',
                emailInput: '#emailInput',
                nameInput: '#nameInput',
                resetButton: '#testo_forma button[type="reset"].formbox__btn-reset',
                sendButton: '#testo_forma button[type="button"].formbox__btn-send',
                alertContainer: '#testo_forma #alert-container-skaiciuokle',
                widgetIdInput: '#widget_id',
                postIdInput: '#post_id',
            }
        }
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $radioBtns: this.$element.find(selectors.radioBtns),
            $btnDiv: this.$element.find(selectors.btnDiv),
            $sendDiv: this.$element.find(selectors.sendDiv),
            $resetDiv: this.$element.find(selectors.resetDiv),
            $emailInput: this.$element.find(selectors.emailInput),
            $nameInput: this.$element.find(selectors.nameInput),
            $resetButton: this.$element.find(selectors.resetButton),
            $sendButton: this.$element.find(selectors.sendButton),
            $alertContainer: this.$element.find(selectors.alertContainer),
            $post_id_input: this.$element.find(selectors.postIdInput),
            $widget_id_input: this.$element.find(selectors.widgetIdInput),
        }
    }


    onInit() {

        super.onInit();

        this.emailAnswer = '';
    }


    bindEvents() {

        const elements = this.getDefaultElements();

        for (let i = 0; i < elements.$radioBtns.length; i++) {
            const name = elements.$radioBtns[i].getAttribute('name');
            const value = elements.$radioBtns[i].value;
            this.$element.find('input[type="radio"][name="' + name + '"][value="' + value + '"]').on('click', () => this.conditionalFieldDisplay(name, value));           
        }
        
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
        
        this.elements.$resetButton.on('click', this.onReset.bind(this));
        this.elements.$sendButton.on('click', this.onSend.bind(this));


    }

    conditionalFieldDisplay(name, value) {

        const obj = {
            ar_vykde_veikla: {
                Ne: 'nevykde_veiklos_ats', 
                Taip: 'kur_dirbo'
            },
            kur_dirbo: {
                lt: 'kokiu_principu_dirbo',
                uzsienis: 'dirbo_uzsienyje_ats',
                vpa: 'dirbo_vpa_ats',
            },
            kokiu_principu_dirbo: {
                DS: 'nepertraukiamai_dirbo_ilgiau', 
                VL: 'dirbo_su_VL_ats', 
                miksuotai: 'dirbo_miksuotai_ats', 
                MB: 'kaip_gauna_pajamas_MB',
                IDV: 'ar_naudojosi_lengvatom'
            },
            nepertraukiamai_dirbo_ilgiau: {
                taip: 'dirbo_su_DS_ilgiau_ats',
                ne: 'dirbo_su_DS_trumpiau_ats'
            },
            kaip_gauna_pajamas_MB: {
                Taip: 'MB_pajamos_paslaugos_pelnas_ats',
                Ne: 'ar_moka_VSD_MB'
            },
            ar_moka_VSD_MB: {
                Taip: 'MB_vsd_imokos_savarankiskai_ats',
                Ne: 'MB_be_vsd_imoku_ats'
            },
            ar_naudojosi_lengvatom: {
                Taip: 'IDV_naudojosi_lengvatomis_ats',
                Ne: 'metines_IDV_pajamos'
            },
            metines_IDV_pajamos: {
                maziau: 'IDV_pajamos_mazesnes_ats',
                daugiau: 'kaip_moka_mokescius_IDV'
            },
            kaip_moka_mokescius_IDV: {
                kas_metus: 'IDV_mokesciai_karta_per_metus_ats',
                kas_menesi: 'IDV_mokesciai_kas_menesi_ats'
            }
        }
    
        
        if (obj.hasOwnProperty(name)) {
            let result = obj[name][value];

            let fieldId = result.endsWith('ats') ? '#ats-txt' : '#q-' + result;

            let elementUntil = result.endsWith('ats') ? this.$element.find('#ats') : this.elements.$btnDiv;
            let elementFrom = result.endsWith('ats') ?  this.$element.find('#q-' + name) : this.$element.find(fieldId);

            if(result.endsWith('ats')){
                this.emailAnswer = answers[result][1];
                this.$element.find(fieldId).text(answers[result][0]);
                this.$element.find('#ats').removeClass('nerodyti');
                this.$element.find('#cta-txt').removeClass('nerodyti');
                this.elements.$sendDiv.removeClass('nerodyti');
            } 

            elementFrom.nextUntil(elementUntil).each(function() {
                jQuery(this).addClass('nerodyti');
                jQuery(this).find('input[type="radio"]').prop('checked', false);
            })

            this.$element.find(fieldId).removeClass('nerodyti');

            
        } 

    }

    nerodyti(element) {
        element.addClass('nerodyti');
    }

    rodyti(element) {
        element.removeClass('nerodyti');
    }



    onSend() {

        const answer = this.emailAnswer;
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

        const resultContainer = this.$element.find('#cta-txt');
        const resetBtnDiv = this.elements.$resetButton.parent();
        const sendBtnDiv = this.elements.$sendButton.parent();
        const emailDiv = this.$element.find('#email');
        const loader = this.$element.find('#loader').parent().parent();
        const check = this.$element.find('#check');

        loader.removeClass('nerodyti');
        sendBtnDiv.addClass('nerodyti');

        jQuery(document).ready(function ($) {
            $.ajax({
                url: my_widget_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'testas_send_email',
                    post_id: postId,
                    widget_id: widgetId,
                    source: 'testas-ar-gausite-ismoka',
                    name: name,
                    email: email,
                    answer: answer,
                },
                success: (response) => {
                    resultContainer.text('Pasitikrinkite savo el. paštą! Papildoma informacija apie VPA išmokos gavimą - jau išsiųsta');
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
                },
                error: (error) => {
                    console.error('Error:', error);
                    //alert('Error: ' + error.responseText);
                }
            });
        });

    }

    onReset() {
        event.preventDefault();
        location.reload();
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
        const nameRegex = /^[a-zA-Z\s'-]+$/;
    
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

    // closing of the class

}

// Initialize the handler
jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/testas_ar_gausite_ismoka.default', ($scope) => {
        new TestasArGausiteIsmokaHandler({ $element: $scope });
    });

});