
<?php

include_once 'routes-api.php';



Route::get('/', function()
{	
	$folders = array('images','barcodes','tickets','designs');
	$foldersLn = sizeof($folders) - 1;

	while($foldersLn >= 0){

		if(!file_exists( public_path().'\\'.$folders[$foldersLn]))
			File::makeDirectory(public_path().'\\'.$folders[$foldersLn]);
		$foldersLn--;		
	}

	return View::make('index');



});

Route::get('/generate', function()
{

	$arrCodes = [];
	// $pre = "sample";
	$start = 1;
	$end = 1000;
	$length = 4;
	$a = 0;

	while($start <= $end){
		$zero = '';
		$codeLn = strlen( (string) $start );
		while($codeLn < $length){$zero .= '0'; $codeLn++;}
			$code = $zero . $start;
			$arrCodes[$a++] = $code;
			saveBarcode($code);
			$start++;
		}

});


Route::get('/generate/tickets', function()
{

	return View::make('tickets');


});

Route::post('/generate/tickets', function()
{

	$arrCodes = [];
	$start = 1;
	$end = 1000;
	$length = 4;
	$a = 0;

	while($start <= $end){
		$zero = '';
		$codeLn = strlen( (string) $start );
		while($codeLn < $length){$zero .= '0'; $codeLn++;}
		$code = $zero . $start;
		$arrCodes[$a++] = $code;
		saveBarcode($code);
		$start++;
	}


});

Route::post('/upload/photos', function()
{
	$image = Input::file('file');
    $path = public_path()."\\users_images\\";
    $name =  time().".".Input::file('file')->guessClientExtension();
    Input::file('file')->move($path,$name);
    return Response::json(array("path"=>$name));
});


Route::get('/tickets/save', function()
{
	$code = Request::get('code');
	$name = Request::get('name');
	$event_id = '1';
	$folder = strtolower("event1"); //based on event title

	if(!file_exists( public_path().'\\tickets\\'.$folder))
		File::makeDirectory(public_path().'\\tickets\\'.$folder);

	saveTicket($code,$name,$folder);
	

	if(!DB::table('tickets')->where("filename",$name.'.svg')->pluck('id'))
	{
		Ticket::create(array(
           'path' => URL::to('tickets/'.$folder.'/'.$name.'.svg'),
			'filename' => $name.".svg",
			'event_id' => $event_id
        ));
	}else{
		$ticket = Ticket::where('filename',$name.".svg")->where('event_id',$event_id)->first();
		// $ticket->path = public_path().'\\tickets\\'.$folder.'\\'.$name.'.svg';
		$ticket->path = URL::to('tickets/'.$folder.'/'.$name.'.svg');

		
		$ticket->filename = $name.".svg";
		$ticket->event_id = $event_id;
		$ticket->save();
	}


    return Response::json(array('success'=>true));


});

Route::get('/sample', function()
{
	$barcodeName = "0001.png";
	$text = '<?xml version="1.0" encoding="UTF-8" standalone="no" ?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="800" height="200" xml:space="preserve"><desc>Created with Fabric.js 1.4.13</desc><defs></defs><g transform="translate(281 219)"><image xlink:href="http://localhost:8000/users_images/1421491354.png" x="-250" y="-250" style="stroke: none; stroke-width: 1; stroke-dasharray: ; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" width="500" height="500" preserveAspectRatio="none"></image></g><g transform="translate(586 162)"><text font-family="Times New Roman" font-size="40" font-weight="normal" style="stroke: none; stroke-width: 1; stroke-dasharray: ; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform="translate(-40 42)"><tspan x="0" y="-26" fill="rgb(0,0,0)">0000</tspan></text></g><g transform="translate(592 119)"><image xlink:href="http://localhost:8000/images/barcode.png" x="-62" y="-15" style="stroke: none; stroke-width: 1; stroke-dasharray: ; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" width="124" height="30" preserveAspectRatio="none"></image></g></svg>';
	// $text = str_replace("/images/barcode.png", "/barcodes/". $barcodeName, $text);
	$dirBarcodes = scandir(public_path().'\barcodes');
	$dirTickets = scandir(public_path().'\barcodes');

	// return $text;

});


Route::get('/login', function()
{
	if(Auth::check())
        return View::make('admin.index');
    else
        return View::make('login');
});

function saveBarcode($code){
	$img ='data:image/png;base64,' . DNS1D::getBarcodePNG($code, "CODABAR");
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$path = public_path().'\\barcodes\\'. $code.'.png';
	file_put_contents($path, $data);	
}



function saveTicket($code,$name,$folder){

	$path = public_path().'\\tickets\\'.$folder.'\\'.$name.'.svg';
	File::put($path, $code);		

}

