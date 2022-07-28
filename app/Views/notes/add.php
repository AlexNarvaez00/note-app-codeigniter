<?= helper('html') ?>
<?= helper('form') ?>
@extends('components.root')
<!--Titutlo de la seccion-->
@section('title-page','Add Notes')
<!-- BEGIN INDEX-->
@section('indexes-page')
@foreach($indexList as $index)
<li class="breadcrumb-item"><a href="#">{{$index['name']}}</a></li>
@endforeach
@endsection
<!-- END INDEX-->
<!-- BEGIN MAIN-->
@section('main-content')
<form action="{{base_url('/notes')}}" method="POST">
        <?= csrf_field() ?>
        <div class="form-row">
                <div class="col-md-12 mb-4">
                        <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Titulo</label>
                                <input type="text" class="form-control" name="title" value="{{old('title')}}" id="formGroupExampleInput" placeholder="Titulo" required>
                                @if($validation->hasError('title'))
                                <div class="invalid-feedback d-flex">
                                        {{$validation->getError('title')}}
                                </div>
                                @endif
                        </div>
                </div>
        </div>
        <div class="form-row">
                <div class="col-md-12 mb-4">
                        <div class="form-group mb-4">
                                <label for="formGroupExampleInput2">Contenido</label>
                                <textarea id="formGroupExampleInput2" placeholder="Contenido" class="form-control" name="content" cols="10" rows="5">{{old('content')}}</textarea>
                        </div>
                        @if($validation->hasError('content'))
                        <div class="invalid-feedback d-flex">
                                {{$validation->getError('content')}}
                        </div>
                        @endif
                </div>
        </div>
        <input type="submit" name="time" class="btn btn-primary">
</form>

@endsection
<!-- END MAIN-->
<!--BEGIN SCRIPTS -->
@section('script-section')
@endsection
<!--END SCRIPTS-->
