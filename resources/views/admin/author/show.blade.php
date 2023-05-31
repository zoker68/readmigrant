@extends('admin.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Авторы</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.author.index') }}">Авторы</a></li>
                            <li class="breadcrumb-item active">{{ $author->name }}</li>
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
                    <a href="{{ route('admin.author.create') }}" class="btn btn-primary m-1">Добавить автора</a>

                    <a href="{{ route('admin.author.edit', $author->id) }}" class="btn btn-success m-1" >Редактировать</a>

                        @csrf
                        @method('delete')
                    <form action="{{ route('admin.author.delete', $author->id) }}" method="post">
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
                                        <td>{{ $author->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Название</td>
                                        <td>{{ $author->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Морерация</td>
                                        <td>
                                            @if($author->is_moderate == 1)
                                                <i class="fas fa-check-circle" style="color: green"></i>
                                            @else
                                                <i class="far fa-question-circle" style="color: red"></i>
                                            @endif
                                        </td>
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
