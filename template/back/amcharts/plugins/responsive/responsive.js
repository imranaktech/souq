AmCharts.addInitHandler(function(e){if(void 0!==e.responsive&&!e.responsive.ready){var i=e.responsive;if(i.ready=!0,i.currentRules={},i.overridden=[],i.original={},!0===i.enabled){var a=e.version.split(".");if(!(Number(a[0])<3||3==Number(a[0])&&Number(a[1])<13)){var d={pie:[{maxWidth:550,legendPosition:"left",overrides:{legend:{enabled:!1}}},{maxWidth:550,legendPosition:"right",overrides:{legend:{enabled:!1}}},{maxWidth:150,overrides:{legend:{enabled:!1}}},{maxHeight:350,legendPosition:"top",overrides:{legend:{enabled:!1}}},{maxHeight:350,legendPosition:"bottom",overrides:{legend:{enabled:!1}}},{maxHeight:150,overrides:{legend:{enabled:!1}}},{maxWidth:400,overrides:{labelsEnabled:!1}},{maxWidth:100,overrides:{legend:{enabled:!1}}},{maxHeight:350,overrides:{pullOutRadius:0}},{maxHeight:200,overrides:{titles:{enabled:!1},labelsEnabled:!1}},{maxWidth:60,overrides:{autoMargins:!1,marginTop:0,marginBottom:0,marginLeft:0,marginRight:0,radius:"50%",innerRadius:0,balloon:{enabled:!1},legend:{enabled:!1}}},{maxHeight:60,overrides:{marginTop:0,marginBottom:0,marginLeft:0,marginRight:0,radius:"50%",innerRadius:0,balloon:{enabled:!1},legend:{enabled:!1}}}],funnel:[{maxWidth:550,legendPosition:"left",overrides:{legend:{enabled:!1}}},{maxWidth:550,legendPosition:"right",overrides:{legend:{enabled:!1}}},{maxWidth:150,overrides:{legend:{enabled:!1}}},{maxHeight:500,legendPosition:"top",overrides:{legend:{enabled:!1}}},{maxHeight:500,legendPosition:"bottom",overrides:{legend:{enabled:!1}}},{maxHeight:150,overrides:{legend:{enabled:!1}}},{maxWidth:400,overrides:{labelsEnabled:!1,marginLeft:10,marginRight:10,legend:{enabled:!1}}},{maxHeight:350,overrides:{pullOutRadius:0,legend:{enabled:!1}}},{maxHeight:300,overrides:{titles:{enabled:!1}}}],radar:[{maxWidth:550,legendPosition:"left",overrides:{legend:{enabled:!1}}},{maxWidth:550,legendPosition:"right",overrides:{legend:{enabled:!1}}},{maxWidth:150,overrides:{legend:{enabled:!1}}},{maxHeight:350,legendPosition:"top",overrides:{legend:{enabled:!1}}},{maxHeight:350,legendPosition:"bottom",overrides:{legend:{enabled:!1}}},{maxHeight:150,overrides:{legend:{enabled:!1}}},{maxWidth:300,overrides:{labelsEnabled:!1}},{maxWidth:200,overrides:{autoMargins:!1,marginTop:0,marginBottom:0,marginLeft:0,marginRight:0,radius:"50%",titles:{enabled:!1},valueAxes:{labelsEnabled:!1,radarCategoriesEnabled:!1}}},{maxHeight:300,overrides:{labelsEnabled:!1}},{maxHeight:200,overrides:{autoMargins:!1,marginTop:0,marginBottom:0,marginLeft:0,marginRight:0,radius:"50%",titles:{enabled:!1},valueAxes:{radarCategoriesEnabled:!1}}},{maxHeight:100,overrides:{valueAxes:{labelsEnabled:!1}}}],gauge:[{maxWidth:550,legendPosition:"left",overrides:{legend:{enabled:!1}}},{maxWidth:550,legendPosition:"right",overrides:{legend:{enabled:!1}}},{maxWidth:150,overrides:{legend:{enabled:!1}}},{maxHeight:500,legendPosition:"top",overrides:{legend:{enabled:!1}}},{maxHeight:500,legendPosition:"bottom",overrides:{legend:{enabled:!1}}},{maxHeight:150,overrides:{legend:{enabled:!1}}},{maxWidth:200,overrides:{titles:{enabled:!1},allLabels:{enabled:!1},axes:{labelsEnabled:!1}}},{maxHeight:200,overrides:{titles:{enabled:!1},allLabels:{enabled:!1},axes:{labelsEnabled:!1}}}],serial:[{maxWidth:550,legendPosition:"left",overrides:{legend:{enabled:!1}}},{maxWidth:550,legendPosition:"right",overrides:{legend:{enabled:!1}}},{maxWidth:100,overrides:{legend:{enabled:!1}}},{maxHeight:350,legendPosition:"top",overrides:{legend:{enabled:!1}}},{maxHeight:350,legendPosition:"bottom",overrides:{legend:{enabled:!1}}},{maxHeight:100,overrides:{legend:{enabled:!1}}},{maxWidth:350,overrides:{autoMarginOffset:0,graphs:{hideBulletsCount:10}}},{maxWidth:350,rotate:!1,overrides:{marginLeft:10,marginRight:10,valueAxes:{ignoreAxisWidth:!0,inside:!0,title:"",showFirstLabel:!1,showLastLabel:!1},graphs:{bullet:"none"}}},{maxWidth:350,rotate:!0,overrides:{marginLeft:10,marginRight:10,categoryAxis:{ignoreAxisWidth:!0,inside:!0,title:""}}},{maxWidth:200,rotate:!1,overrides:{marginLeft:10,marginRight:10,marginTop:10,marginBottom:10,categoryAxis:{ignoreAxisWidth:!0,labelsEnabled:!1,inside:!0,title:"",guides:{inside:!0}},valueAxes:{ignoreAxisWidth:!0,labelsEnabled:!1,axisAlpha:0,guides:{label:""}},legend:{enabled:!1}}},{maxWidth:200,rotate:!0,overrides:{chartScrollbar:{scrollbarHeight:4,graph:"",resizeEnabled:!1},categoryAxis:{labelsEnabled:!1,axisAlpha:0,guides:{label:""}},legend:{enabled:!1}}},{maxWidth:100,rotate:!1,overrides:{valueAxes:{gridAlpha:0}}},{maxWidth:100,rotate:!0,overrides:{categoryAxis:{gridAlpha:0}}},{maxHeight:300,overrides:{autoMarginOffset:0,graphs:{hideBulletsCount:10}}},{maxHeight:200,rotate:!1,overrides:{marginTop:10,marginBottom:10,categoryAxis:{ignoreAxisWidth:!0,inside:!0,title:"",showFirstLabel:!1,showLastLabel:!1}}},{maxHeight:200,rotate:!0,overrides:{marginTop:10,marginBottom:10,valueAxes:{ignoreAxisWidth:!0,inside:!0,title:"",showFirstLabel:!1,showLastLabel:!1},graphs:{bullet:"none"}}},{maxHeight:150,rotate:!1,overrides:{titles:{enabled:!1},chartScrollbar:{scrollbarHeight:4,graph:"",resizeEnabled:!1},categoryAxis:{labelsEnabled:!1,ignoreAxisWidth:!0,axisAlpha:0,guides:{label:""}}}},{maxHeight:150,rotate:!0,overrides:{titles:{enabled:!1},valueAxes:{labelsEnabled:!1,ignoreAxisWidth:!0,axisAlpha:0,guides:{label:""}}}},{maxHeight:100,rotate:!1,overrides:{valueAxes:{labelsEnabled:!1,ignoreAxisWidth:!0,axisAlpha:0,gridAlpha:0,guides:{label:""}}}},{maxHeight:100,rotate:!0,overrides:{categoryAxis:{labelsEnabled:!1,ignoreAxisWidth:!0,axisAlpha:0,gridAlpha:0,guides:{label:""}}}},{maxWidth:100,overrides:{autoMargins:!1,marginTop:0,marginBottom:0,marginLeft:0,marginRight:0,categoryAxis:{labelsEnabled:!1},valueAxes:{labelsEnabled:!1}}},{maxHeight:100,overrides:{autoMargins:!1,marginTop:0,marginBottom:0,marginLeft:0,marginRight:0,categoryAxis:{labelsEnabled:!1},valueAxes:{labelsEnabled:!1}}}],xy:[{maxWidth:550,legendPosition:"left",overrides:{legend:{enabled:!1}}},{maxWidth:550,legendPosition:"right",overrides:{legend:{enabled:!1}}},{maxWidth:100,overrides:{legend:{enabled:!1}}},{maxHeight:350,legendPosition:"top",overrides:{legend:{enabled:!1}}},{maxHeight:350,legendPosition:"bottom",overrides:{legend:{enabled:!1}}},{maxHeight:100,overrides:{legend:{enabled:!1}}},{maxWidth:250,overrides:{autoMarginOffset:0,autoMargins:!1,marginTop:0,marginBottom:0,marginLeft:0,marginRight:0,valueAxes:{inside:!0,title:"",showFirstLabel:!1,showLastLabel:!1},legend:{enabled:!1}}},{maxWidth:150,overrides:{valueyAxes:{labelsEnabled:!1,axisAlpha:0,gridAlpha:0,guides:{label:""}}}},{maxHeight:250,overrides:{autoMarginOffset:0,autoMargins:!1,marginTop:0,marginBottom:0,marginLeft:0,marginRight:0,valueAxes:{inside:!0,title:"",showFirstLabel:!1,showLastLabel:!1},legend:{enabled:!1}}},{maxWidth:150,overrides:{valueyAxes:{labelsEnabled:!1,axisAlpha:0,gridAlpha:0,guides:{label:""}}}}],stock:[{maxWidth:500,overrides:{dataSetSelector:{position:"top"},periodSelector:{position:"bottom"}}},{maxWidth:400,overrides:{dataSetSelector:{selectText:"",compareText:""},periodSelector:{periodsText:"",inputFieldsEnabled:!1}}}],map:[{maxWidth:200,overrides:{zoomControl:{zoomControlEnabled:!1},smallMap:{enabled:!1},valueLegend:{enabled:!1},dataProvider:{areas:{descriptionWindowWidth:160,descriptionWindowRight:10,descriptionWindowTop:10},images:{descriptionWindowWidth:160,descriptionWindowRight:10,descriptionWindowTop:10},lines:{descriptionWindowWidth:160,descriptionWindowRight:10,descriptionWindowTop:10}}}},{maxWidth:150,overrides:{dataProvider:{areas:{descriptionWindowWidth:110,descriptionWindowRight:10,descriptionWindowTop:10},images:{descriptionWindowWidth:110,descriptionWindowRight:10,descriptionWindowTop:10},lines:{descriptionWindowWidth:110,descriptionWindowLeft:10,descriptionWindowRight:10}}}},{maxHeight:200,overrides:{zoomControl:{zoomControlEnabled:!1},smallMap:{enabled:!1},valueLegend:{enabled:!1},dataProvider:{areas:{descriptionWindowHeight:160,descriptionWindowRight:10,descriptionWindowTop:10},images:{descriptionWindowHeight:160,descriptionWindowRight:10,descriptionWindowTop:10},lines:{descriptionWindowHeight:160,descriptionWindowRight:10,descriptionWindowTop:10}}}},{maxHeight:150,overrides:{dataProvider:{areas:{descriptionWindowHeight:110,descriptionWindowRight:10,descriptionWindowTop:10},images:{descriptionWindowHeight:110,descriptionWindowRight:10,descriptionWindowTop:10},lines:{descriptionWindowHeight:110,descriptionWindowLeft:10,descriptionWindowRight:10}}}}]};null!=i.rules&&0!=i.rules.length&&n(i.rules)?!1!==i.addDefaultRules&&(i.rules=i.rules.concat(d[e.type])):i.rules=d[e.type],s(e,"zoomOutOnDataUpdate",e.zoomOutOnDataUpdate),e.addListener("resized",t),e.addListener("init",t)}}}function t(){var a=e.divRealWidth,d=e.divRealHeight,t=!1;for(var r in i.rules){var n=i.rules[r];(null==n.minWidth||n.minWidth<=a)&&(null==n.maxWidth||n.maxWidth>=a)&&(null==n.minHeight||n.minHeight<=d)&&(null==n.maxHeight||n.maxHeight>=d)&&(null==n.rotate||!0===n.rotate&&!0===e.rotate||!1===n.rotate&&(void 0===e.rotate||!1===e.rotate))&&(null==n.legendPosition||void 0!==e.legend&&void 0!==e.legend.position&&e.legend.position===n.legendPosition)?null==i.currentRules[r]&&(i.currentRules[r]=!0,t=!0):null!=i.currentRules[r]&&(i.currentRules[r]=void 0,t=!0)}if(t){for(var r in function(){var e;for(;e=i.overridden.pop();)"_r_none"===e.o["_r_"+e.p]?delete e.o[e.p]:e.o[e.p]=e.o["_r_"+e.p]}(),i.currentRules)null!=i.currentRules[r]&&l(e,i.rules[r].overrides);!function(){e.dataChanged=!0,"xy"!==e.type&&(e.marginsUpdated=!1);e.zoomOutOnDataUpdate=!1,e.validateNow(!0),i=e,a="zoomOutOnDataUpdate",i[a]=i["_r_"+a];var i,a}()}}function r(e,i){if(e instanceof Array)for(var a in e)if("object"==typeof e[a]&&e[a].id==i)return e[a];return!1}function n(e){return e instanceof Array}function o(e){return"object"==typeof e}function l(e,i){for(var a in i)if(void 0===e[a])e[a]=i[a],s(e,a,"_r_none");else if(n(e[a])){if(e[a].length&&!o(e[a][0]))s(e,a,e[a]),e[a]=i[a];else if(n(i[a]))for(var d in i[a]){var t=!1;void 0===i[a][d].id&&null!=e[a][d]?t=e[a][d]:void 0!==i[a][d].id&&(t=r(e[a],i[a][d].id)),t&&l(t,i[a][d])}else if(o(i[a]))for(var d in e[a])l(e[a][d],i[a])}else o(e[a])?l(e[a],i[a]):(s(e,a,e[a]),e[a]=i[a])}function s(e,a,d){void 0===e["_r_"+a]&&(e["_r_"+a]=d),i.overridden.push({o:e,p:a})}},["pie","serial","xy","funnel","radar","gauge","stock","map"]);