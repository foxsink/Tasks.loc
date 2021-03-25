const routes = require('../../public/js/fos_js_routes.json');

import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

Routing.setRoutingData(routes);
$(document).ready(function() {

    $(document).on('change', 'select#day_report_projects', function (e) {
        let url  = Routing.generate('app_dayreport_dayreportajax');
        let id = $(e.currentTarget).val();
        $.ajax({
            url: url,
            type: 'POST',
            // dataType: 'json',
            data: {'projectId' : id },
            success: function (data) {
                $('div.tasks-form').html(data)
            },
            error: function (d) {
                $('div.tasks-form').html('');
            }
        });
    });
    $(document).on('change', 'select#tasks_tasks', function (e) {
        let btn = $('a.btn.btn-primary');
        console.log(btn);
        let id = $(e.currentTarget).val();
        if (id) {
            btn.text('Edit');
            btn.attr('href', Routing.generate('tasksksksk'))//TODO edit routing
        }

    });

});