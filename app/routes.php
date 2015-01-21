
<?php

include_once 'routes-api.php';



Route::get('/', function()
{	
	$folders = array('images','barcodes','tickets');
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
           'path' => public_path().'\\tickets\\'.$folder.'\\'.$name.'.svg',
			'filename' => $name.".svg",
			'event_id' => $event_id
        ));
	}else{
		$ticket = Ticket::where('filename',$name.".svg")->where('event_id',$event_id)->first();
		$ticket->path = public_path().'\\tickets\\'.$folder.'\\'.$name.'.svg';
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
	return View::make('login');
});

Route::post('/api/v1/auth', function()
{
	$data = Input::get();
	print_r($data);
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

// function saveTicket($code,$name){
// 	$img = str_replace('data:image/png;base64,', '', $code);
// 	$img = str_replace(' ', '+', $img);
// 	$data = base64_decode($img);
// 	$path = public_path().'\\tickets\\'. $name.'.png';
// 	file_put_contents($path, $data);


// }
