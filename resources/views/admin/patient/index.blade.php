@extends('admin.layouts.master')
@section('content')
    <ul class="breadcrumb">
        <li><a href="{{ route('admin.home.index') }}">Home</a></li>
        <li class="active">Patient Management</li>
    </ul>
<div ng-controller="PatientController">
    <div class="panel panel-default">
        <div class="panel-heading">

            <a ng-href="{{ route('patient.surgeryList') }}" class="button ui big positive labeled icon">
                <i class="icon list"></i>Surgery List
            </a>

            <a ng-href="{{ route('subsurgery.index') }}" class="button ui big blue labeled icon">
                <i class="icon list"></i>subsurgery
            </a>

            <a ng-href="{{ route('patient.create') }}" class="button ui big positive labeled icon">
                <i class="icon add"></i>Create
            </a>
   
           

           <a ng-show="selected" ng-href="@{{ surgical_url  }}" class="button ui big labeled olive icon">
                <i class="icon add"></i>Surgical
            </a>
         

            <a ng-show="selected" ng-href="@{{ show_url }}" class="button ui big labeled icon a-load orange">
                <i class="list layout icon"></i>Summary
            </a>
            <a ng-show="selected" ng-href="@{{ delete_url }}" class="button ui big negative labeled icon a-load ">
                <i class="icon trash"></i>Delete
            </a>

        </div>
        <div>
            <div data-ui-grid="gridOptions" ui-grid-exporter ui-grid-resize-columns ui-grid-move-columns ui-grid-save-state
                 data-ui-grid-infinite-scroll data-ui-grid-selection ui-grid-expandable ui-grid-grouping ui-grid-pagination ui-grid-edit class="grid"></div>
        </div>

    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.ui.dropdown')
                .dropdown();
        });

        app.controller('PatientController', ['$scope', '$http', '$timeout', 'localStorageService', 'uiGridConstants', function ($scope, $http, $timeout, $localStorageService, uiGridConstants) {
            $scope.moduleUrl = "{{ route('patient.index') }}/";

//        var myAwesomeSortFn = function(a,b) {



            var myAwesomeSortFn = function (a, b) {
                var NUMBER_GROUPS = /(-?\d*\.?\d+)/g;
                    console.log('a', a, 'b', b);
                var aa = String(a).split(NUMBER_GROUPS),
                    bb = String(b).split(NUMBER_GROUPS),
                    min = Math.min(aa.length, bb.length);

                var x = aa[1] + aa[3];
                var y = bb[1] + bb[3];

                if (x < y) return -1;
                else if (x > y) return 1;

//                for (var i = 0; i < min; i++) {
//                    var x = parseFloat(aa[i]),
//                        y = parseFloat(bb[i]);
//                    if (x < y) return -1;
//                    else if (x > y) return 1;
//                }

                return 0;
            };
            var columnDefs = [
                { displayName: 'Patient ID', field: 'patient_uuid', minWidth: 100, width: 130, pinnedLeft:true, sortAlgorithm: myAwesomeSortFn},
                { displayName: 'BHT No', field: 'B_H_T', minWidth: 150, width: 150},
                { displayName: 'Name', field: 'name', minWidth: 150, width: 150},
                { displayName: 'Age', field: 'age', minWidth: 60, width: 60},
                { displayName: 'Sex', field: 'sex', editableCellTemplate: 'ui-grid/dropdownEditor',
                    editDropdownOptionsArray: [{ id:'Male', ward: 'Male'}, {id:'Female', ward: 'Female'}, {id:'Other', ward: 'Other'}], editDropdownValueLabel: 'ward', minWidth: 80, width: 80},
                
                { displayName: 'Phone', field: 'phone', minWidth: 150, width: 150},
               
            ];

            gridOptions.multiSelect = true;
            gridOptions.enableRowSelection = true;
            gridOptions.expandableRowTemplate = 'expandableRowTemplate.html';
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

//            gridOptions.rowTemplate = "<div ng-dblclick=\"grid.appScope.rowDblClick(row)\" ng-repeat=\"(colRenderIndex, col) in colContainer.renderedColumns track by col.colDef.name\" class=\"ui-grid-cell\" ng-class=\"{ 'ui-grid-row-header-cell': col.isRowHeader }\" ui-grid-cell></div>"


            gridOptions.exporterOlderExcelCompatibility = true;
            gridOptions.exporterCsvFilename = 'PatientDetails.csv';
            gridOptions.exporterPdfDefaultStyle = {fontSize: 9};
            gridOptions.exporterPdfTableStyle = {margin: [30, 30, 30, 30]};
            gridOptions.exporterPdfTableHeaderStyle = {fontSize: 10, bold: true, italics: true, color: 'blue'};
            gridOptions.exporterPdfHeader = { text: '', style: 'headerStyle' };
            gridOptions.exporterPdfFooter = function ( currentPage, pageCount ) {
                return { text: currentPage.toString() + ' of ' + pageCount.toString(), style: 'footerStyle' };
            };
            gridOptions.exporterPdfCustomFormatter = function ( docDefinition ) {
                docDefinition.styles.headerStyle = { fontSize: 22, bold: true };
                docDefinition.styles.footerStyle = { fontSize: 10, bold: true };
                return docDefinition;
            };
            gridOptions.exporterFieldCallback = function ( grid, row, col, value ) {
                var text = value;
                if ( col.displayName === 'Presenting complain' ) {
                    if(_.isArray(value)) {
                        text = (_.pluck(value, 'presenting_complain')).toString();
                    }
                }
                if ( col.displayName === 'CT Scan' ) {
                    if(_.isArray(value)) {
                        text = (_.pluck(value, 'ct_scan')).toString();
                    }
                }
                if ( col.displayName === 'Xary' ) {
                    if(_.isArray(value)) {
                        text = (_.pluck(value, 'x_ray')).toString();
                    }
                }
                if ( col.displayName === 'MRI' ) {
                    if(_.isArray(value)) {
                        text = (_.pluck(value, 'miri_scan')).toString();
                    }
                }
                if ( col.displayName === 'Surgical Management' ) {
                    if(_.isArray(value)) {
                        text = (_.pluck(value, 'surgery')).toString();
                    }
                }
                if ( col.displayName === 'Non Surgical Management' ) {
                    if(_.isArray(value)) {
                        text = (_.pluck(value, 'non_surgical_management')).toString();
                    }
                }
                if ( col.displayName === 'Drugs given' ) {
                    if(_.isArray(value)) {
                        text = (_.pluck(value, 'drugs_given')).toString();
                    }
                }
                if ( col.displayName === 'BMI' ) {
                    if(_.isArray(value)) {
                        text = (_.pluck(value, 'bmi')).toString();
                    }
                }
                if ( col.displayName === 'Date of surgery' ) {
                    if(_.isArray(value)) {
                        text = (_.pluck(value, 'date_of_surgery')).toString();
                    }
                }
                if ( col.displayName === 'Date of 1st visit' ) {
                    if(_.isArray(value)) {
                        text = (_.pluck(value, 'date')).toString();
                    }
                }
                return text;
            };

            gridOptions.exporterPdfOrientation = 'landscape',
                gridOptions.exporterPdfPageSize = 'LETTER',
                gridOptions.exporterPdfMaxGridWidth = 600,
                gridOptions.exporterCsvLinkElement = angular.element(document.querySelectorAll('.custom-csv-link-location')),


                gridOptions.onRegisterApi = function (gridApi) {
                $scope.gridApi = gridApi;
                gridApi.selection.on.rowSelectionChanged($scope, function (rows) {
                    $scope.setSelection(gridApi);
                });

                var updateUrl ="{{ route('patient.update') }}";

                gridApi.edit.on.afterCellEdit($scope, function (rowEntity, colDef, newValue, oldValue) {
                    var data = {};
                    data.id = rowEntity.id;
                    data.field_name = colDef.name;
                    data.new_value = newValue;

                    $http.post(updateUrl, data).success(function (response) {

                    });
                });

                gridApi.selection.on.rowSelectionChangedBatch($scope, function (rows) {
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

            $scope.rowDblClick = function( row) {
                var patientUrl = "{{ route('patient.show', ['__PATIENT__']) }}";
                patientUrl = patientUrl.replace('__PATIENT__', row.entity.id);
                window.location.href = patientUrl;
            };

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
                //console.log('data', data);
                for(i = 0; i < data.length; i++){
                    var followup = data[i].surgical.length > 0 ? true : false;
                    var followupData = data[i].surgical.concat(data[i].surgical);
                        data[i].subGridOptions = {
                        columnDefs: [
                            { name: "Date of surgery", field:"date_of_surgery"},
                            { name: "Surgery sub category", field:"surgery_sub_category"},
                            { name: "Description", field:"description"},
                            { name: "Level of supervision", field:"level_of_supervision"},
                            { name: 'Date of review', field: 'date_of_review'},
                            { name: 'Complication', field: 'complication'},
                            { name: 'Surgery', field: 'surgery'}
                        ],
                        data: followupData,
                        disableRowExpandable : followup,
                        enableColumnResizing : true
                    }
                }
                $scope.gridOptions.data =  data;
            });

            $scope.setSelection = function(gridApi) {
                $scope.mySelections = gridApi.selection.getSelectedRows();

                if($scope.mySelections.length == 1) {
                    $scope.selected = $scope.mySelections[0];
                    $scope.show_url = $scope.moduleUrl + $scope.selected.id + '';
                    $scope.edit_url = $scope.moduleUrl + $scope.selected.id + '/edit';
                    $scope.diagnosis_url = $scope.moduleUrl + $scope.selected.id + '/add-diagnosis';
                    $scope.non_surgical_url = $scope.moduleUrl + $scope.selected.id + '/non-surgical';
                    $scope.surgical_url = $scope.moduleUrl + $scope.selected.id + '/surgical';
                    $scope.refferal_url = $scope.moduleUrl + $scope.selected.id + '/refferal';
                    $scope.delete_url = $scope.moduleUrl + $scope.selected.id + '/delete';
                    $scope.non_surgical_follow_up_url = $scope.moduleUrl + $scope.selected.id + '/non-surgical-followup';
                    $scope.surgical_follow_up_url = $scope.moduleUrl + $scope.selected.id + '/surgical-followup';
                    if ($scope.selected.diagnosis && $scope.selected.diagnosis.length) {
                        $scope.exist_diagnosis_url = $scope.moduleUrl + $scope.selected.id + '/existing-diagnosis/'+ $scope.selected.diagnosis[0].id;
                    }
                }
                else {
                    $scope.selected = null;
                }
            };


        }]);

    </script>
@endsection