Route::post('/api/v1/auth', function()
{
	$userdata = array(
        'email' => Input::get('email'),
        'password' => Input::get('password')
    );

    if(Auth::attempt($userdata)) 
        return Redirect::to('admin');
    else
        return Redirect::back()->withErrors(['Invalid username or password']);
});

Route::match(array('GET', 'POST'), '/logout', function()
{
	Auth::logout();
    return Redirect::to('login');
});

Route::get('/tickets/save/v2/{id}', function($id)
{
	if(Event::where('id', '=', $id)->first()){
		$event = Event::where('events.id', '=', $id)
	            ->leftJoin('designs', 'events.design_id', '=', 'designs.id')
	            ->select('*','events.id','events.deleted_at','events.created_at','events.updated_at')
	            ->first();

	    // check barcodes available
	    $barcode_dir =  public_path()."\barcodes";
	    $barcodes = File::allFiles($barcode_dir);
	    $barcode_no = 0;
		foreach ($barcodes as $file)
			$barcode_no++;
		
		$folder = $event->id; //based on event id
		if(!file_exists( public_path().'\\tickets\\'.$folder))
			File::makeDirectory(public_path().'\\tickets\\'.$folder);

		if(!$barcode_no >= $event->barcode_no_end) // check if available if not then generate missing
			generate_barcode($barcode_no += 1,$event->barcode_no_end);
		

	    $design_url = $event->design_path;
	    $svgFile =  end((explode('/', $design_url))); //get url end
	    $svgCode = File::get(public_path().'\\designs\\'.$svgFile); // get laman ng design svg

		//edit here now svg code;
		$dom = new DOMDocument();
		$dom->load(public_path().'\\designs\\'.$svgFile);
		$root = $dom->documentElement;

		
		$textDOM = $root->getElementsByTagName("text");
		$imageDOM = $root->getElementsByTagName("image");


		$start = $event->barcode_no_start;
		$end = $event->barcode_no_end;

		$length = strlen( (string) $end );
		if($length < 4)
			$length = 4;
		$a = 0;

		DB::table('tickets')->where('event_id', '=', $event->id)->delete();
		
		while($start <= $end){
			$zero = '';
			$codeLn = strlen( (string) $start );
			while($codeLn < $length){$zero .= '0'; $codeLn++;}
			$codeBar = $zero . $start;
			$arrCodes[$a++] = $codeBar;

			if(!file_exists( public_path().'\\barcodes\\'.$codeBar.'.svg'))
				saveBarcode($codeBar);

			foreach ($textDOM as $key => $value) {
				$dom->getElementsByTagName("text")->item($key)->nodeValue = $codeBar; //change sample to change the text
			}

			foreach ($imageDOM as $key => $value) {
				foreach($value->attributes as $key2 => $value2){
					if(!strrpos($value2->nodeValue, 'users_images')){
						if(strrpos($value2->nodeValue, 'images/barcode.png')){ // edit here
							$value2->nodeValue = "http://localhost:8000/barcodes/".$codeBar.".png"; 
						}
					}
				}
			}
		
			$code = $dom->saveXML();
			$path = public_path().'\\tickets\\'.$folder.'\\'.$codeBar.'.svg'; 
			// print_r($path);
			// print_r($code);
			File::put($path, $code); 

			if(!DB::table('tickets')->where("filename",$codeBar.'.svg')->pluck('id'))
			{
				Ticket::create(array(
		           'path' => URL::to('tickets/'.$folder.'/'.$codeBar.'.svg'),
					'filename' => $codeBar,
					'event_id' => $event->id
		        ));
			}else{
				// $ticket = Ticket::where('filename',$codeBar.".svg")->where('event_id',$event->id)->first();
				// // $ticket->path = public_path().'\\tickets\\'.$folder.'\\'.$name.'.svg';
				// $ticket->path = URL::to('tickets/'.$folder.'/'.$codeBar.'.svg');

				
				// $ticket->filename = $codeBar.".svg";
				// $ticket->event_id = $event->id;
				// $ticket->save();
			}
			$start++;
		}

		return Response::json(array('success'=>true));		
	}
		return Response::json(array('success'=>false));		


});

// function saveTicket($code,$name){
// 	$img = str_replace('data:image/png;base64,', '', $code);
// 	$img = str_replace(' ', '+', $img);
// 	$data = base64_decode($img);
// 	$path = public_path().'\\tickets\\'. $name.'.png';
// 	file_put_contents($path, $data);


// }

function generate_barcode($start,$end){
	$arrCodes = [];
	// $start = 1;
	// $end = 1000;
	$length = strlen( (string) $end );
	$a = 0;

	while($start <= $end){
		$zero = '';
		$codeLn = strlen( (string) $start );
		while($codeLn < $length){$zero .= '0'; $codeLn++;}
		$code = $zero . $start;
		$arrCodes[$a++] = $code;
		saveBarcode($code);
		$start++;
	}
}