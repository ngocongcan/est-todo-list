
$(document).ready(function ($) {

    $(".btn-add-task").on('click', function () {
        openTaskModal(this);
    });

    $(".btn-edit-task").on('click', function () {
        openTaskModal(this);
    });

    $(".btn-delete-task").on('click', function () {
        deleteTask(this);
    });

    $(".btn-submit-task").on('click', function () {
        addOrUpdateTask(this);
    });
});

function deleteTask(element) {

    console.log('Delete Task');
    var tr = $(element).closest('tr');
    var id = $(tr).find('#id').text();
    id = parseInt(id);
    console.log('Delete Task id : ' + id);
    var request = $.ajax({
        url: "ajax.php",
        method: "POST",
        data: { id: id, action: 'delete' },
        dataType: "JSON"
    });

    request.done(function(response){
        console.log(response);
        $('#taskModal').modal('hide');
        if (response.success == true) {
            location.reload(true);
        }
    });

    request.fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        $('#taskModal').modal('hide');
    });

}

function addOrUpdateTask() {
    console.log('Add Task');
    var id = $('#taskModal').find('#id').val();
    var name = $('#taskModal').find('#name').val();
    var status = $('#taskModal').find('#status').val();
    var start_date = $('#taskModal').find('#start_date').val();
    var end_date = $('#taskModal').find('#end_date').val();
    console.log('Add Task name : ' + name);
    console.log('Add Task status : ' + status);
    console.log('Add Task start_date : ' + start_date);
    console.log('Add Task end_date : ' + end_date);
    var action = id ? 'update' : 'create';
    var request = $.ajax({
        url: "ajax.php",
        method: "POST",
        data: { action: action, id: id, name : name, status: status, start_date: start_date, end_date: end_date },
        dataType: "JSON"
    });

    request.done(function( response ) {
        console.log(response);
        $('#taskModal').modal('hide');
        location.reload(true);
    });

    request.fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        $('#taskModal').modal('hide');
    });
}


function openTaskModal(element) {
    var tr = $(element).closest('tr');
    if (tr) {
        var id = $(tr).find('#id').text();
        var name = $(tr).find('#name').text();
        var status = $(tr).find('#status').data('status');
        var start_date = $(tr).find('#start_date').text();
        var end_date = $(tr).find('#end_date').text();
        $('#taskModal').find('.modal-title').text('Edit task ' + name);
        $('#taskModal').find("#id").val(id);
        $('#taskModal').find("#name").val(name);
        $('#taskModal').find("#status").val(status);
        $('#taskModal').find("#start_date").val(start_date);
        $('#taskModal').find("#end_date").val(end_date);
    }
    openModal();
}

function openModal() {
    $('#taskModal').modal('show');
}
