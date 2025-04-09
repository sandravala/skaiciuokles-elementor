class MaxDuVpaSkaiciuokleHandler extends elementorModules.frontend.handlers
  .Base {
  onInit() {
    super.onInit();
    
    // Initialize class variables
    this.galimasDu = undefined;
    this.monthlyVDU = undefined;
    this.ismoka = undefined;
    this.duText = undefined;
    this.maxVDU = this.elements.mainContainer.data("vdu");
    
    // Ensure additional result is hidden at start
    if (this.elements && this.elements.additionalResult) {
      this.elements.additionalResult.addClass('is-hidden');
    }
  }

  getDefaultSettings() {
    return {
      selectors: {
        mainContainer: ".max_du_vpa_skaiciuokle",
        duSuma: "#du_suma",
        ismoka: "#ismoka",
        calcBtnMain: "#main-calc-btn",
        mainResults: "#main-results",
        resultDu: "#result-du",
        resultIsmoka: "#result-ismoka",
        additionalSection: "#additional-calc",
        duIsDs: "#du_is_ds",
        etatasIsDs: "#etatas_is_ds",
        additionalCalcCheck: "#additional-calc-check",
        resultEtatas: "#result-etatas",
        clearBtnAdd: "#additional-clear-btn",
        calcBtnAdd: "#additional-calc-btn",
        clearBtnMain: "#main-clear-btn",
        errorMsgMain: "#error-msg-main",
        errorMsg: "#error-msg",
        additionalCalcFields: "#additional-calc-fields",
        etatoTipasRadios: 'input[name="etato_tipas"]',
        additionalResult: ".additional-result",
        mainResultDu: "#main-result-du",     // Make sure these IDs match your HTML
        mainResultEtatas: "#main-result-etatas", // Make sure these IDs match your HTML
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings("selectors");
    const widgetId = this.$element.data("widget-id");
    return {
      duSuma: this.$element.find(selectors.duSuma),
      ismoka: this.$element.find(selectors.ismoka),
      calcBtnMain: this.$element.find(selectors.calcBtnMain),
      mainResults: this.$element.find(selectors.mainResults),
      resultDu: this.$element.find(selectors.resultDu),
      resultIsmoka: this.$element.find(selectors.resultIsmoka),
      additionalSection: this.$element.find(selectors.additionalSection),
      duIsDs: this.$element.find(selectors.duIsDs),
      etatasIsDs: this.$element.find(selectors.etatasIsDs),
      additionalCalcCheck: this.$element.find(selectors.additionalCalcCheck),
      resultEtatas: this.$element.find(selectors.resultEtatas),
      clearBtnAdd: this.$element.find(selectors.clearBtnAdd),
      calcBtnAdd: this.$element.find(selectors.calcBtnAdd),
      clearBtnMain: this.$element.find(selectors.clearBtnMain),
      errorMsgMain: this.$element.find(selectors.errorMsgMain),
      errorMsg: this.$element.find(selectors.errorMsg),
      additionalCalcFields: this.$element.find(selectors.additionalCalcFields),
      etatoTipasRadios: this.$element.find(selectors.etatoTipasRadios),
      additionalResult: this.$element.find(selectors.additionalResult),
      mainResultDu: this.$element.find(selectors.mainResultDu),
      mainResultEtatas: this.$element.find(selectors.mainResultEtatas),
      mainContainer: this.$element.find(selectors.mainContainer)
    };
  }

  bindEvents() {
    this.elements.calcBtnMain.on("click", (e) => {
      e.preventDefault();
      this.calculateMain();
    });

    this.elements.additionalCalcCheck.on("change", (e) => {
      e.preventDefault();
      this.displayAdditionalCalcFields(e.target);
    });

    // Add event listener for the additional calculation button
    this.elements.calcBtnAdd.on("click", (e) => {
      e.preventDefault();
      this.calculateAdditional();
    });

    // Add event listener for radio buttons
    this.elements.etatoTipasRadios.on("change", (e) => {
      e.preventDefault();
      this.handleRadioChange(e.target);
    });

    this.elements.clearBtnMain.on("click", (e) => {
      e.preventDefault();
      this.clearAll();
    });
    
    this.elements.clearBtnAdd.on("click", (e) => {
      e.preventDefault();
      this.clearAll();
    });
  }

  handleRadioChange(radio) {
    const etatasContainer = this.elements.etatasIsDs.parent();

    if (radio.value === "fiksuotas") {
      // Show the Etatas is DS field when "DU FIKSUOTAS" is selected
      etatasContainer.show();
    } else if (radio.value === "valandinis") {
      // Hide the Etatas is DS field when "DU VALANDINIS" is selected
      etatasContainer.hide();
    }
  }

  calculateMain() {

    let ismokaVal = this.checkInput(this.elements.ismoka);
    let vduVal = this.checkInput(this.elements.duSuma);
    if (ismokaVal === false || vduVal === false) return;

    let monthlyVDU = vduVal / 12;
    this.galimasDu = 0;
    
    if(monthlyVDU > this.maxVDU * 5) {
      this.galimasDu = this.maxVDU * 5;
    } else
     if((monthlyVDU - ismokaVal) > 0) {
      this.galimasDu = (monthlyVDU - ismokaVal).toFixed(2);
    }

    // Store these values for later use in additional calculation
    this.monthlyVDU = monthlyVDU;
    this.duText = "DU suma, kuri nemažina VPA išmokos*: " + this.galimasDu + " €";
    this.ismoka = ismokaVal;
    // Assume answerText is set via widget settings and passed to the handler
    this.elements.resultDu.text(this.duText);
    this.elements.additionalSection.show();
    this.elements.mainResults.removeClass("is-hidden");
    this.elements.clearBtnMain.removeClass("is-hidden");
    
    
  }

  calculateAdditional() {

    if (typeof this.galimasDu === "undefined") {

      this.elements.errorMsg.removeClass("is-hidden");
      console.log("typeof this.galimasDu === undefined");
      return;
    }
    

    
    // Get the selected radio button value
    let etatoTipas = this.elements.etatoTipasRadios.filter(":checked").val();
    // Check if duIsDs has a valid value
    let duIsDsVal = this.checkInput(this.elements.duIsDs);
    let etatas;
    if (etatoTipas === "fiksuotas") {
      let etatasIsDsVal = this.checkInput(this.elements.etatasIsDs);
      if (duIsDsVal === false || etatasIsDsVal === false) return;
        etatas = (this.galimasDu / (duIsDsVal / etatasIsDsVal)).toFixed(2) + " etato";
    } else if (etatoTipas === "valandinis") {
      if (duIsDsVal === false ) return;
      etatas = (this.galimasDu / duIsDsVal).toFixed(2) + " val. / mėn.";
    }
    
    // Display the result

    this.elements.mainResultDu.text(this.duText);
    this.elements.mainResultEtatas.text("Galite dirbti " + etatas + ", kad gautumėte " + this.galimasDu + " € DU ir " + this.ismoka + " € išmoką.");
    
    // Hide main results and show additional results
    this.elements.mainResults.addClass("is-hidden");
    this.elements.additionalResult.removeClass("is-hidden");
    

    this.elements.clearBtnAdd.removeClass("is-hidden");

  }
  clearAll() {
    // Reset inputs
    this.elements.duSuma.val("");
    this.elements.ismoka.val("");
    this.elements.duIsDs.val("");
    this.elements.etatasIsDs.val("");
    
    // Reset text elements
    this.elements.resultDu.text("");
    this.elements.resultIsmoka.text("");
    this.elements.mainResultDu.text("");
    this.elements.mainResultEtatas.text("");
    this.elements.resultEtatas.text("");
    
    // Reset class variables
    this.galimasDu = undefined;
    this.monthlyVDU = undefined;
    this.duText = undefined;
    
    // Uncheck the checkbox
    this.elements.additionalCalcCheck.prop('checked', false);
    
    // Hide and show appropriate elements
    this.elements.additionalSection.hide();
    this.elements.mainResults.addClass("is-hidden");
    this.elements.clearBtnMain.addClass("is-hidden");
    this.elements.calcBtnMain.removeClass("is-hidden");
    this.elements.additionalCalcFields.addClass("is-hidden");
    this.elements.additionalResult.addClass("is-hidden");
    this.elements.clearBtnAdd.addClass("is-hidden");
    this.elements.calcBtnAdd.addClass("is-hidden");
    this.elements.errorMsg.addClass("is-hidden");
    this.elements.errorMsgMain.addClass("is-hidden");
    
    // Reset any error styling
    this.elements.duSuma.parent().removeClass("klaida");
    this.elements.ismoka.parent().removeClass("klaida");
    this.elements.duIsDs.parent().removeClass("klaida");
    this.elements.etatasIsDs.parent().removeClass("klaida");
  }
  
  // Removed clearAdditional method as we're using clearAll for both buttons

  checkInput($input) {
    let inputStr = $input.val().replace(/,/g, '.');
    let inputVal = parseFloat(inputStr);
    
    
    if (isNaN(inputVal) || inputVal <= 0) {
      $input.parent().addClass("klaida");
      this.elements.errorMsg.removeClass("is-hidden");
      return false;
    } else {
      $input.parent().removeClass("klaida");
      this.elements.errorMsg.addClass("is-hidden");
      return inputVal;
    }
  }

  displayAdditionalCalcFields(checkbox) {
    // Toggle additional fields visibility based on checkbox state
    this.elements.additionalCalcFields[0].classList.toggle("is-hidden", !checkbox.checked);
    
    if (checkbox.checked) {
      // Hide main results and show calculation button
      this.elements.mainResults[0].classList.add("is-hidden");
      this.elements.clearBtnMain[0].classList.add("is-hidden");
      this.elements.calcBtnMain[0].classList.add("is-hidden");
      this.elements.calcBtnAdd[0].classList.remove("is-hidden");
      
      // Hide additional result section until calculation is performed
      this.elements.additionalResult.addClass("is-hidden");
      
      // Initialize radio button state
      // const checkedRadio = this.elements.etatoTipasRadios.filter(":checked");
      // if (checkedRadio.length) {
      //   this.handleRadioChange(checkedRadio[0]);
      // }
    } else {
      // Show main results when unchecked
      this.elements.mainResults[0].classList.remove("is-hidden");
      this.elements.clearBtnMain[0].classList.remove("is-hidden");
      this.elements.calcBtnAdd[0].classList.add("is-hidden");
      this.elements.clearBtnAdd[0].classList.add("is-hidden");
      
      // Hide additional result
      this.elements.additionalResult.addClass("is-hidden");
    }
  }
}

// Initialize the handler
jQuery(window).on("elementor/frontend/init", () => {
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/max_du_vpa_skaiciuokle.default",
    ($scope) => {
      new MaxDuVpaSkaiciuokleHandler({ $element: $scope });
    }
  );
});