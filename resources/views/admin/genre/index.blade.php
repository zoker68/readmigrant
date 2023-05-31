@extends('admin.layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Жанры</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Главная</a></li>
                            <li class="breadcrumb-item active">Жанры</li>
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
                    <a href="{{ route('admin.genre.create') }}" class="btn btn-primary">Добавить жанр</a>
                </div>
                <div class="row">
                    <div class="card w-50 mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Все жанры в базе:</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 20px">#</th>
                                    <th>Имя</th>
                                    <th style="width: 100px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($genres AS $genre)
                                    <tr>
                                        <td>{{ $genre->id }}</td>
                                        <td>{{ $genre->title }}</td>
                                        <td class="flex">
                                            <form action="{{ route('admin.genre.delete', $genre->id) }}"
                                                  method="post">
                                                <a href="{{ route('admin.genre.show', $genre->id) }}"><i
                                                        class="far fa-eye"></i></a>
                                                <a href="{{ route('admin.genre.edit', $genre->id) }}"><i
                                                        class="fas fa-edit" style="color: #42c10b;"></i></a>

                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="fas fa-trash-alt bg-transparent border-0"
                                                        style="color: red;"></button>
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
