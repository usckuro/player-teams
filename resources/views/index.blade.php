<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Teams and Players</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            .table-wrapper-scroll-y {
                display: block;
                max-height: 600px;
                overflow-y: auto;
                -ms-overflow-style: -ms-autohiding-scrollbar;
            }

            .transparent-input{
                background: transparent;
                border: none;
            }
        </style>
    </head>
    <body>

        <nav class="navbar-dark navbar bg-dark">
            <a class="navbar-brand" href="#">Teams & Players</a>
        </nav>
        <br>
        <div class="container">
            <div class="col-md-12 text-right">
                <button type="button" class="btn btn-success" id="add-team" onclick="addTeam()"><i class="fa fa-add"></i>Add Team</button>
            </div>
            <br>
            <div class="col-md-12">
                <div class="table-wrapper-scroll-y">
                    <table class="table table-striped table-hover" id="teams-table">
                        <thead>
                        <th>Team</th>
                        <th>Players</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="players-modal">
            <div class="modal-dialog .modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-wrapper-scroll-y" id="players-div">
                            <table class="table table-striped table-hover" id="players-table">
                                <thead>
                                    <th>Player</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="add-player" onclick="addPlayer()"><i class="fa fa-add" ></i>Add player</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="players-modal">
            <div class="modal-dialog .modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="table-wrapper-scroll-y">
                            <table class="table table-striped table-hover" id="players-table">
                                <thead>
                                    <th>Player</th>
                                    <th> </th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/index.js') }}"></script>
    </body>

</html>
