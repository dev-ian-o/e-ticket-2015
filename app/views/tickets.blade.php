<!DOCTYPE html>
<html>
<head>
	<title>E-ticker | Viewport</title>
	<link rel="stylesheet" type="text/css" href="/assets/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/fontawesome/css/font-awesome.min.css">
	<style type="text/css">
		.loader{
			position: absolute;
			top: 50%;
			left: 50%;
		}
		.viewport-ticket{
			height: 200px;
			width: 800px;
			border: 1px solid #000;
		}
		body{
			/*background: #ccc;*/
		}
	</style>
</head>
<body class="container">
	
	<button id="save-btn" class="btn btn-primary">Save design</button>
	<img src="/images/barcode.png" id="barcode-image" class="hide">
	<div >

			<span class="fa fa-spinner fa-4x fa-spin loader"></span>
			<form enctype="multipart/form-data">
				<input type="file" name="file" id="imgLoader">
				<input type="hidden" name="id" value="1">
				<input type="hidden" name="event_id" value="1">
				<input type="hidden" name="design_name" value="sample">

			</form>
			<section>
				<canvas id="viewport-ticket" class="viewport-ticket" width="800" height="200">
				</canvas>
			</section>
	</div>
</body>

	<script type="text/javascript" src="/assets/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="/assets/fabricjs/dist/fabric.min.js"></script>
	<script type="text/javascript" src="/js/loader.js"></script>
	 <script type="text/javascript">
		$('document').ready(function(){
			canvas = new fabric.Canvas('viewport-ticket');

			arrCodes = [];
			// pre = 'sample';
			start = 1;
			end = 100;
			length = 4;
			a = 0;

			while(start <= end){
				zero = '';
				codeLn = start.toString().length;
				while(codeLn < length){zero += '0'; codeLn++;}
				code = zero + start;
				arrCodes[a++] = code;
				
				start++;
			}
			
				id = 1;
				$.ajax({
				        type: "GET",
				        url: '/api/v1/designs/'+id,
				        processData: false,
				        contentType: false,
				        success: function(response)
				        {
				        	// console.log(response);
				            renderWithJson($.parseJSON(decodeURI(response[0].json_object)));
				        },
				        complete: function()
				        {
				            // Allow form to be submited again
				        },
				        dataType: 'json'
				    });

			
		});


		$('#save-btn').on('click',function(){
			
			// console.log(arrCodes);
			length = arrCodes.length - 1;
			while(length >= 0){

				objLn = canvas.getObjects().length -1;
				while(objLn > 0){ 
					if(canvas.item(objLn).type === "text"){
						canvas.item(objLn).text  = arrCodes[length];
					}else if(canvas.item(objLn).type === "image"){
						if( canvas.item(objLn).src.indexOf('user_images') == -1  )
						{
							canvas.item(objLn).src = 'barcodes/'+ arrCodes[length]+'.png';
							// console.log('here');
						}
					}
					objLn--;
				}
				canvas.renderAll();

				$.ajax({
			        type: "GET",
			        url: '/tickets/save?name='+arrCodes[length]+'&'+'code='+canvas.toSVG(),
			        processData: false,
			        contentType: false,
			        success: function(response)
			        {
			            console.log(response);

			        },
			        complete: function()
			        {

			        },
			        dataType: 'json'
			    });	

				length--;
			}
			
		});

		var renderWithJson = function(json){
			canvas.loadFromJSON(json, function() {
			    canvas.renderAll();
			});
		};
		
		var changeBarcode = function(barcode){

		};

		var getBarcodes = function(){

		};

	</script>
		
</html>