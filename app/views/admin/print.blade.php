<link rel="stylesheet" type="text/css" id="theme" href="{{ URL::to('admin-assets/css/theme-default.css') }}"/>
{{-- <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::to('css/style.css') }}"/> --}}
<div class="row text-center">
		<a href="#"onclick="window.history.go(-1); return false;" class="btn btn-default btn-back">Back</a>
		<button class="btn btn-success btn-print">Print</button>
</div>
<div class="container" style="border:1px solid #000;padding:5px;" >
		@foreach(Ticket::where('event_id','=',$id)->get() as $key => $value)
			<object data="{{$value->path}}" type="image/svg+xml"></object><br>
		@endforeach
		<hr />

</div>
<script type="text/javascript" src="{{ URL::to('admin-assets/js/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript">
	$(function(){
		$('.btn-print').click(function(){
			$('.btn-print').hide();
			$('.btn-back').hide();
			window.print();
			$('.btn-back').show();
			$('.btn-print').show();
		});
	});
</script>
