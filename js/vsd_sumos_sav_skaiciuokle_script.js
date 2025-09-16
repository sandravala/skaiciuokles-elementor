class VSDsumosSAVSkaiciuokleHandler extends elementorModules.frontend.handlers
  .Base {
  onInit() {
    super.onInit();
    
    // Initialize class variables
    this.islaidos = undefined;
    this.pajamos = undefined;
    this.pensijuKaupimas = false;
    this.islaiduTipas = "islaidos30"; // Default to 30% if not selected
    
  }

  getDefaultSettings() {
    return {
      selectors: {
        mainContainer: ".vsd_sumos_sav_skaiciuokle",
        pajamos: "#pajamos-input",
        islaiduTipasRadios: 'input[name="islaidu-tipas"]',
        faktinesIslaidosInput: "#faktinesIslaidosInput",
        calcBtn: "#main-calc-btn",
        mainResults: "#main-results",
        resultVSDsuma: "#result-vsd-suma",
        clearBtnMain: "#main-clear-btn",
        errorMsgMain: "#error-msg-main",
        errorMsg: "#error-msg",
        pensijuKaupimasRadios: 'input[name="papildomas-pensiju-kaupimas"]',

      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings("selectors");
    const widgetId = this.$element.data("widget-id");
    return {
      mainContainer: this.$element.find(selectors.mainContainer),
      pajamos: this.$element.find(selectors.pajamos),
      islaiduTipasRadios: this.$element.find(selectors.islaiduTipasRadios),
      faktinesIslaidosInput: this.$element.find(selectors.faktinesIslaidosInput),
      calcBtn: this.$element.find(selectors.calcBtn),
      mainResults: this.$element.find(selectors.mainResults),
      resultVSDsuma: this.$element.find(selectors.resultVSDsuma),
      clearBtnMain: this.$element.find(selectors.clearBtnMain),
      errorMsg: this.$element.find(selectors.errorMsgMain),
      pensijuKaupimasRadios: this.$element.find(selectors.pensijuKaupimasRadios),
    };
  }

  bindEvents() {
    this.elements.calcBtn.on("click", (e) => {
      e.preventDefault();
      this.calculateMain();
    });

    this.elements.pajamos.on("input", () => {
      this.checkInput(this.elements.pajamos);
    });

    this.elements.faktinesIslaidosInput.on("input", () => {
      this.checkInput(this.elements.faktinesIslaidosInput);
    });


    // Add event listener for radio buttons
    this.elements.islaiduTipasRadios.on("change", (e) => {
      e.preventDefault();
      this.handleIslaiduTipasChange(e.target);
    });

    this.elements.pensijuKaupimasRadios.on("change", (e) => {
      e.preventDefault();
      this.pensijuKaupimas = e.target.value === "taip";
    });

    this.elements.clearBtnMain.on("click", (e) => {
      e.preventDefault();
      this.clearAll();
    });
    
  }

  handleIslaiduTipasChange(radio) {
    const islaiduFaktasContainer = this.elements.faktinesIslaidosInput.closest("fieldset");

    if (radio.value === "islaidosFaktas") {

      this.islaiduTipas = "islaidosFaktas";
      islaiduFaktasContainer.show();
    } else if (radio.value === "islaidos30") {

      this.islaiduTipas = "islaidos30";
      islaiduFaktasContainer.hide();
    }
  }

  calculateMain() {

    let pajamosVal = this.checkInput(this.elements.pajamos);
    if (pajamosVal === false) return;
    let islaidosVal = 0;

    if (this.islaiduTipas === "islaidos30") {
      islaidosVal = pajamosVal * 0.3;
    } else if (this.islaiduTipas === "islaidosFaktas") {
      let faktinesIslaidosVal = this.checkInput(this.elements.faktinesIslaidosInput);
      if (faktinesIslaidosVal === false) return;
      islaidosVal = faktinesIslaidosVal;
    }

    let vsdTarifas = this.pensijuKaupimas ? 0.1552 : 0.1252;
    let vsdSuma = (pajamosVal - islaidosVal) * 0.9 * vsdTarifas;

    this.vsdSumaText = "VSD suma, kurią turite nurodyti SAV pranešime: " + vsdSuma.toFixed(2) + " €";

    this.elements.resultVSDsuma.text(this.vsdSumaText);

    this.elements.mainResults.removeClass("is-hidden");
    this.elements.clearBtnMain.removeClass("is-hidden");
    
    
  }

  
  clearAll() {
    // Reset inputs
    this.elements.pajamos.val("");
    this.elements.faktinesIslaidosInput.val("");
        
    // // Reset text elements
    this.elements.resultVSDsuma.text("");
    
    // // Reset class variables
    this.islaidos = undefined;
    this.pajamos = undefined;
    this.pensijuKaupimas = false;
    this.islaiduTipas = "islaidos30"; // Default to 30% if not selected
    
    // // Uncheck the checkbox
    this.elements.pensijuKaupimasRadios.prop("checked", false);
    // // Reset radio buttons to default (30% expenses)
    this.elements.islaiduTipasRadios.prop("checked", false);
    this.elements.islaiduTipasRadios.filter('[value="islaidos30"]').prop("checked", true);
    this.elements.faktinesIslaidosInput.closest("fieldset").hide();
    
    // // Hide and show appropriate elements
  
    this.elements.mainResults.addClass("is-hidden");
    this.elements.clearBtnMain.addClass("is-hidden");
    this.elements.errorMsg.addClass("is-hidden");
    
    // // Reset any error styling
    this.elements.pajamos.closest("fieldset").removeClass("klaida");
    this.elements.faktinesIslaidosInput.closest("fieldset").removeClass("klaida");
  }
  
  // Removed clearAdditional method as we're using clearAll for both buttons

  checkInput($input) {
    let inputStr = $input.val().replace(/,/g, '.');
    let inputVal = parseFloat(inputStr);
    if (isNaN(inputVal) || inputVal <= 0) {
      $input.closest("fieldset").addClass("klaida");
      this.elements.errorMsg.removeClass("is-hidden");
      return false;
    } else {
      //find input ancestor fieldset and remove error class
      $input.closest("fieldset").removeClass("klaida");
      this.elements.errorMsg.addClass("is-hidden");
      return inputVal;
    }
  }


}

// Initialize the handler
jQuery(window).on("elementor/frontend/init", () => {
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/vsd_sumos_sav_skaiciuokle.default",
    ($scope) => {
      new VSDsumosSAVSkaiciuokleHandler({ $element: $scope });
    }
  );
});