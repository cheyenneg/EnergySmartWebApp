<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Reporting</title>

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

    </head>

    <body>

      <div class="backDiv">
        <button id="admin_button"><a href="admin">Back</a></button>
      </div>

        <div class="container">

            <br/>

            <h1 class="text-center">Climate Smart Reporting</h1>

            <br/>

            <table class="table table-bordered" id="users-table">

                <thead>

                    <tr>

                        <th>User Id</th>

                        <th>First Name</th>

                        <th>Last Name</th>

                        <th>Username</th>

                        <th>Email</th>

                        <th>Energy Provider</th>

                        <th>Therms</th>

                        <th>KWH</th>

                        <th>Cost ($)</th>

                        <th>Start Date</th>

                        <th>Ending Date</th>

                    </tr>

                </thead>

            </table>

        </div>

        <script src="//code.jquery.com/jquery.js"></script>

        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <script>

        $(function() {

            $('#users-table').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{!! route('get.data') !!}',
                //ajax: 'https://datatables.yajrabox.com/eloquent/joins-data',

                columns: [

                    { data: 'u_id', name: 'user.u_id' },

                    { data: 'f_name', name: 'user.f_name' },

                    { data: 'l_name', name: 'user.l_name' },

                    { data: 'user_name', name: 'user.user_name' },

                    { data: 'email', name: 'user.email' },

                    { data: 'Energy_Provider', name: 'user.Energy_Provider' },

                    { data: 'therms', name: 'energy.therms' },

                    { data: 'kwh', name: 'energy.kwh' },

                    { data: 'cost', name: 'energy.cost'},

                    { data: 'start_date', name: 'energy.start_date'},

                    { data: 'end_date', name: 'energy.end_date'}

                ]


              });
          });


        </script>

        @stack('scripts')

    </body>

</html>
