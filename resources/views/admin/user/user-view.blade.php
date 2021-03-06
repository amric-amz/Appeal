<!-- Datatable -->
<link href="{{ asset('AppealLab/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<!-- Custom Stylesheet -->
<x-admin-layout>

    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">User</a></li>
            </ol>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a href="{{ url('dashboard/admin/user-registration') }}" style="border-radius: 0.25rem !important;" class="btn rounded btn-primary">Create New User</a>
                        </h4><br>

                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <strong></strong>  {{ Session::get('success') }}
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                            </div>
                        @endif

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>Postal Code</th>
                                    <th>Edit</th>
                                    <th>View</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user['id'] }}</td>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ $user['last_name'] }}</td>
                                        <td>
                                            <span class="badge light badge-success">
												<i class="fa fa-circle text-success mr-1"></i>
												{{ $user['email'] }}
											</span>
                                        </td>
                                        <td>{{ $user['address'] }}</td>
                                        <td>{{ $user['contact'] }}</td>
                                        <td>{{ $user['city'] }}</td>
                                        <td>{{ $user['country'] }}</td>
                                        <td>{{ $user['state'] }}</td>
                                        <td>{{ $user['postal'] }}</td>
                                        <td><a href="{{ url('dashboard/admin/user-edit-view' , ['id' => $user['id'] ]) }}" class=""><i class="fa fa-pencil-square-o"></i></a></td>
                                        <td> <a href="{{ url('dashboard/admin/user-profile' , ['id' => $user['id'] ]) }}" c><i class="fa fa-eye"></i></a> </td>
                                        <td> <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a> </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
<!-- Datatable -->
<script src="{{ asset('AppealLab/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AppealLab/js/plugins-init/datatables.init.js') }}"></script>

