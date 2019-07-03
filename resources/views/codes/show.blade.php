@extends('layouts.app')
@section('content')
@include('partials.errors')
<div class="text-center">
	<h1>{{ $category->title }} Code</h1>
</div>
<br>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-md-6">
				<h2>{{ $code->title }}</h2>
			</div>
			<div class="col-md-6 text-right">
				@foreach($code->subcategories as $sub)
				<span class="badge badge-primary badge-pill">{{ $sub->title }}</span>
				@endforeach
			</div>
		</div>
	</div>
	<div class="card-body">
		<h5>{{ $code->details }}</h5>
		<br>
		<textarea style="height: 200px" data-readonly="true" data-editor="php" class="form-control" name="code">{{ $code->code }}</textarea>
		<br>
		<br>
		@foreach($code->childCodes as $child)
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-6">
								<h2>{{ $child->title }}</h2>
							</div>
							<div class="col-md-6 text-right">
								@foreach($code->subcategories as $sub)
								<span class="badge badge-primary badge-pill">{{ $sub->title }}</span>
								@endforeach
							</div>
						</div>
					</div>
					<div class="card-body">
						<h5>{{ $child->details }}</h5>
						<br>
						<textarea style="height: 200px" data-readonly="true" data-editor="php" class="form-control" name="code">{{ $child->code }}</textarea>
						<br>
						<div class="text-center">
							<a class="btn btn-primary" href="/categories/{{ $category->id }}/codes/{{ $child->id }}/edit">Edit Child Code</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
		<br>
		@endforeach
		<hr>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				@include('partials.errors')
				<div class="card">
					<div class="card-body">
						<h3 class="card-title">Add Child Code</h3>
						<form method="POST" action="/categories/{{ $category->id }}/codes">
							@csrf
							<input type="hidden" name="code_id" value="{{ $code->id }}">
							<input class="form-control" type="text" name="title" placeholder="Title">
							<br>
							<textarea class="form-control" name="details" placeholder="Details"></textarea>
							<br>
							<textarea style="height: 200px" data-readonly="false" data-editor="php" class="form-control" name="code" placeholder="Code"></textarea>
							<br>
							<div class="text-center">
								<input class="btn btn-primary" type="submit" name="submit" value="Add Child Code">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</div>
<br>
<div class="text-center">
	<a class="btn btn-primary" href="/categories/{{ $category->id }}/codes/{{ $code->id }}/edit">Edit Code</a>
	<a class="btn btn-primary" href="/categories/{{ $category->id }}/codes">View All Codes</a>
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
				readOnly: textarea.data('readonly'),
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
