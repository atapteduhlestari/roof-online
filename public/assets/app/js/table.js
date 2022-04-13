$(document).ready(function () {
    $('#dataTable').DataTable();
});

let collapseBtn = $('#collapseBtn');

$('#collapseTable').on('shown.bs.collapse', function () {
    collapseBtn.text('Hide Table')
});

$('#collapseTable').on('hidden.bs.collapse', function () {
    collapseBtn.text('Show Table')
});
