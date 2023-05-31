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
                            <li class="breadcrumb-item active">Редактирование страны - {{ $country->title }}</li>
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
                            <h3 class="card-title">Редактирование страны - {{ $country->title }}</h3>
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
                        <form action="{{ route('admin.country.update',$country->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>ISO код</label>
                                    <input name="id" type="text" class="form-control" placeholder="ISO код"
                                           value="{{ old('id') ?? $country->id }}">
                                </div>
                                <div class="form-group">
                                    <label>Полное название страны</label>
                                    <input name="title" type="text" class="form-control"
                                           placeholder="Полное название страны" value="{{ old('title') ?? $country->title }}">
                                </div>
                                <div class="form-group">
                                    <label>Порядок отображения</label>
                                    <input name="order" type="number" class="form-control"
                                           placeholder="Порядок отображения" value="{{ old('order') ?? $country->order }}">
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
