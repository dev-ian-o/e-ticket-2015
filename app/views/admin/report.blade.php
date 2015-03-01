<link rel="stylesheet" type="text/css" id="theme" href="{{ URL::to('admin-assets/css/theme-default.css') }}"/>
{{-- <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::to('css/style.css') }}"/> --}}
<div class="row text-center">
		<a href="#"onclick="window.history.go(-1); return false;" class="btn btn-default btn-back">Back</a>
		<button class="btn btn-success btn-print">Print</button>
</div>
<div class="container" style="border:1px solid #000;padding:5px;" >
                        <?php $total_payment = 0;?>

	    @if(EventCustomer::where('event_id','=',$id)->count())
	        <?php $price = Event::where('id','=',$id)->pluck('ticket_price'); ?>
	        <?php $total_count = EventCustomer::where('event_id','=',$id)->count()?>
	       @foreach(EventCustomer::where('event_id','=',$id)->get() as $key => $value)
	                <?php $total_payment += ($price - $value->balance);?>
	       @endforeach
	    @endif
	    <h1 class="text-center">Event:{{Event::where('id','=',$id)->pluck('title') }}</h1>
	    <h3 class="text-center">Date:{{ date('M d Y, H:i:s'); }}</h3>

	    <div class="row">
	        <button class="btn btn-primary pull-right">Overall Total: {{ (($total_count*$price)) }}</button>&nbsp;
	        <button class="btn btn-danger pull-right">Total Not Paid: {{ (($total_count*$price) - $total_payment) }}</button>&nbsp; 
	        <button class="btn btn-success pull-right">Total Paid: {{ $total_payment }}</button><br>
	    </div>
		<table class="table datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Course</th>
                    <th>Work</th>
                    <th>Ticket #</th>
                    <th>Balance</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php $a = 1;?>
                @if(EventCustomer::where('event_id','=',$id)->count())
                   @foreach(EventCustomer::where('event_id','=',$id)->get() as $key => $value)
                    <tr>
                        <td>{{ $a++ }}</td>
                        <?php
                            $customer = Customer::where('id','=',$value->customer_id)->get()->first();
                        ?>
                        <td><span data-container="body" data-toggle="tooltip" data-placement="top" title="{{ $customer->firstname.' '.$customer->lastname }}">{{Str::limit($customer->firstname.' '.$customer->lastname, 15, '...')}}</span></td>
                        <td>{{ $customer->year }}</td>
                        <td>{{ $customer->course }}</td>
                        <td><span data-container="body" data-toggle="tooltip" data-placement="top" title="{{ $value->work }}">{{Str::limit($customer->work, 10, '...')}}</span></td>
                        <td class="class-ticket-no">
                            <span class=ticket-no>{{$value->ticket_no}}</span>
                        </td>
                        <td>
                            P{{number_format($value->balance,2)}}
                        </td>
                        <td>
                            @if($value->account_status == "not paid")
                            <button class="btn btn-alert">{{$value->account_status}}</button>
                            @elseif($value->account_status == "paid with balance")
                            <button class="btn btn-danger">{{$value->account_status}}</button>
                            @elseif($value->account_status == "paid")
                            <button class="btn btn-success">{{$value->account_status}}</button>
                            @else
                            <button class="btn btn-primary">{{$value->account_status}}</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

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
