<!doctype html>
<html ng-app>
    <head>
        <title>Hello AngularJS</title>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
    </head>

    <body>
        <div ng-controller="Hello">
            <table>
                <tr>
                    <td>id</td>
                    <td>group name</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr ng-repeat="">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        
        <div ng-app="" ng-init="names=[
        {name:'Jani',country:'Norway'},
        {name:'Hege',country:'Sweden'},
        {name:'Kai',country:'Denmark'}]">

        <ul>
          <li ng-repeat="value in data">
            @{{ value.id }}
            @{{ value.email }}
            @{{ value.groupname }}
            @{{ value.updated_at }}
            @{{ value.created_at }}
          </li>
        </ul>

        </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    function Hello($scope, $http) {
    $http.get('/api/v1/users').
        success(function(data) {
            debugger;
            console.log(data);
            $scope.data = data;
        });
}
</script>


<?php $a = 1;?>
                                        @foreach(User::where('deleted_at',null)->get() as $key => $value)
                                            <tr>
                                                <td>{{ $a++ }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ UserGroup::where('id',$value->user_group_id)->pluck('groupname') }}</td>
                                                <td class="action-buttons">
                                                    <input type="hidden" name="id" value="{{ $value->id }}">
                                                    <input type="hidden" name="email" value="{{ $value->email }}">
                                                    <input type="hidden" name="user_group_id" value="{{ $value->user_group_id }}">
                                                    <button class="btn btn-warning edit" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-pencil"></i></button>
                                                    <button class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach