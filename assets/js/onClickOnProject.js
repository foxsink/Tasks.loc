const routes = require('../../public/js/fos_js_routes.json');

import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

Routing.setRoutingData(routes);
$(document).ready(function() {
    $(document).on('change', 'select#day_report_project', function (e) {
        let urlAjax  = Routing.generate('app_dayreport_dayreportajax')
        console.log(urlAjax)
        let id = $(e.currentTarget).val()
        $.ajax({
            url: urlAjax,
            type: 'POST',
            dataType: 'json',
            data: {'projectId' : id },
            success: function (data) {
                let result = JSON.parse(data)
                let out = "<option value = \"\">Add new task</option>"
                for (let i in result) {
                    out += "<option value = \"" + result[i]['id'] + "\">" + result[i]['title'] + "</option>"
                }
                $('select#day_report_task').html(out).show()
                $('input#day_report_taskName').show()
            },
            error: function () {
                $('select#day_report_task').html('').hide()
                $('input#day_report_taskName').hide()
            }
        })
    })
    $(document).on('change', 'select#day_report_task', function (e) {
        let id = $(this).val()

        if (id != '') {
            $('input#day_report_taskName').hide()
            $('button#day_report_submit').show()
        } else {
            $('button#day_report_submit').hide()
            $('input#day_report_taskName').show()
        }

    })
    $(document).on('input', 'input#day_report_taskName', function (e) {
        if ($(this).val()  == '') {
            $('button#day_report_submit').hide()
        } else {
            $('button#day_report_submit').show()
        }

    })
    $(document).on('click', 'button#day_report_submit', function (e) {
        $(this).submit()
    })
})