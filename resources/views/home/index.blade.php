@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Cadastro de Alunos</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Pagina</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card style="primary">

    <button type="button" class="btn btn-primary text-right">Novo</button>

    <hr>

    <div class="table-responsive">
        <table class="table table-striped datatable" id="table-1">
            <thead>
                <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>Task Name</th>
                    <th>Progress</th>
                    <th>Members</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>Create a mobile app</td>
                    <td class="align-middle">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-success width-per-40">
                            </div>
                        </div>
                    </td>
                    <td>
                        <img alt="image" src="{{ asset('template/assets/img/users/user-5.png') }}" width="35">
                    </td>
                    <td>2018-01-20</td>
                    <td>
                        <div class="badge badge-success badge-shadow">Completed</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                </tr>
                <tr>
                    <td>
                        2
                    </td>
                    <td>Redesign homepage</td>
                    <td class="align-middle">
                        <div class="progress progress-xs">
                            <div class="progress-bar width-per-60"></div>
                        </div>
                    </td>
                    <td>
                        <img alt="image" src="{{ asset('template/assets/img/users/user-1.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-3.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-4.png') }}" width="35">
                    </td>
                    <td>2018-04-10</td>
                    <td>
                        <div class="badge badge-info badge-shadow">Todo</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                </tr>
                <tr>
                    <td>
                        3
                    </td>
                    <td>Backup database</td>
                    <td class="align-middle">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-warning width-per-70"></div>
                        </div>
                    </td>
                    <td>
                        <img alt="image" src="{{ asset('template/assets/img/users/user-1.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-2.png') }}" width="35">
                    </td>
                    <td>2018-01-29</td>
                    <td>
                        <div class="badge badge-warning badge-shadow">In Progress</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                </tr>
                <tr>
                    <td>
                        4
                    </td>
                    <td>Input data</td>
                    <td class="align-middle">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-success width-per-90"></div>
                        </div>
                    </td>
                    <td>
                        <img alt="image" src="{{ asset('template/assets/img/users/user-2.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-5.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-4.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-1.png') }}" width="35">
                    </td>
                    <td>2018-01-16</td>
                    <td>
                        <div class="badge badge-success badge-shadow">Completed</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                </tr>
                <tr>
                    <td>
                        5
                    </td>
                    <td>Create a mobile app</td>
                    <td class="align-middle">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-success width-per-40">
                            </div>
                        </div>
                    </td>
                    <td>
                        <img alt="image" src="{{ asset('template/assets/img/users/user-5.png') }}" width="35">
                    </td>
                    <td>2018-01-20</td>
                    <td>
                        <div class="badge badge-success badge-shadow">Completed</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                </tr>
                <tr>
                    <td>
                        6
                    </td>
                    <td>Redesign homepage</td>
                    <td class="align-middle">
                        <div class="progress progress-xs">
                            <div class="progress-bar width-per-60"></div>
                        </div>
                    </td>
                    <td>
                        <img alt="image" src="{{ asset('template/assets/img/users/user-1.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-3.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-4.png') }}" width="35">
                    </td>
                    <td>2018-04-10</td>
                    <td>
                        <div class="badge badge-info badge-shadow">Todo</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                </tr>
                <tr>
                    <td>
                        7
                    </td>
                    <td>Backup database</td>
                    <td class="align-middle">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-warning width-per-70"></div>
                        </div>
                    </td>
                    <td>
                        <img alt="image" src="{{ asset('template/assets/img/users/user-1.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-2.png') }}" width="35">
                    </td>
                    <td>2018-01-29</td>
                    <td>
                        <div class="badge badge-warning badge-shadow">In Progress</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                </tr>
                <tr>
                    <td>
                        8
                    </td>
                    <td>Input data</td>
                    <td class="align-middle">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-success width-per-90"></div>
                        </div>
                    </td>
                    <td>
                        <img alt="image" src="{{ asset('template/assets/img/users/user-2.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-5.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-4.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-1.png') }}" width="35">
                    </td>
                    <td>2018-01-16</td>
                    <td>
                        <div class="badge badge-success badge-shadow">Completed</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                </tr>
                <tr>
                    <td>
                        9
                    </td>
                    <td>Create a mobile app</td>
                    <td class="align-middle">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-success width-per-40">
                            </div>
                        </div>
                    </td>
                    <td>
                        <img alt="image" src="{{ asset('template/assets/img/users/user-5.png') }}" width="35">
                    </td>
                    <td>2018-01-20</td>
                    <td>
                        <div class="badge badge-success badge-shadow">Completed</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                </tr>
                <tr>
                    <td>
                        10
                    </td>
                    <td>Redesign homepage</td>
                    <td class="align-middle">
                        <div class="progress progress-xs">
                            <div class="progress-bar width-per-60"></div>
                        </div>
                    </td>
                    <td>
                        <img alt="image" src="{{ asset('template/assets/img/users/user-1.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-3.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-4.png') }}" width="35">
                    </td>
                    <td>2018-04-10</td>
                    <td>
                        <div class="badge badge-info badge-shadow">Todo</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                </tr>
                <tr>
                    <td>
                        11
                    </td>
                    <td>Backup database</td>
                    <td class="align-middle">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-warning width-per-70"></div>
                        </div>
                    </td>
                    <td>
                        <img alt="image" src="{{ asset('template/assets/img/users/user-1.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-2.png') }}" width="35">
                    </td>
                    <td>2018-01-29</td>
                    <td>
                        <div class="badge badge-warning badge-shadow">In Progress</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                </tr>
                <tr>
                    <td>
                        12
                    </td>
                    <td>Input data</td>
                    <td class="align-middle">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-success width-per-90"></div>
                        </div>
                    </td>
                    <td>
                        <img alt="image" src="{{ asset('template/assets/img/users/user-2.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-5.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-4.png') }}" width="35">
                        <img alt="image" src="{{ asset('template/assets/img/users/user-1.png') }}" width="35">
                    </td>
                    <td>2018-01-16</td>
                    <td>
                        <div class="badge badge-success badge-shadow">Completed</div>
                    </td>
                    <td><a href="#" class="btn btn-primary">Detail</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</x-card>

@endsection




@section('scripts')
@parent

<script>
    $('.datatable').DataTable({
            order: [],
            pageLength: 10,
            lengthMenu: [
                [5,10, 25, 50, -1],
                [5,10, 25, 50, 'Tudo'],
            ],
            columnDefs: [
                { className: "align-middle", targets: "_all" },
            ],
            deferRender:true,
            processing:true,
            // responsive:true,
            pagingType: $(window).width() < 768 ? 'simple' : 'simple_numbers',
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
            },
            
        });
</script>
@endsection

@include('template.includes.datatable')