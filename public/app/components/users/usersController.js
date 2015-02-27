



app.controller('usersController',function($scope,$http,$compile,userData){
	$scope.values = {
		"id" : "1",
		"email" : "ianolinares@ymail.com",
		"user_group_id" : "1",
	};
	
    $http.get("/api/v1/users")
    .success(function(response) {
    	$scope.data = response;
    	
    	jQuery('.datatable').dataTable({
			"data": $scope.data,
			"columns": [
		        { "data": "id" },
		        { "data": "email" },
		        { "data": "groupname" },
		        { "data": null},
		    ],
		    "fnCreatedRow": function( nRow, aData, iDataIndex ) {


		    	data = [ aData.id,aData.user_group_id,aData.email ];
		    	values = "";

    			$.each(data,function(index,value){
					if(index != data.length -1)
						values += "'"+value+"',";
					else
						values += "'"+value+"'";

    			});	
				// console.log(values);

		    	editButton = '<button data-id="'+aData+'" class="btn btn-warning edit" ng-click="showEditModal('+values+')"><i class="fa fa-pencil"></i></button>';
		    	deleteButton = '<button class="btn btn-danger delete"><i class="fa fa-trash-o"></i></button>';
		    	buttons = $("<div>" + editButton + deleteButton + "</div>");
				$el = $('td:last', nRow).html(editButton +' '+deleteButton);

			    $compile($el)($scope);

			},
		}); 


    });

	console.log(userData.data());

    $scope.showEditModal = function(id,user_group_id,email){
    	$scope.values = {
    		"id":  id,
    		"user_group_id": user_group_id,
    		"email": email,
    	};
    	console.log(id);

		$('#modal-edit').modal('show');
    };



});




app.factory('serviceId', function() {
  var shinyNewServiceInstance;
  // factory function body that constructs shinyNewServiceInstance
  return shinyNewServiceInstance;
});