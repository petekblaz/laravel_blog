{{-- hero panel --}}
<section class="hero has-text-centered {{ $colorClass or 'is-info' }} {{ $sizeClass or '' }}" style="background-image: url({{ $backgroundImg or '' }}); background-size:cover;">
	<div class="hero-body">
		<div class="container">
			<h1 class="title">{{ $title }}</h1>
			<h2 class="subtitle">{{ $subtitle }}</h2>
		</div>
	</div>
</section>