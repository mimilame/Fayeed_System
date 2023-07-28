(function($) {
    "use strict";

    // Enable child rows for Example 1
    var table = $('#example').DataTable({
        responsive: {
            // Control responsive breakpoints
            breakpoints: [
                { name: 'desktop-large', width: Infinity },
                { name: 'desktop', width: 1200 },
                { name: 'tablet', width: 992 },
                { name: 'phone-large', width: 768 },
                { name: 'phone', width: 576 }
            ],
            // Set non-responsive columns (columns you want to be always visible)
            details: {
                type: 'column',
                target: 'tr'
            }

        },
        columnDefs: [
            {
                className: 'dtr-control',
                orderable: false,
                target: 0
            }
        ],
        order: [1, 'asc'],

    });



    // Enable child rows for Example 2
    var table2 = $('#example2').DataTable({
        responsive: {
            // Control responsive breakpoints
            breakpoints: [
                { name: 'desktop-large', width: Infinity },
                { name: 'desktop', width: 1200 },
                { name: 'tablet', width: 992 },
                { name: 'phone-large', width: 768 },
                { name: 'phone', width: 576 }
            ],
            // Set non-responsive columns (columns you want to be always visible)
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [
            {
                className: 'dtr-control',
                orderable: false,
                target: 0
            }
        ],
        order: [1, 'asc'],

    });

    // Enable child rows for No table
    var table2 = $('#notable').DataTable({
        responsive: {
            // Control responsive breakpoints
            breakpoints: [
                { name: 'desktop-large', width: Infinity },
                { name: 'desktop', width: 1200 },
                { name: 'tablet', width: 992 },
                { name: 'phone-large', width: 768 },
                { name: 'phone', width: 576 }
            ],
            // Set non-responsive columns (columns you want to be always visible)
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [
            {
                className: 'dtr-control',
                orderable: false,
                target: 0
            }
        ],
        info: false,           // Disable the "Showing X of Y entries" information
        ordering: false,       // Disable column sorting
        paging: false,         // Disable pagination (previous and next buttons)
        lengthChange: false,   // Disable the "Show X entries" dropdown
        searching: false,      // Disable the search bar

        order: [1, 'asc'],

    });

})(jQuery);