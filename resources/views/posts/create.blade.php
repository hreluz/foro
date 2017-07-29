@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Post</div>
                <div class="panel-body">
                    {!! Form::open(['route' => ['posts.store'], 'method' => 'POST', 'role' => 'form' , 'class' => 'form-horizontal']) !!}

                        {!! Field::text('title') !!}

                        {!! Field::textarea('content') !!}

                        {!! Field::select('category_id', $categories) !!}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Publicar
                                </button>
                            </div>
                        </div>
                        
                    {!! Form::close() !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
