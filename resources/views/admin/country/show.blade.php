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
                            <li class="breadcrumb-item"><a href="{{ route('admin.country.index') }}">Страны</a></li>
                            <li class="breadcrumb-item active">{{ $country->title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row" >
                    <a href="{{ route('admin.country.create') }}" class="btn btn-primary m-1">Добавить страну</a>

                    <a href="{{ route('admin.country.edit', $country->id) }}" class="btn btn-success m-1" >Редактировать</a>

                        @csrf
                        @method('delete')
                    <form action="{{ route('admin.country.delete', $country->id) }}" method="post">
                        <button type="submit" class="btn btn-danger m-1">Удалить</button>
                    </form>
                </div>
                <div class="row">
                    <div class="card w-50 mt-3">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ID</td>
                                        <td>{{ $country->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Картинка</td>
                                        <td><img src="/images/country/flag/icon/{{ $country->id }}.png" width="25"></td>
                                    </tr>
                                    <tr>
                                        <td>Картинка</td>
                                        <td><img src="/images/country/flag/image/{{ $country->id }}.png" width="250"></td>
                                    </tr>
                                    <tr>
                                        <td>ISO</td>
                                        <td>{{ $country->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Название</td>
                                        <td>{{ $country->title }}</td>
                                    </tr>
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
