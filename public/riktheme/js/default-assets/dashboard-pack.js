"use strict";$(document).ready(function(){for(var e={AU:{latitude:-27,longitude:133},BR:{latitude:-10,longitude:-55},BW:{latitude:-22,longitude:24},IN:{latitude:20,longitude:77},KE:{latitude:1,longitude:38},MX:{latitude:23,longitude:-102},MY:{latitude:2.5,longitude:112.5},NI:{latitude:13,longitude:-85},NZ:{latitude:-41,longitude:174},PH:{latitude:13,longitude:122},PL:{latitude:52,longitude:20},RU:{latitude:60,longitude:100},TH:{latitude:15,longitude:100},ZA:{latitude:-29,longitude:24}},a=[{code:"MX",name:"Mexico",value:114793341,color:"#a389d4"},{code:"BR",name:"Brazil",value:196655014,color:"#2466fd"},{code:"PL",name:"Poland",value:38298949,color:"#f44236"},{code:"KE",name:"Kenya",value:41609728,color:"#1dc4e9"},{code:"ZA",name:"South Africa",value:50459978,color:"#f4c22b"},{code:"RU",name:"Russia",value:142835555,color:"#f4c22b"},{code:"IN",name:"India",value:241491960,color:"#2466fd"},{code:"PH",name:"Philippines",value:94852030,color:"#04a9f5"},{code:"AU",name:"Australia",value:22605732,color:"#1dc4e9"},{code:"TH",name:"Thailand",value:69518555,color:"#f44236"},{code:"BW",name:"Botswana",value:2030738,color:"#04a9f5"},{code:"MY",name:"Malaysia",value:28859154,color:"#A389D4"},{code:"NZ",name:"New Zealand",value:4414509,color:"#04a9f5"},{code:"NI",name:"Nicaragua",value:5869859,color:"#A389D4"}],l=1/0,o=-1/0,i=0;i<a.length;i++){(n=a[i].value)<l&&(l=n),n>o&&(o=n)}var t=9800*Math.PI,r=18*Math.PI,u=[];for(i=0;i<a.length;i++){var n,d=a[i],v=((n=d.value)-l)/(o-l)*(t-r)+r;v<r&&(v=r);var s=Math.sqrt(v/(8*Math.PI)),c=d.code;u.push({type:"circle",theme:"light",width:s,height:s,color:d.color,longitude:e[c].longitude,latitude:e[c].latitude,title:d.name+"</br> [ "+n+" ]",value:n})}AmCharts.makeChart("world-low",{type:"map",projection:"eckert6",dataProvider:{map:"worldLow",images:u},export:{enabled:!0}}),AmCharts.makeChart("line-area2",{type:"serial",theme:"light",marginTop:10,marginRight:0,dataProvider:[{year:"Jan",value:5,value2:80},{year:"Feb",value:30,value2:95},{year:"Mar",value:25,value2:87},{year:"Apr",value:55,value2:155},{year:"May",value:45,value2:140},{year:"Jun",value:65,value2:147},{year:"Jul",value:60,value2:130},{year:"Aug",value:105,value2:180},{year:"Sep",value:80,value2:160},{year:"Oct",value:110,value2:175},{year:"Nov",value:120,value2:165},{year:"Dec",value:150,value2:200}],valueAxes:[{axisAlpha:0,position:"left"}],graphs:[{id:"g1",balloonText:"[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",bullet:"round",lineColor:"#2466fd",lineThickness:3,negativeLineColor:"#2466fd",valueField:"value"},{id:"g2",balloonText:"[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",bullet:"round",lineColor:"#10adf5",lineThickness:3,negativeLineColor:"#10adf5",valueField:"value2"}],chartCursor:{cursorAlpha:0,valueLineEnabled:!0,valueLineBalloonEnabled:!0,valueLineAlpha:.3,fullWidth:!0},categoryField:"year",categoryAxis:{minorGridAlpha:0,minorGridEnabled:!0,gridAlpha:0,axisAlpha:0,lineAlpha:0},legend:{useGraphSettings:!0,position:"top"}});var h=[{year:"2010",value:30},{year:"2011",value:55},{year:"2012",value:80},{year:"2013",value:60},{year:"2014",value:70},{year:"2015",value:70},{year:"2016",value:110},{year:"2017",value:90},{year:"2018",value:130}],f=AmCharts.makeChart("Earnings-chart",{type:"serial",addClassNames:!0,defs:{filter:[{x:"-50%",y:"-50%",width:"200%",height:"200%",id:"blur",feGaussianBlur:{in:"SourceGraphic",stdDeviation:"30"}},{id:"shadow",x:"-10%",y:"-10%",width:"120%",height:"120%",feOffset:{result:"offOut",in:"SourceAlpha",dx:"0",dy:"20"},feGaussianBlur:{result:"blurOut",in:"offOut",stdDeviation:"10"},feColorMatrix:{result:"blurOut",type:"matrix",values:"0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 .2 0"},feBlend:{in:"SourceGraphic",in2:"blurOut",mode:"normal"}}]},fontSize:15,dataProvider:h,dataDateFormat:"YYYY",autoMarginOffset:0,marginRight:-1,marginBottom:-2,categoryField:"year",categoryAxis:{color:"#fff",gridAlpha:0,axisAlpha:0,lineAlpha:0,offset:-20,inside:!0,parseDates:!0,minPeriod:"YYYY"},chartCursor:{valueLineEnabled:!1,valueLineBalloonEnabled:!1,cursorAlpha:0,zoomable:!1,cursorColor:"#fff",categoryBalloonColor:"#88dcef",valueZoomable:!1,valueLineAlpha:0},valueAxes:[{fontSize:0,inside:!0,gridAlpha:0,axisAlpha:0,lineAlpha:0}],graphs:[{id:"g1",type:"line",valueField:"value",fillColors:["#1dc4e9","#A389D4"],lineColor:"#1dc4e9",balloon:{drop:!0,adjustBorderColor:!1,color:"#ffffff",type:"smoothedLine"},lineAlpha:1,lineThickness:5,fillAlphas:.9,showBalloon:!0}]});setTimeout(function(){f.zoomToIndexes(1,h.length-2)},400)});