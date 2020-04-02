@extends('admin.layouts.master')
@section('content')
    <ul class="breadcrumb">
        <li><a href="{{ route('admin.home.index') }}">Home</a></li>
        <li class="active">Patient Management</li>
    </ul>
<div ng-controller="PatientsurgeryListController">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a ng-href="{{ route('patient.index') }}" class="button ui big positive labeled icon">
                <i class="icon list"></i>Patient List
            </a>
        </div>
        <div>
            <div data-ui-grid="gridOptions" ui-grid-exporter ui-grid-resize-columns ui-grid-move-columns ui-grid-save-state
                 data-ui-grid-infinite-scroll data-ui-grid-selection  ui-grid-pagination  class="grid"></div>
        </div>

    </div>
</div>
@endsection
@section('script')
    <script>
        

        app.controller('PatientsurgeryListController', ['$scope', '$http', '$timeout', 'localStorageService', 'uiGridConstants', function ($scope, $http, $timeout, $localStorageService, uiGridConstants) {
            $scope.moduleUrl = "{{ route('patient.surgeryList') }}/";



           
            var columnDefs = [
                { name: "Date of surgery", field:"date_of_surgery", minWidth: 100, width: 130},
                { name: "Surgery sub category", field:"surgery_sub_category", minWidth: 100, width: 130},
                { name: "Description", field:"description", minWidth: 100, width: 130},
                { name: "Level of supervision", field:"level_of_supervision", minWidth: 100, width: 130},
                { name: 'Date of review', field: 'date_of_review', minWidth: 100, width: 130},
                { name: 'Complication', field: 'complication', minWidth: 100, width: 130},
                { name: 'Surgery', field: 'surgery', minWidth: 100, width: 130},
                { displayName: 'Patient ID', field: 'patient.patient_uuid', minWidth: 100, width: 130},
                { displayName: 'BHT No', field: 'patient.B_H_T', minWidth: 150, width: 150},
                { displayName: 'Name', field: 'patient.name', minWidth: 150, width: 150},
                { displayName: 'Age', field: 'patient.age', minWidth: 60, width: 60},
                { displayName: 'Sex', field: 'patient.sex', minWidth: 80, width: 80},
                { displayName: 'Phone', field: 'patient.phone', minWidth: 150, width: 150},
               
            ];

            gridOptions.multiSelect = true;
            gridOptions.enableRowSelection = true;
            gridOptions.expandableRowHeight = 150;
            gridOptions.columnDefs = columnDefs;
            gridOptions.enableGridMenu = true;
            gridOptions.enableColumnResizing = true;
            gridOptions.enableSelectAll = true;
            gridOptions.exporterMenuCsv = true;
            gridOptions.enableRowSelection = true;
            gridOptions.enableFiltering = true;
            gridOptions.enableColumnReordering = true;
            gridOptions.enableRowHeaderSelection = false;

            gridOptions.showGridFooter = true;


            gridOptions.exporterCsvFilename = 'PatientsurgeryLists.csv';
           


            gridOptions.exporterPdfOrientation = 'landscape',
                gridOptions.exporterPdfPageSize = 'LETTER',
                gridOptions.exporterPdfMaxGridWidth = 600,
                


                gridOptions.onRegisterApi = function (gridApi) {
                $scope.gridApi = gridApi;
                gridApi.selection.on.rowSelectionChanged($scope, function (rows) {
                    $scope.setSelection(gridApi);
                });

               


                // Setup events so we're notified when grid state changes.
                $scope.gridApi.colMovable.on.columnPositionChanged($scope, saveState);
                $scope.gridApi.colResizable.on.columnSizeChanged($scope, saveState);
//                $scope.gridApi.grouping.on.aggregationChanged($scope, saveState);
//                $scope.gridApi.grouping.on.groupingChanged($scope, saveState);
                $scope.gridApi.core.on.columnVisibilityChanged($scope, saveState);
                $scope.gridApi.core.on.filterChanged($scope, saveState);
                $scope.gridApi.core.on.sortChanged($scope, saveState);

                $scope.gridApi.core.notifyDataChange(uiGridConstants.dataChange.OPTIONS);


                // Restore previously saved state.
                restoreState();
            }

            

            function saveState() {
                var state = $scope.gridApi.saveState.save();
                $localStorageService.set('gridState', state);
            }


            function restoreState() {
                $timeout(function() {
                    var state = $localStorageService.get('gridState');
                    if (state) $scope.gridApi.saveState.restore($scope, state);
                });
            }

            $scope.gridOptions = gridOptions;
            $http.get($scope.moduleUrl + '?ajax=true').success(function (data) {
                console.log('data', data);
                
                $scope.gridOptions.data =  data;
            });

            $scope.setSelection = function(gridApi) {
                $scope.mySelections = gridApi.selection.getSelectedRows();

                
            };


        }]);

    </script>
@endsection