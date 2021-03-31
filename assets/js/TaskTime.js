const routes = require('../../public/js/fos_js_routes.json');

import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

Routing.setRoutingData(routes);


$(document).ready(function() {
    $(document).on('click', '.add_item_link', function(e) {
        let $collectionHolderClass = $(this).data('collectionHolderClass');
        addFormToCollection($collectionHolderClass);
    })
});

$(document).ready(function() {
    $(document).on('click', '.delete_item', function(e) {
        let taskTimeRow = $(this).closest('div[id*=task_taskTimes]')
        taskTimeRow.remove();
    });
});

function addFormToCollection($collectionHolderClass) {

    // Get the ul that holds the collection of tags
    let $collectionHolder = $('.' + $collectionHolderClass);

    // Get the data-prototype explained earlier
    let prototype = $collectionHolder.data('prototype');

    // get the new index
    let index = $collectionHolder.data('index');

    let newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    let $newFormLi = $('<li></li>').append(newForm);
    // Add the new form at the end of the list
    $collectionHolder.append($newFormLi)
}

