@extends('admin.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Страны</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                            <li class="breadcrumb-item active">Страны</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <a href="{{ route('admin.country.create') }}" class="btn btn-primary">Добавить страну</a>
                </div>
                <div class="row">
                    <div class="card w-50 mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Все страны в базе:</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 30px"></th>
                                    <th style="width: 30px">ISO</th>
                                    <th>Название</th>
                                    <th style="width: 30px"></th>
                                    <th style="width: 100px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($countries AS $country)
                                    <tr>
                                        <td><img src="/images/country/flag/icon/{{ $country->id }}.png" width="25"></td>
                                        <td>{{ $country->id }}</td>
                                        <td>{{ $country->title }}</td>
                                        <td>{{ $country->order }}</td>
                                        <td class="flex">
                                            <form action="{{ route('admin.country.delete', $country->id) }}" method="post">
                                                <a href="{{ route('admin.country.show', $country->id) }}"><i class="far fa-eye"></i></a>
                                            <a href="{{ route('admin.country.edit', $country->id) }}"><i class="fas fa-edit" style="color: #42c10b;"></i></a>

                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="fas fa-trash-alt bg-transparent border-0" style="color: red;"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
