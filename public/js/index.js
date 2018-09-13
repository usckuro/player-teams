$().ready(function() {
    $.ajax({
        url: '/api/team', type: 'GET',
        success: function (data) {
            var table_body = $('#teams-table tbody');

            $.each(data, function (key, item) {
                table_body.append('<tr data-id="' + item.id + '"><td>' + item.name + '</td><td>' + item.players_count + '</td></tr>');
            });

            callPlayersTeams(table_body);
        }
    })
});

function callPlayersTeams(table_body){
    $(table_body).find('tr').on('click', function(){
        var team = $(this);

        var players_table =$('#players-table tbody');

        players_table.data('team', team.data('id'));

        players_table.empty();

        $.ajax({
            url: '/api/team/' + team.data('id'),
            method: 'GET',
            success: function(data){
                $('#modal-title').html(data.name);

                $.each(data.players, function (key, item) {
                    players_table.append('<tr data-team="'+ team.data('id') +'" data-id="' + item.id + '"><td>'+ item.name +'</td><td class="text-center">' +
                        '<button onclick="editPlayer(this);" ' + 'class="btn-primary btn">Edit</button>' +
                        '<button onclick="savePlayer(this);" ' + 'class="btn-success btn d-none">Save</button></td></tr>');
                });
            }
        });

        $('#players-modal').modal('show');
    });
}

function editPlayer(val){
    var tr = $(val).closest('tr');
    var td = $(tr).find('td:first');
    var name = td.text();
    td.html("<input type='text' value='"+ name +"' class='form'>");

    $(tr).find('.d-none').removeClass('d-none');
    $(val).addClass('d-none');
}

function savePlayer(val){
    var players_table =$('#players-table tbody');
    var tr = $(val).closest('tr');
    var td = $(tr).find('td:first');
    var input = $(tr).find('input[type=text]');
    var team_id = players_table.data('team');


    $.ajax({
        url: '/api/team/' + team_id + '/player/' + $(tr).data('id'),
        method: 'POST',
        data: {_method: 'PUT', name: input.val()},
        headers: {'content-type': 'application/x-www-form-urlencoded'},
        success: function(data){
            td.html(data.name);
            $(tr).find('.d-none').removeClass('d-none');
            $(val).addClass('d-none');
        }
    });
}

function storePlayer(val){
    var players_table =$('#players-table tbody');
    var tr = $(val).closest('tr');
    var td = $(tr).find('td:first');
    var input = $(tr).find('input[type=text]');
    var team_id = players_table.data('team');


    $.ajax({
        url: '/api/team/' + team_id + '/player',
        method: 'POST',
        data: {name: input.val()},
        headers: {'content-type': 'application/x-www-form-urlencoded'},
        success: function(data){
            td.html(data.name);
            $(tr).data('id', data.id)
            $(tr).closest('.d-none').removeClass('d-none');
            $(val).addClass('d-none');
            $(val).on('click', savePlayer(val));
        }
    });
}

function addPlayer(){
    var players_table =$('#players-table tbody');

    players_table.append("<tr><td><input type='text' value='' class='form'></td>" +
        "<td class='text-center'><button onclick='editPlayer(this);' class='btn-primary btn d-none'>Edit</button>" +
    "<button onclick='storePlayer(this);' class='btn-success btn '>Save</button></td></tr>").focus();

    $('#players-div').scrollTop();
}

function addTeam(){
    var teams_table = $('#teams-table tbody');
    teams_table.append("<tr><td><input type='text' value='' class='form'> <button class='btn btn-primary' onclick='storeTeam(this);'>Save</button></td><td>0</td></tr>");
}


function storeTeam(val){
    var tr = $(val).closest('tr');
    var td = $(tr).find('td:first');
    var input = $(tr).find('input[type=text]');

    $.ajax({
        url: '/api/team',
        method: 'POST',
        data: {name: input.val()},
        headers: {'content-type': 'application/x-www-form-urlencoded'},
        success: function(data){
            td.empty();
            td.html(data.name);
            $(tr).data('id', data.id);
            $(tr).on('click', function(){
                var players_table =$('#players-table tbody');

                players_table.data('team', data.id);

                players_table.empty();

                $.ajax({
                    url: '/api/team/' + data.id,
                    method: 'GET',
                    success: function(data){
                        $('#modal-title').html(data.name);

                        $.each(data.players, function (key, item) {
                            players_table.append('<tr data-team="'+ data.id +'" data-id="' + item.id + '"><td>'+ item.name +'</td><td class="text-center">' +
                                '<button onclick="editPlayer(this);" ' + 'class="btn-primary btn">Edit</button>' +
                                '<button onclick="savePlayer(this);" ' + 'class="btn-success btn d-none">Save</button></td></tr>');
                        });
                    }
                });

                $('#players-modal').modal('show');
            });
        }
    });
}