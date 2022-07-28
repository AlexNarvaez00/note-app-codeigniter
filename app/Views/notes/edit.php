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
<form action="{{url_to('Notes::update/$1',$note['id'])}}" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT" />
        <div class="form-row">
                <div class="col-md-12 mb-4">
                        <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Titulo</label>
                                @if(old('title'))
                                <input type="text" class="form-control" name="title" value="{{old('title')}}" id="formGroupExampleInput" placeholder="Titulo" required>
                                @else
                                <input type="text" class="form-control" name="title" value="{{$note['title']}}" id="formGroupExampleInput" placeholder="Titulo" required>
                                @endif
                                <!--Mensaje de error-->
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
                                @if(old('content'))
                                <textarea required id="formGroupExampleInput2" placeholder="Contenido" class="form-control" name="content" cols="10" rows="5">{{old('content')}}</textarea>
                                @else
                                <textarea required id="formGroupExampleInput2" placeholder="Contenido" class="form-control" name="content" cols="10" rows="5">{{$note['content']}}</textarea>
                                @endif
                                <!-- Mensaje de error -->
                                @if($validation->hasError('content'))
                                <div class="invalid-feedback d-flex">
                                        {{$validation->getError('content')}}
                                </div>
                                @endif
                        </div>
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
