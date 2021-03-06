@extends('layouts.manage')

@section('content')

	<div class="container-posts-index">
		<h1 class="title is-2">Posts index</h1>

		<div class="filter-table">
			<input type="checkbox" id="filter-checkbox"> Show only my posts
		</div>

		<a href="{{ route('posts.create') }}" class="button is-success is-pulled-right"><span class="fa fa-plus-square-o"></span> New Post</a>

		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Author</th>
					<th>Category</th>
					<th>Published on</th>
					<th>Last updated on</th>
					<th>Options</th>
				</tr>
			</thead>

			<tbody>
				@foreach($posts as $post)
					<tr>
						<th>{{ $post->id }} </th>
						
						<td><a href="{{ route('posts.show', $post->id) }}">
							{{ substr($post->title, 0, 15) }} {{ (strlen($post->title) > 15) ? '...' : '' }} 
						</a></td>
						
						<td class="name">{{ $post->user->name }}</td>
						<td>{{ $post->category->name }} </td>
						<td>{{ $post->created_at->toFormattedDateString() }} </td>
						<td>{{ $post->updated_at->toFormattedDateString() }} </td>
						<td>
							{{-- Show edit and delete buttons only if user is post author or admin --}}
							@if (auth()->user()->id == $post->user_id || auth()->user()->role->id == 1)
								<form action="/manage/posts/{{ $post->id }}" method="POST">
									{{-- Edit button is here, cause otherwise, form wraps to another line.. temporary --}}
									<a href="{{ route('posts.edit', $post->id) }}" class="button is-info is-small"><span class="fa fa-pencil-square-o"></span></a>
									
									{{ method_field('DELETE') }}
									{{ csrf_field() }}
									<input type="hidden" name="id" value="{{ $post->id }}">

									{{-- Delete button --}}
									<button type="submit" class="button is-danger is-small"><span class="fa fa-trash-o"></span></a>
								</form>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>

		</table>
	</div>

	@section('scripts')
		@include('posts.partials.scripts')
	@endsection

@endsection

