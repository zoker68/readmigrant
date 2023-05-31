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
                            <li class="breadcrumb-item active">Редактирование автора - {{ $author->name }}</li>
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
                    <div class="card card-primary w-50">
                        <div class="card-header">
                            <h3 class="card-name">Редактирование автора - {{ $author->name }}</h3>
                        </div>
                        @if($errors->count() > 0)
                            <div class="m-3">
                                <div style="color: red" class="m-3">
                                    У нас ошибки:
                                    @foreach($errors->all() AS $error)
                                        <div style="font-weight: bold;"> - {{ $error }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <form action="{{ route('admin.author.update',$author->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Полное название автора</label>
                                    <input name="name" type="text" class="form-control"
                                           placeholder="Полное название автора" value="{{ old('name') ?? $author->name }}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
