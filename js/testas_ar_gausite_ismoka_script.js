class TestasArGausiteIsmokaHandler extends elementorModules.frontend.handlers.Base {

    getDefaultSettings() {
        return {
            selectors: {
                radioBtns: 'input[type="radio"]',
                btnDiv: '#buttons',
                sendDiv: '#send-div',
                resetDiv: '#resetDiv',
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
        }
    }


    onInit() {

        super.onInit();

        

        //get widget settings data
        this.duomenysSkaiciavimams = this.getElementSettings();
        this.mokamaSkaiciuokle = this.duomenysSkaiciavimams['skaiciuokles_tipas'];
        this.vdu = this.duomenysSkaiciavimams['vdu_control'];
        this.tevystesTarifas = this.duomenysSkaiciavimams['tevystes_tarifas'];
        this.motinystesTarifas = this.duomenysSkaiciavimams['motinystes_tarifas'];
        this.neperleidziamuMenesiuTarifas = this.duomenysSkaiciavimams['npm_tarifas'];
        this.tarifasAtostogos18men = this.duomenysSkaiciavimams['vpa_18_tarifas'];
        this.tarifasAtostogos24men = [
            this.duomenysSkaiciavimams['vpa_24_tarifas_1'], 
            this.duomenysSkaiciavimams['vpa_24_tarifas_2']
        ];
        this.mokesciaiNuoIsmoku = this.duomenysSkaiciavimams['mokesciu_tarifas'];
        this.bazineSocIsmoka = this.duomenysSkaiciavimams[ 'bazine_soc_ismoka'];
        this.minimumas = this.duomenysSkaiciavimams['minimumas'];
        
        //nemokama skaiciuokle
        this.nemokamaSkaiciuokle = this.mokamaSkaiciuokle === undefined;
    }


    bindEvents() {

        const elements = this.getDefaultElements();

        for (let i = 0; i < elements.$radioBtns.length; i++) {
            const name = elements.$radioBtns[i].getAttribute('name');
            const value = elements.$radioBtns[i].value;
            this.$element.find('input[type="radio"][name="' + name + '"][value="' + value + '"]').on('click', () => this.conditionalFieldDisplay(name, value));
            //elements.$radioBtns[i].on('click', () => this.conditionalFieldDisplay(name, value));            
        }
        
        
    }

    conditionalFieldDisplay(name, value) {

        const obj = {
            ar_vykde_veikla: {
                Ne: 'nevykde_veiklos_ats', 
                Taip: 'kokiu_principu_dirbo'
            },
            kokiu_principu_dirbo: {
                DS: 'dirbo_su_DS_ats', 
                VL: 'dirbo_su_VL_ats', 
                miksuotai: 'dirbo_miksuotai_ats', 
                MB: 'kaip_gauna_pajamas_MB',
                IDV: 'ar_naudojosi_lengvatom'
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

        const answers = {
            nevykde_veiklos_ats: 'Išmokos galimai Jums nepriklausys. Detalesnę informaciją gausite įvedę savo el. pašto adresą:',
            dirbo_su_VL_ats: 'Išmokos galimai Jums nepriklausys. Detalesnę informaciją gausite įvedę savo el. pašto adresą:',
            dirbo_su_DS_ats: 'Išmokos galimai Jums priklausys. Detalesnę informaciją gausite įvedę savo el. pašto adresą:',
            dirbo_miksuotai_ats: 'Reikėtų vertinti individualiai, ar Jums išmokos galimai priklauso. Detalesnę informaciją gausite įvedę savo el. pašto adresą:',
            IDV_naudojosi_lengvatomis_ats: 'Išmokos galimai Jums nepriklausys. Detalesnę informaciją gausite įvedę savo el. pašto adresą:',
            IDV_pajamos_mazesnes_ats: 'Reikėtų individualiai vertinti, ar išmokos Jums galimai priklausys. Detalesnę informaciją gausite įvedę savo el. pašto adresą:',
            IDV_mokesciai_karta_per_metus_ats: 'Išmokos galimai Jums priklausys, bet gali būti neišmokėtos laiku. Detalesnę informaciją gausite įvedę savo el. pašto adresą:',
            IDV_mokesciai_kas_menesi_ats: 'Išmokos galimai Jums priklausys. Detalesnę informaciją gausite įvedę savo el. pašto adresą:',
            MB_pajamos_paslaugos_pelnas_ats: 'Išmokos galimai Jums nepriklausys. Detalesnę informaciją gausite įvedę savo el. pašto adresą:',
            MB_be_vsd_imoku_ats: 'Išmokos galimai Jums nepriklausys. Detalesnę informaciją gausite įvedę savo el. pašto adresą:',
            MB_vsd_imokos_savarankiskai_ats: 'Išmokos galimai Jums priklausys, bet šiuo atveju rekomenduotina situaciją vertinti ir individualiai. Detalesnę informaciją gausite įvedę savo el. pašto adresą:'
        }

        const emailAnswers = {
            nevykde_veiklos_ats: 'Išmokos Jums galimai nepriklauso, jei dirbote trumpiau nei 12 mėnesių per paskutinius 24 mėnesius iki teisės į išmoką dienos, kadangi gali pritrūkti sukaupto socialinio motinystės stažo. Socialiniam motinystės stažui sukaupti reikia bent 12 mėnesių per paskutinius 24 metus.',
            dirbo_su_VL_ats: 'Deja, bet motinystės išmokos Jums galimai nepriklauso. Dirbantieji su verslo liudijimu nemoka pilnų VSD įmokų, į kurias nėra įtrauktas socialinio motinystės draudimas, todėl nėra sukaupiamas ir reikiamas socialinis motinystės stažas, ko pasekoje nėra skiriamos motinystės išmokos.',
            dirbo_su_DS_ats: 'Tikėtina, kad reikiamą socialinį motinystės stažą būsite sukaupę, kurio reikia bent 12 mėnesių per paskutinius 24 metus ir motinystės išmokas gausite. Dirbant su DS, šis stažas kaupiasi nuo sutarties pasirašymo dienos ir neturi įtakos ar dirbote pertraukiamai, ar nepertraukiamai, šis stažas yra kaupiamas kas mėnesį, tad nebūtina dirbti nepertraukiamai, svarbu, kad šis socialinis motinystės stažas būtų sukauptas per paskutinius 24 mėnesius.',
            dirbo_miksuotai_ats: 'Reikėtų individualiai vertinti, ar Jums tikrai priklauso motinystės išmokos. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant su Darbo sutartimi, stažas kaupiamas nuo pat darbo sutarties pasirašymo dienos ir visai nesvarbu, ar dirbote pertraukiamai, ar nepertraukiamai, šis stažas yra kaupiamas kas mėnesį. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio. Svarbu žinoti, kad visos draudžiamosios pajamos, nuo kurių mokėjote pilnas VSD įmokas, bus įtrauktos į išmokų apskaičiavimą. Pvz.: dirbote su DS ir su IDV, tuomet vertinamos tiek iš DS, tiek iš IDV gaunamos draudžiamosios pajamos. Bet jei dirbote su VL ir MB - tuomet jau kyla klausimų, ar tikrai priklausys motinystės išmokos, nes galimai neturite pilno valstybinio socialinio draudimo. Taip pat, visus kompleksiniu atvejus yra naudingiau vertinti individualiai, kadangi skirtingoms situacijoms, gali būti randami skirtingi sprendimai ir galimybės.',
            IDV_naudojosi_lengvatomis_ats: 'Deja, bet tikėtina, kad motinystės išmokų negausite. Naudojantis IDV lengvata, nėra mokamos socialinio draudimo įmokos (VSD). Atitinkamai asmenys, nemokantys socialinio draudimo įmokų, nėra draudžiami ir todėl motinystės išmokų negauna. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio. Jums gali būti aktualu peržiūrėti video įrašą apie „Motinystės Išmokos dirbant su IDV“, jame visi šie „slidūs“ niuansai yra paaiškinami su kartu pateikiamais patarimais.',
            IDV_pajamos_mazesnes_ats: 'Kadangi nurodėte, kad Jūsų metinės pajamos iš IDV sudaro mažiau, nei 18 000 €, reikėtų individualiai vertinti, ar uždirbtų pajamų kiekis suteiks reikalingą socialinį motinystės stažą, kuris yra reikalingas išmokos gauti. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio. Jums gali būti aktualu peržiūrėti video įrašą apie „Motinystės Išmokos dirbant su IDV“, jame visi šie „slidūs“ niuansai yra paaiškinami su kartu pateikiamais patarimais.',
            IDV_mokesciai_karta_per_metus_ats: 'Tikėtina, kad motinystės išmokos Jums priklausys, tik gali būti neišmokėtos laiku, kai mokesčiai mokami kartą per metus. Tokiu atveju rekomenduojama pradėti daryti avansinius mokėjimus ir siųsti SAV pranešimus Sodrai kas mėnesį. Detalias gaires, kaip tai padaryti su vaizdiniais pavyzdžiais ir paaiškinimais galite rasti prisijungę prie uždaros VPA grupės arba įsijus Atmintinę nr. 3, kurioje yra pateikiama instrukcija kaip atlikti šiuos mokėjimus ir išsiųsti SAV pranešimus Sodrai. Taip pat jums gali būti aktualu peržiūrėti video įrašą apie Motinystės Išmoks dirbant su IDV, jame visi šie „slidūs“ niuansai yra paaiškinami su kartu pateikiamais patarimais.',
            IDV_mokesciai_kas_menesi_ats: 'Tikėtina, kad motinystės išmokos Jums priklauso ir gausite jas laiku, nes Sodra laiku matys visą informacija. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio. Taip pat jums gali būti aktualu peržiūrėti video įrašą apie „Motinystės Išmokos dirbant su IDV“, jame visi šie „slidūs“ niuansai yra paaiškinami su kartu pateikiamais patarimais.',
            MB_pajamos_paslaugos_pelnas_ats: 'Kadangi gaunate pajamas tik pagal civilinę paslaugų teikimo sutartį arba pasiskirstant pelną, taigi, nesate drausti valstybiniu socialiniu draudimu ir tikėtina, kad motinystės išmokos Jums nepriklausys. Nebent kas mėnesį pelną išsiiminėjote avansu kaip asmeniniams poreikiams tenkinti skirtas lėšas – tokiu atveju VSD įmokos yra mokamos ir tikėtina, kad kaupiate socialinį motinystės stažą. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio.',
            MB_be_vsd_imoku_ats: 'Deja, bet tikėtina, kad motinystės išmokų negausite. Nemokantys socialinio draudimo įmokų savarankiškai nėra draudžiami ir atitinkamai motinystės išmokų negauna. Nebent dirbate MB du darbo sutartimi. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio. Taip pat jums gali būti aktualu peržiūrėti video įrašą apie „Motinystės Išmokos dirbant su IDV arba turint savo MB“, jame visi šie „slidūs“ niuansai yra paaiškinami su kartu pateikiamais patarimais.',
            MB_vsd_imokos_savarankiskai_ats: 'Tikėtina, kad gausite motinystės išmokas. Motinystės išmokų skyrimui vienas svarbiausių momentų yra, ar asmuo yra sukaupęs reikiamą socialinį motinystės stažą, kurio reikia sukaupti bent 12 mėnesių per paskutinius 24  mėnesius. Dirbant savarankiškai, socialinio motinystės stažo kaupimas priklauso nuo sumos, nuo kurios mokame VSD įmokas. Sumokame nuo 1 MMA (šiuo metu tai yra 924 eur) – sukaupiame vieną mėnesį. Sumokame daugiau/mažiau nei 1 MMA – atitinkamai stažo sukaupiame proporcingai daugiau arba mažiau. Tai reiškia, kad nesame įpareigoti išdirbti bent 12 mėnesių, kaip yra dirbant su darbo sutartimi, nes stažo trukmė priklauso nuo sumokėtų įmokų dydžio. Visgi, dėl komplikuoto MB ir socialinių garantijų santykio, praverstų detaliau įsivertinti, kokias įmokas ir kokiu formatu mokėjote. Tai galima būtų padaryti individualios konsultacijos metu.'
        }

        
        if (obj.hasOwnProperty(name)) {
            let result = obj[name][value];

            let fieldId = result.endsWith('ats') ? '#ats-txt' : '#q-' + result;

            let elementUntil = result.endsWith('ats') ? this.$element.find('#ats') : this.elements.$btnDiv;
            let elementFrom = result.endsWith('ats') ?  this.$element.find('#q-' + name) : this.$element.find(fieldId);

            if(result.endsWith('ats')){
                this.$element.find(fieldId).text(answers[result]);
                this.$element.find('#q-email').removeClass('nerodyti');
                this.$element.find('#ats').removeClass('nerodyti');
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
// closing of the class
}

// Initialize the handler
jQuery(window).on('elementor/frontend/init', () => {
    elementorFrontend.hooks.addAction('frontend/element_ready/testas_ar_gausite_ismoka.default', ($scope) => {
        new TestasArGausiteIsmokaHandler({ $element: $scope });
    });

});