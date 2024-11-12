var uniqueIdCounter = 0;

function generateUniqueId() {
    return ++uniqueIdCounter;
}

function getNextYear(data) {
    let maxYear = 0;
    _.each(data, function (value, year) {
        if (parseInt(year) > maxYear) {
            maxYear = parseInt(year);
        }
    });
    return maxYear + 1;
}

var VduControl = elementor.modules.controls.BaseMultiple.extend({

    events: {
        'click #add-control-row-button': 'onAddRow',
        'click .delete-row': 'onDeleteRow',
        'input .vdu': 'onInputChange'
    },

    initialize: function () {

        elementor.modules.controls.BaseMultiple.prototype.initialize.apply(this, arguments);
        this.rows = this.getControlValue();
        if (_.isEmpty(this.rows)) {
            this.rows = this.model.get('custom_control_table');
            this.saveRows();
        }
        
        this.listenTo(this.model, 'change:custom_control_table', this.renderRows); 
    },


    fetchVduData() {  
    },

    onReady: function () {
        this.renderRows();
    },

    render: function () {
        elementor.modules.controls.BaseMultiple.prototype.render.apply(this, arguments);
        this.renderRows();
    },

    renderRows: function () {
        var rowsContainer = this.$el.find('#dynamic-rows');
        rowsContainer.empty();
        var rowCount = Object.keys(this.rows).length;
        var fragment = document.createDocumentFragment();
        for (var metai in this.rows) {
            fragment.appendChild(this.createRowElement(this.rows[metai], metai, rowCount));
        }
        rowsContainer.append(fragment);
    },

    createRowElement: function (rowData, metai, rowCount) {
        var row = document.createElement('tr');

        var deleteButtonCell = document.createElement('td');
        var deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'elementor-button elementor-button-danger delete-row';
        deleteButton.setAttribute('data-metai', metai);
        deleteButton.innerText = 'x';
        if (rowCount === 1) {
            deleteButton.disabled = true;
            deleteButton.style.backgroundColor = '#ecebeb';
        }
        deleteButtonCell.appendChild(deleteButton);

        var metaiCell = document.createElement('td');
        var metaiInput = document.createElement('input');
        metaiInput.type = 'text';
        metaiInput.className = 'vdu metai-input';
        metaiInput.setAttribute('data-setting', 'custom_control_table[metai]');
        metaiInput.value = metai;
        metaiCell.appendChild(metaiInput);

        var input1Cell = document.createElement('td');
        var input1 = document.createElement('input');
        input1.type = 'text';
        input1.className = 'vdu vdu-1';
        input1.setAttribute('data-setting', 'custom_control_table[' + metai + '][vdu_1]');
        input1.value = rowData.vdu_1 || '';
        input1Cell.appendChild(input1);

        var input2Cell = document.createElement('td');
        var input2 = document.createElement('input');
        input2.type = 'text';
        input2.className = 'vdu vdu-2';
        input2.setAttribute('data-setting', 'custom_control_table[' + metai + '][vdu_2]');
        input2.value = rowData.vdu_2 || '';
        input2Cell.appendChild(input2);

        var input3Cell = document.createElement('td');
        var input3 = document.createElement('input');
        input3.type = 'text';
        input3.className = 'vdu vdu-3';
        input3.setAttribute('data-setting', 'custom_control_table[' + metai + '][vdu_3]');
        input3.value = rowData.vdu_3 || '';
        input3Cell.appendChild(input3);

        var input4Cell = document.createElement('td');
        var input4 = document.createElement('input');
        input4.type = 'text';
        input4.className = 'vdu vdu-4';
        input4.setAttribute('data-setting', 'custom_control_table[' + metai + '][vdu_4]');
        input4.value = rowData.vdu_4 || '';
        input4Cell.appendChild(input4);

        row.appendChild(deleteButtonCell);
        row.appendChild(metaiCell);
        row.appendChild(input1Cell);
        row.appendChild(input2Cell);
        row.appendChild(input3Cell);
        row.appendChild(input4Cell);

        return row;
    },

    addRow: function (rowData, metai) {
        var rowsContainer = this.$el.find('#dynamic-rows');
        rowsContainer.append(this.createRowElement(rowData, metai));
    },

    onAddRow: function (event) {
        
        var newMetai = getNextYear(this.model.get('custom_control_table').length ? this.model.get('custom_control_table') : this.rows);        
        
        var newRowData = {
            vdu_1: '',
            vdu_2: '',
            vdu_3: '',
            vdu_4: ''
        };

        this.rows[newMetai] = newRowData;
        this.addRow(newRowData, newMetai);
        this.saveRows();
    },

    onDeleteRow: function (event) {
        var metai = jQuery(event.currentTarget).data('metai');
        delete this.rows[metai];
        this.renderRows();
        this.saveRows();
    },

    onInputChange: function (event) {
        var metai = jQuery(event.target).closest('tr').find('.metai-input').val();
        var inputType = jQuery(event.target).data('setting').split('[').pop().split(']').shift();
        this.rows[metai][inputType] = event.target.value;
        this.saveRows();
    },

    saveRows: function () {

        this.setValue(this.rows);
        this.model.set('custom_control_table', this.rows);
        this.model.trigger('change');
 
    },
    
    setValue: function(key, value) {
        
        var newValues;
        if ('object' === typeof key) {
            newValues = key;
        } else {
            newValues = {};
            newValues[key] = value;
        }
        this.setSettingsModel(newValues);
    },

    onBeforeDestroy: function () {
        this.stopListening(this.model, 'change:custom_control_table', this.renderRows); // Stop listening to model changes
    }
});

elementor.addControlView('vdu', VduControl);
