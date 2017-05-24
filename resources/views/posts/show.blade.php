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

	
	@foreach($post->latestComments as $comment)
		<article class="{{ $comment->answer ? 'answer' : '' }}">
			{{ $comment->comment }}	
			@if(Gate::allows('acceptAnswer', $comment) && !$comment->answer)
				{!! Form::open(['route' => ['comments.accept', $comment], 'method' => 'POST', 'role' => 'form' , 'class' => 'form-horizontal']) !!}
		            <button type="submit">Aceptar Respuesta</button>
				{!! Form::close() !!}
			@endif
		</article>
	@endforeach

@endsection