    const triggerTabList = document.querySelectorAll('button[data-bs-toggle="tab"]');
    triggerTabList.forEach((triggerEl) => {
        const tabTrigger = new bootstrap.Tab(triggerEl);

        triggerEl.addEventListener("click", (event) => {
            DataTable.tables({ visible: true, api: true }).columns.adjust();
        });
    });


$(document).ready(function (e) {
    'use strict';

    // basic datatable
    $('#datatable-basic').DataTable({
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
        "pageLength": 10,
        scrollX: true
    });
    // basic datatable

    // responsive datatable
    $('#responsiveDataTable').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
        "pageLength": 10,
    });
    // responsive datatable

    // responsive modal datatable
    $('#responsivemodal-DataTable').DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return data[0] + ' ' + data[1];
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        }
    });
    // responsive modal datatable

    // file export datatable
    $('#file-export').DataTable({
        dom: 'Bfrtip',
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        scrollX: true,
        "pageLength": 5,
        
    })

    // file export datatable
    $('#file-export-one').DataTable({
        dom: 'Bfrtip',
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        scrollX: true,
        "pageLength": 5,
    });
    // file export datatable

    // file export datatable
    $('#file-export-two').DataTable({
        dom: 'Bfrtip',
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        scrollX: true,
        "pageLength": 5,
    });
    // file export datatable

    // file export datatable
    $('#file-export-three').DataTable({
        dom: 'Bfrtip',
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        scrollX: true,
        "pageLength": 5,
    });
    // file export datatable

    // file export datatable
    var editTable = $('#file-export-edit').DataTable({
        dom: 'Bfrtip',
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        scrollX: true
    });

    // $('').on( 'click', 'tbody td:not(:first-child)', function (e) {
    //     editTable.inline(cell.node(), { onChange: 'submit' });
    //     console.log("editTable")
    // });

    var editable = false;
    $('#file-export-edit td:not(:first-child, .last)').on('dblclick', function(){
        if(editable == false){
            var val = $(this).text().replace(' \n','');
            var html = `<input type="number" min="0" name="table-input" value="${$.trim(val)}" class="form-control p-0 inputVal">`;
            $(this).html(html)
            editable = true;
        }
        else{
            var val = $('input.inputVal').val();
            $('input.inputVal').closest('td').html(val)
            editable = false;   
        }
        // console.log(val);

      
        
    })



    // file export datatable

    // delete row datatable
    var table = $('#delete-datatable').DataTable({
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        }
    });
    $('#delete-datatable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#button').on("click", function () {
        table.row('.selected').remove().draw(false);
    });
    // delete row datatable

    // scroll vertical 
    $('#scroll-vertical').DataTable({
        // language: {
        //     sSearch: false,
        // },
        searching: false,
        info: false,
        ordering: false,
        paging: false,
        scrollY: '265px',
        scrollCollapse: true,
        paging: false,
        scrollX: true,
    });
    // scroll vertical 

    // hidden columns
    $('#hidden-columns').DataTable({
        columnDefs: [
            {
                target: 2,
                visible: false,
                searchable: false,
            },
            {
                target: 3,
                visible: false,
            },
        ],
        "pageLength": 10,
        scrollX: true
    });
    // hidden columns
    
    // add row datatable
    var t = $('#add-row').DataTable();
    var counter = 1;
    $('#addRow').on('click', function () {
        t.row.add([counter + '.1', counter + '.2', counter + '.3', counter + '.4', counter + '.5']).draw(false);
        counter++;
    });
    // add row datatable





    // $('.collapse').on('shown.bs.collapse', function (e) {
    //     $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    // });

});




