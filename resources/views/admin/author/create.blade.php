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
                            <li class="breadcrumb-item active">Добавление автора</li>
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
                            <h3 class="card-title">Добавление автора</h3>
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
                        <form action="{{ route('admin.author.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Полное имя автора</label>
                                    <input name="name" type="text" class="form-control"
                                           placeholder="Полное имя автора" value="{{ old('name') }}">
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
