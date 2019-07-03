@extends('layouts.app')
@section('content')
@include('partials.errors')
<?php $parent = $code->code_id == 0 ?>
<?php $text = $parent ? "Code" : "Child Code" ?>
<div class="card text-center">
	<div class="card-body">
		<h1 class="card-title">Edit {{ $text }}</h1>
		<form method="POST" action="/categories/{{ $category->id }}/codes/{{ $code->id }}">
			@csrf
			@method('PATCH')
			<div class="row">
				@if($parent)
					<div class="col-md-4">
						<h3>Select Subcategories</h3>
						@if ($category->subCategories->count() === 0)
							@php
								$category->addSubCategory(['title' => $category->title]);
							@endphp
						@endif
						<ul class="list-group text-left">
							@foreach ($category->subCategories as $sub)
								<?php $included = $code->subcategories->contains('id', $sub->id) ?>
								<li class="list-group-item">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="{{ $sub->id }}" id="{{ $sub->id}}"{{ $included ? " checked" : "" }}>
										<label class="form-check-label" for="{{ $sub->id }}">{{ $sub->title }}</label>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				@endif
				<div class="box {{ $parent ? "col-md-8" : "col-md-12" }}">
					<div class="form-group text-left">
						<label for="title">Title</label>
						<input class="form-control" type="text" name="title" value="{{ $code->title }}">
					</div>
					<div class="form-group text-left">
						<label for="details">Details</label>
						<textarea class="form-control" name="details">{{ $code->details }}</textarea>
					</div>
					<div class="form-group text-left">
						<label for="code">Code</label>
						<textarea style="height: 300px" data-editor="php" class="form-control" name="code">{{ $code->code }}</textarea>
					</div>
				</div>
			</div>
			<div class="form-group">
				<input class="btn btn-primary" type="submit" name="submit" value="Edit {{ $text }}">
			</div>
		</form>
		<form method="POST" action="/categories/{{ $category->id }}/codes/{{ $code->id }}">
			@csrf
			@method('DELETE')
			<input class="btn btn-danger" type="submit" name="submit" value="Delete {{ $text }}">
		</form>
	</div>
</div>

<script src="/ace-builds-master/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="/ace-builds-master/src-noconflict/theme-monokai.js" type="text/javascript" charset="utf-8"></script>
<script src="/ace-builds-master/src-noconflict/mode-javascript.js" type="text/javascript" charset="utf-8"></script>
<script>
	$(function() {
		$('textarea[data-editor]').each(function() {
		    var textarea = $(this);
		    var mode = textarea.data('editor');
		    var editDiv = $('<div>', {
		    	position: 'absolute',
		    	width: textarea.width(),
		    	height: textarea.height(),
		    	'class': textarea.attr('class')
		    }).insertBefore(textarea);
		    textarea.css('display', 'none');
		    var editor = ace.edit(editDiv[0]);
		    editor.renderer.setShowGutter(textarea.data('gutter'));
		    editor.getSession().setValue(textarea.val());
		    editor.getSession().setMode("ace/mode/" + mode);
		    editor.setTheme("ace/theme/dawn");
		    editor.setOptions({
				showGutter: true,
				vScrollBarAlwaysVisible: true,
				showPrintMargin: true,
				minLines: 5,
				highlightGutterLine: true,
				highlightActiveLine: true,
				autoScrollEditorIntoView: true,
				selectionStyle: "line"
			});
			editor.resize();

		    // copy back to textarea on form submit...
		    textarea.closest('form').submit(function() {
				textarea.val(editor.getSession().getValue());
		    });
		});
	});
</script>
@endsection
