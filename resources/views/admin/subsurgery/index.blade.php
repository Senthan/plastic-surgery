@extends('admin.layouts.master')
@section('content')
    <ul class="nav nav-tabs">
        <li class="{{ request()->is('dose*') ? 'active' : '' }}"><a href="{{ route('dose.index') }}">Sub Surgery</a></li>
        <li class=""><a href="{{ route('drug.index') }}">Surgery</a></li>
    </ul>
    <ul class="breadcrumb">
        <li><a href="{{ route('patient.index') }}">Home</a></li>
        <li class="active">Sub Surgery</li>
    </ul>
    <div class="panel panel-default" ng-controller="drugController">
        <div class="panel-heading">
            <a href="{{ route('dose.create') }}" class="button ui big positive labeled icon">
                <i class="icon add"></i>Create
            </a>
            <a ng-show="selected" ng-href="@{{ edit_url }}" class="button ui big labeled icon blue a-load">
                <i class="icon pencil"></i>Edit
            </a>
            {{--<a ng-show="selected" ng-href="@{{ delete_url }}" class="button ui big negative labeled icon a-load ">--}}
                {{--<i class="icon trash"></i>Delete--}}
            {{--</a>--}}
        </div>
        <div class="panel-body">

            @if (session('message'))
                <div class="alert alert-success alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a>
                    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
                    {{ session('message') }}
                </div>
            @endif

            <div>
                <div ui-grid="gridOptions" ui-grid-pagination ui-grid-selection class="grid"></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        app.controller('drugController', ['$scope', '$http', function ($scope, $http) {
            $scope.moduleUrl = "{{ route('subsurgery.index') }}/";
            $scope.drugs = [];
            var columnDefs = [
                { displayName: 'sub_surgery', field: 'sub_surgery'},
                { displayName: 'surgery', field: 'surgery'}
            ];
            gridOptions.columnDefs = columnDefs;
            gridOptions.onRegisterApi = function (gridApi) {
                $scope.gridApi = gridApi;
                gridApi.selection.on.rowSelectionChanged($scope,function(rows){
                    $scope.setSelection(gridApi);
                });
                gridApi.selection.on.rowSelectionChangedBatch($scope,function(rows){
                    $scope.setSelection(gridApi);
                });
            };
            $scope.gridOptions = gridOptions;
            $http.get($scope.moduleUrl + '?ajax=true').success(function (data) {
                $scope.drugs = data;
                $scope.gridOptions.data =  data;
            });
            $scope.setSelection = function(gridApi) {
                $scope.mySelections = gridApi.selection.getSelectedRows();
                if($scope.mySelections.length == 1) {
                    $scope.selected = $scope.mySelections[0];
                    $scope.show_url = $scope.moduleUrl + $scope.selected.id + '';
                    $scope.edit_url = $scope.moduleUrl + $scope.selected.id + '/edit';
                    $scope.delete_url = $scope.moduleUrl + $scope.selected.id + '/delete';
                } else {
                    $scope.selected = null;
                }
            };
        }]);
    </script>
@endsection