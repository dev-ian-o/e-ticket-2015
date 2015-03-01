<?php

class EventCustomerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	// $events = EventCustomer::where('events.deleted_at', '=', NULL)
 //        ->leftJoin('designs', 'events.design_id', '=', 'designs.id')
 //        ->select('*','events.id','events.deleted_at','events.created_at','events.updated_at')
 //        ->get();
	// 	return Response::json($events);
		// return Response::json(EventCustomer::get());
		$price = EventCustomer::where('customer_id','=',Request::get('customer_id'))
				->where('event_id','=',Request::get('event_id'))->pluck('balance');
		if(Request::get('balance') <= $price && Request::get('balance') > 0){

			$event_customer = EventCustomer::where('customer_id','=',Request::get('customer_id'))
				->where('event_id','=',Request::get('event_id'))->first();
			$balance =  ($event_customer->balance - ((float)Request::get('balance')));
			if($balance == 0)
				$account_status = "paid"; 
			else if(Request::get('balance') < $event_customer->balance)
				$account_status = "paid with balance";
			else 
				$account_status = "not paid";

			$event_customer->balance = $balance;
			$event_customer->account_status = $account_status;
			$event_customer->save();
			return Response::json(array('success'=>true));
		}
		else{
			return Response::json(array('success'=>false));
		}


	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// check if customer has already a ticket if not then it will 
		// add up to the event_customers
		// if yes it will remove user from customer ticket

		//check the first available ticket
		// $events = Event::where('events.deleted_at', '=', NULL)
  //                                           ->leftJoin('designs', 'events.design_id', '=', 'designs.id')
  //                                           ->select('*','events.id','events.deleted_at','events.created_at','events.updated_at')
  //                                           ->get();

		$check_customer = EventCustomer::where('event_id','=', Request::get('event_id'))->where('customer_id','=', Request::get('customer_id'))->get();
		
		$account_status = 'not paid';
		$balance = Event::where('id','=',Request::get('event_id'))->pluck('ticket_price');

		
		$tickets = Ticket::where('tickets.event_id','=',Request::get('event_id'))->get();
		$customers = EventCustomer::where('event_id','=', Request::get('event_id'))->get();
		$available_ticket_no = array();
		$good = true;
		
		foreach ($tickets as $key => $value) {
			if(sizeof($customers)){
				foreach ($customers as $key2 => $value2) {
					if($value2->ticket_no == $value->filename){
						$good = false;
						break;
					}
				}
			}
			if($good){
				array_push($available_ticket_no, $value->filename);		
			}
			$good = true;

		}
        

		if(!sizeof($check_customer)) // add
		{

			EventCustomer::create(array(
	            'event_id' => Request::get('event_id'),
	            'customer_id' => Request::get('customer_id'),
	            'ticket_no' => $available_ticket_no[0],
	            'account_status' => $account_status,
	            'balance' => $balance,
	        ));
	        return Response::json(array(
				'success'=> true,
				'ticket_no'=> $available_ticket_no[0],
				'total_ticket'=> (sizeof($available_ticket_no) - 1)
			));
		}
		else // remove
		{
			EventCustomer::where('customer_id','=',Request::get('customer_id'))
					->where('event_id','=',Request::get('event_id'))
					->delete();
			return Response::json(array(
				'success' => true,
				'ticket_no' => '-',
				'total_ticket'=> ( sizeof($available_ticket_no) + 1)
			));
		}

		
		// return Response::json(Request::get());

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$event_customer = EventCustomer::find($id);
		$event_customer->event_id = Request::get('event_id');
		$event_customer->customer_id = Request::get('customer_id');
		$event_customer->ticket_no = Request::get('ticket_no');
		$event_customer->account_status = Request::get('account_status');
		$event_customer->balance = Request::get('balance');
		$event_customer->save();

		// return Redirect::to('admin/users');
		return Response::json(array('success'=> true));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// $event = EventCustomer::find($id);
		// $event->deleted_at = date('Y-m-d h:m:s');
		// $event->save();
		// // return Redirect::to('admin/users');
		$event_customer = EventCustomer::where('event_id','=',Request::get('event_id'))
						->where('ticket_no','=',Request::get('ticket_no'))->get();
		if(isset($event_customer[0]))
			$customer_profile = Customer::where('id','=',$event_customer[0]->customer_id)->get();
		else{
			$customer_profile = null;
			$event_customer = null;
		}

		return Response::json(array(
			'success'=> $event_customer,
			'customer_profile'=> $customer_profile,
		));

	}


}
