@extends('layouts.app')
@section('content')

	<h1>{{ $post->title }}</h1>
	<p>{{ $post->content }}</p>
	<p> {{ $post->user->name }}</p>

	<h4>Comentarios</h4>

	{!! Form::open(['route' => ['comments.store', $post], 'method' => 'POST', 'role' => 'form' , 'class' => 'form-horizontal']) !!}

	    {!! Field::textarea('comment') !!}
	    {!! Field::hidden('post_id', $post->id) !!}

	    <div class="form-group">
	        <div class="col-md-6 col-md-offset-4">
	            <button type="submit" class="btn btn-primary">
	                Publicar comentario
	            </button>
	        </div>
	    </div>
	    
	{!! Form::close() !!}

@endsection