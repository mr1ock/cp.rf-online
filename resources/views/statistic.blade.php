@extends('layouts.master')




@section('content')
<div class="statHide">
    <input type="text" id="acc" value="{{$status->A_Num}}">
    <input type="text" id="ccc" value="{{$status->C_Num}}">
    <input type="text" id="bcc" value="{{$status->B_Num}}">
</div>

{{-- <p>Login:  {{$status->statusLogin}} </p>
<p>Server: {{$status->statusServer}} </p> --}}

    <div id="chartdiv"></div>






<script>
am4core.ready(function() {
    let acc = document.getElementById("acc").value;
    let ccc = document.getElementById("ccc").value;
    let bcc = document.getElementById("bcc").value;
    
    //acc = 10;
    //ccc = 5;
    //bcc = 17;

// Themes begin
am4core.useTheme(am4themes_material);
//am4core.useTheme(am4themes_kelly);
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.PieChart);

// Add data
chart.data = [ {
  "country": "Акретия",
  "litres": acc
}, {
  "country": "Кора",
  "litres": ccc
}, {
  "country": "Беллато",
  "litres": bcc
} ];

// Set inner radius
chart.innerRadius = am4core.percent(50);

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 1;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>

<style>
    .statHide{
        display:none;
    }
    
</style>

@endsection