@extends('layouts.main')

@section('container')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="row align-items-center mb-2">
        <div class="col">
          <h2 class="h5 page-title d-inline">Welcome!</h2>
          <p class="text-muted">Daily Distribution CJ - Cashless</p>
        </div>
        <div class="col-auto">
          <form class="form-inline">
            <div class="form-group d-none d-lg-inline">
              <label for="reportrange" class="sr-only">Date Ranges</label>
              <div id="reportrange" class="px-2 py-2 text-muted">
                <span class="small"></span>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="mb-2 align-items-center">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="row my-4">
              <div class="col-md-12">
                <div class="chart-box" id="columnChart"></div>
                </div>
              </div> <!-- .col -->
            </div> <!-- end section -->
          </div> <!-- .card-body -->
        </div> <!-- .card -->
      </div>
      
    </div> <!-- .col-12 -->
  </div> <!-- .row -->
</div> <!-- .container-fluid -->

@endsection

@section('addon-page')

<script src="{{ asset('js/apexcharts.min.js') }}"></script>

<script>
  moment_start = moment().subtract(2, 'days');
  moment_end =moment();
  var filter_daterange = function(start, end){
    
  }
</script>

<script type="text/javascript">
  var langs = @json($list_date);
  var admission = @json($admission);
  console.log(langs);
  console.log(admission);
</script>

<script>
  var list_date = @json($list_date);
  var admission = @json($admission);
  var monitoring = @json($monitoring);
  var discharge = @json($discharge);

  var columnChart, columnChartoptions = {
      series: [{
        name: "Admission",
        // data: admission
        data: [17, 12,34, 13, 7, 18, 28, 3, 17, 31, 22, 32, 10, 20, 19, 19, 28, 13]
      }, {
        name: "Monitoring",
        // data: monitoring
        data: [7, 30, 13, 23, 20, 12, 8, 13, 27, 17, 20, 18, 3, 24, 19, 12, 23, 3]
      }, {
        name: "Discharge",
        // data: discharge
        data: [9, 20, 13, 23, 15, 12, 18, 45, 23, 7, 30, 13, 23, 20, 12, 8, 13, 27]
      }],
      chart: {
        type: "bar",
        height: 390,
        stacked: !1,
        columnWidth: "70%",
        zoom: {
          enabled: !1
        },
        toolbar: {
          show: !1
        },
        background: "transparent"
      },
      dataLabels: {
        enabled: !1
      },
      theme: {
        mode: colors.chartTheme
      },
      responsive: [{
        breakpoint: 480,
        options: {
          legend: {
            position: "bottom",
            offsetX: -10,
            offsetY: 0
          }
        }
      }],
      plotOptions: {
        bar: {
          horizontal: !1,
          columnWidth: "35%",
          radius: 30,
          enableShades: !1,
          endingShape: "rounded"
        }
      },
      xaxis: {
        type: "datetime",
        // categories: ['01/01/2020', '01/02/2020', '01/03/2020', '01/04/2020', '01/05/2020', '01/06/2020', '01/07/2020', '01/08/2020', '01/09/2020', '01/10/2020', '01/11/2020', '01/12/2020', '01/13/2020', '01/14/2020', '01/15/2020', '01/16/2020', '01/17/2020', '01/18/2020',],
        categories: list_date,
        tickPlacement: 'on',
        labels: {
          show: !0,
          trim: !0,
          minHeight: void 0,
          maxHeight: 120,
          style: {
            colors: colors.mutedColor,
            cssClass: "text-muted",
            fontFamily: base.defaultFontFamily
          }
        },
        axisBorder: {
          show: !1
        }
      },
      yaxis: {
        labels: {
          show: !0,
          trim: !1,
          offsetX: -10,
          minHeight: void 0,
          maxHeight: 120,
          style: {
            colors: colors.mutedColor,
            cssClass: "text-muted",
            fontFamily: base.defaultFontFamily
          }
        }
      },
      legend: {
        position: "top",
        fontFamily: base.defaultFontFamily,
        fontWeight: 400,
        labels: {
          colors: colors.mutedColor,
          useSeriesColors: !1
        },
        markers: {
          width: 10,
          height: 10,
          strokeWidth: 0,
          strokeColor: "#fff",
          fillColors: ['#1b68ff', '#20c997', '#fd7e14'],
          radius: 6,
          customHTML: void 0,
          onClick: void 0,
          offsetX: 0,
          offsetY: 0
        },
        itemMargin: {
          horizontal: 10,
          vertical: 5
        },
        onItemClick: {
          toggleDataSeries: !0
        },
        onItemHover: {
          highlightDataSeries: !0
        }
      },
      fill: {
        opacity: 1,
        colors: ['#1b68ff', '#20c997', '#fd7e14']
      },
      grid: {
        show: !0,
        borderColor: colors.borderColor,
        strokeDashArray: 0,
        position: "back",
        xaxis: {
          lines: {
            show: !1
          }
        },
        yaxis: {
          lines: {
            show: !0
          }
        },
        row: {
          colors: void 0,
          opacity: .5
        },
        column: {
          colors: void 0,
          opacity: .5
        },
        padding: {
          top: 0,
          right: 20,
          bottom: 0,
          left: 0
        }
      }
    },
    columnChartCtn = document.querySelector("#columnChart");
    columnChartCtn && (columnChart = new ApexCharts(columnChartCtn, columnChartoptions)).render();
</script>
@endsection