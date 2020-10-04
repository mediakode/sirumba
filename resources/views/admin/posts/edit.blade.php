@extends('layouts.master')
@section('content')

@if(count($errors) > 0)

	<ul class="list-group">
		@foreach($errors->all() as $error)

			<li class="list-group-item text-danger">
				{{ $error }}
			</li>		
		@endforeach
	</ul>


@endif

	<div class="panel panel-danger">
		<div class="panel-heading">
			<h2 class="panel-title"> <span class="fa fa-edit"></span> EDIT POST BERITA : {{ $post->title }}</h2>
			
		</div>

		<div class="panel-body">
			<form action="{{ route('post.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="title">JUDUL</label>
					<input type="text" name="title" id="" class="form-control" value="{{ $post->title }}">
				</div>
				<div class="form-group">
					<label for="featured">GAMBAR</label>
					<input type="file" name="featured" id="" class="form-control">
				
				</div>

				<div class="form-group">
					<label for="category">PILIH KATEGORI</label>
					<select name="category_id" id="category" class="form-control">
						@foreach($categories as $category)

							<option value="{{ $category->id }}"

								 @if($post->category->id == $category->id)
									selected
								 @endif 
								>{{ $category->name }}</option>

						@endforeach
					</select>	
				</div>

				<div class="form-group">
					<label for="tags">PILIH TAG</label>
					@foreach($tags as $tag)
						<div class="checkbox">
							<label>
								<input type="checkbox" value="{{$tag->id}}" name="tags[]" 
									@foreach ($post->tags as $t )
										@if($tag->id == $t->id)
											checked		
										@endif
									@endforeach 
								>{{ $tag->tag }}
							</label>
						</div>
					@endforeach
				</div>

				<div class="form-group">
					<label for="content">KONTEN</label>
					<textarea name="content" id="summernote_edit_post" cols="5" rows="5" class="form-control">{{ $post->content }}</textarea>
				</div>
				
				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">UPDATE</button>
					</div>
				</div>	
		

			</form>
		</div>
	</div>

@stop
@push('css')
<link rel="stylesheet" href="{{ asset('lib/summernote/summernote.css') }}">
<link rel="stylesheet" href="{{ asset('lib/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.css') }}">
@endpush


@push('js')
<script src="{{ asset('lib/wysihtml5x/wysihtml5x.js') }}"></script>
<script src="{{ asset('lib/wysihtml5x/wysihtml5x-toolbar.js') }}"></script>
<script src="{{ asset('lib/handlebars/handlebars.js') }}"></script>
<script src="{{ asset('lib/summernote/summernote.js') }}"></script>
<script src="{{ asset('lib/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.all.js') }}"></script>

<script>
	$(document).ready(function() {
        $('#summernote_edit_post').summernote({
			height: 200
		});
    });
</script>
@endpush