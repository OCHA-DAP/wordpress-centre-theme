(function ($) {
    function additionalInformation(rowData) {
        return ('' +
            '<ul class="extra-info">' +
            ((rowData.Description) ?
                '<li><span class="column-title">Description:<\/span> ' + rowData.Description + '<\/li>'
                : '') +
            ((rowData['Update frequency']) ?
                '<li><span class="column-title">Update frequency:<\/span> ' + rowData['Update frequency'] + '<\/li>'
                : '') +
            ((rowData['Link to model code (if available)']) ?
                '<li><span class="column-title">Link to model code:<\/span> ' + rowData['Link to model code (if available)'] + '<\/li>'
                : '') +
            ((rowData['Main contacts']) ?
                '<li><span class="column-title">Main contacts:<\/span> ' + rowData['Main contacts'] + '<\/li>'
                : '') +
            ((rowData['Additional documentation']) ?
                '<li><span class="column-title">Additional documentation:<\/span> ' + rowData['Additional documentation'] + '<\/li>'
                : '') +
            '<\/ul>'
        );
    }

    $(document).ready(function () {
        let columnSeparator = {
            1: ',',
            2: ';'
        };
        let $table = $('#pa_table');
        let dataTable = $table.DataTable({
            'searching': true,
            'pageLength': -1,
            'lengthMenu': [[1, 5, 10, 25, 50, 100, -1], [1, 5, 10, 25, 50, 100, 'All']],
            'ajax': {
                'url': $table.data('url'),
                'dataSrc': '',
                'type': 'GET'
            },
            'columnDefs': [
                {
                    // add collapse button
                    render: function (data) {
                        return '<i class="fa collapse-button"><\/i> ' + data;
                    },
                    // first column
                    targets: 0,
                },
            ],
            'columns': [
                {title: 'Model name', data: 'Model name', width: '25%'},
                {title: 'Partners involved', data: 'Partners involved *', width: '25%'},
                {title: 'Topic', data: 'Topic *', width: '25%'},
                {title: 'Geographical scope', data: 'Geographical scope *', width: '25%'},
            ],
            'initComplete': function () {
                this.api().columns([1, 2]).every(function (index) {
                    let filterValues = [];
                    let column = this;
                    let columnName = $table.find('th').eq([index]).text();

                    // get values
                    column.data().each(function (data) {
                        if (columnSeparator[index]) {
                            let separator = columnSeparator[index];
                            let separatedValues = data.split(separator);
                            for (let i = 0; i < separatedValues.length; i++) {
                                let separatedValue = separatedValues[i].trim();
                                // unique
                                if (separatedValue && !filterValues.includes(separatedValue)) {
                                    filterValues.push(separatedValue);
                                }
                            }
                        } else {
                            // unique
                            if (!filterValues.includes(data)) {
                                filterValues.push(data);
                            }
                        }
                    });
                    filterValues = filterValues.sort(); // sort values

                    // select
                    let $container = $('<div class="pa-table-filter"><label>' + columnName + '<select class="column-filter"></select></label></div>');
                    let select = $container.find('select');
                    $container.prependTo($('#pa_table_filters'));
                    // initial value
                    select.append('<option value="">All</option>');
                    // other values
                    for (let k = 0; k < filterValues.length; k++) {
                        select.append('<option value="' + filterValues[k] + '">' + filterValues[k] + '</option>');
                    }
                    // filter
                    select.on('change', function () {
                        let val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? val : '', true, false).draw();
                    });
                });
            },
        });
        // add event listener for opening and closing details
        $table.find('tbody').on('click', 'td .collapse-button', function () {
            let tr = $(this).closest('tr');
            let row = dataTable.row(tr);

            if (row.child.isShown()) {
                // this row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // open this row
                row.child(additionalInformation(row.data())).show();
                tr.addClass('shown');
            }
        });
    });
})(jQuery);
