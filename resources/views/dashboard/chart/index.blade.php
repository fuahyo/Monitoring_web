
@extends('dashboard.layouts.main')

@section('container')
	
	<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-2 border-bottom">
        <h2
		 class=" m-0 font-weight-bold text-danger mb-3">Report</h1>
    </div>
	<div class="row">
		<div class="col-lg-6 mb-4">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center">
					<h5 class="m-0 font-weight-bold text-danger">Chart CAPA By Status</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<!-- <div class="chart-area">
						<canvas id="chart2"></canvas>
					</div> -->
					<div class="panel panel-headline">
						<div class="panel-heading" id="chart2">
							
						</div>
						<div class="panel-body">
							<div class="row">
								
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 mb-4">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h5 class="m-0 font-weight-bold text-danger">Chart CAPA By Root Cause</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="panel panel-headline">
					<div class="panel-heading" id="chart1">
						<div class="panel-body"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<!-- Content Column -->
		<div class="col-lg-6 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-danger">Tabel CAPA By Status</h6>
				</div>
				<div class="card-body">
					<table class="table table-striped table-bordered" style="width: 100%;">
						<thead>
							<tr>
								<th>Category</th>
								@foreach ($subcategories as $subcategory)
									<th class="text-center">{{ $subcategory->name }}</th>
								@endforeach
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $category)
								<tr>
									<td>{{ $category->name }}</td>
									@foreach ($subcategories as $subcategory)
										<td class="text-center">
											@if (isset($posts1[$category->name][$subcategory->name]))
												{{ $posts1[$category->name][$subcategory->name]->count() }}
											@else
												0
											@endif
										</td>
									@endforeach
								</tr>
							@endforeach
						</tbody>
					</table>
					
				</div>
			</div>
		</div>
		<div class="col-lg-6 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-danger">Tabel CAPA By Root Cause</h6>
				</div>
				<div class="card-body">
					<table class="table table-striped table-bordered" style="width: 100%;">
						<thead>
							<tr>
								<th>Category</th>
								@foreach ($subcategories2 as $subcategory)
									<th class="text-center">{{ $subcategory->name }}</th>
								@endforeach
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $category)
								<tr>
									<td>{{ $category->name }}</td>
									@foreach ($subcategories2 as $subcategory)
										<td class="text-center">
											@if (isset($posts2[$category->name][$subcategory->name]))
												{{ $posts2[$category->name][$subcategory->name]->count() }}
											@else
												0
											@endif
										</td>
									@endforeach
								</tr>
							@endforeach
						</tbody>
					</table>
					
				</div>
			</div>
		</div>
		<!-- <div class="col-lg-6 mb-4">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Projects</h6>
				</div>
				<div class="card-body">
					<h4 class="small font-weight-bold">Server Migration <span
							class="float-right">20%</span></h4>
					<div class="progress mb-4">
						<div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
							aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">Sales Tracking <span
							class="float-right">40%</span></h4>
					<div class="progress mb-4">
						<div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
							aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">Customer Database <span
							class="float-right">60%</span></h4>
					<div class="progress mb-4">
						<div class="progress-bar" role="progressbar" style="width: 60%"
							aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">Payout Details <span
							class="float-right">80%</span></h4>
					<div class="progress mb-4">
						<div class="progress-bar bg-info" role="progressbar" style="width: 80%"
							aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">Account Setup <span
							class="float-right">Complete!</span></h4>
					<div class="progress">
						<div class="progress-bar bg-success" role="progressbar" style="width: 100%"
							aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>
		</div>	 -->
	</div>
	
	<div class="column">
		
	</div>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/heatmap.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<script>
		// Data retrieved from: https://www.uefa.com/uefachampionsleague/history/
		Highcharts.chart('chart1', {
			chart: {
				type: 'bar'
			},
			title: {
				text: 'Report CAPA by Root Cause'
			},
			xAxis: {
				categories: {!!json_encode($alldept)!!},
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Amount of CAPA'
				}
			},
			legend: {
				reversed: true
			},
			plotOptions: {
				series: {
					stacking: 'normal'
				}
			},
			series: [  {
				name: 'Man',
				data: {!!json_encode($man)!!}
			}, {
				name: 'Machine',
				data: {!!json_encode($machine)!!}
			}, {
				name: 'Methode',
				data: {!!json_encode($methode)!!}
			}, {
				name: 'Material',
				data: {!!json_encode($material)!!}
			},{
				name: 'Mileau',
				data: {!!json_encode($mileau)!!}
			}]
		});


		Highcharts.chart('chart2', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Report CAPA by Status',
				align: 'center'
			},
			xAxis: {
				categories: {!!json_encode($alldept)!!},
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Amount of CAPA'
				},
				stackLabels: {
					enabled: true,
					style: {
						fontWeight: 'bold',
						color: ( // theme
							Highcharts.defaultOptions.title.style &&
							Highcharts.defaultOptions.title.style.color
						) || 'gray',
						textOutline: 'none'
					}
				}
			},
			legend: {
				reversed: true
			},
			
			plotOptions: {
				series: {
					stacking: 'normal'
				}
			},
			series: [  {
				name: 'Done',
				data: {!!json_encode($capadone)!!}
			}, {
				name: 'Cancel',
				data: {!!json_encode($capacancel)!!}
			}, {
				name: 'Closed',
				data: {!!json_encode($capaclose)!!}
			}, {
				name: 'Open',
				data: {!!json_encode($capaopen)!!}
			},]
		});

	</script>
	
@endsection