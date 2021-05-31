!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):window.jQuery&&!window.jQuery.fn.colorpicker&&t(window.jQuery)}(function(t){"use strict";var o={horizontal:!1,inline:!1,color:!1,format:!1,input:"input",container:!1,component:".add-on, .input-group-addon",sliders:{saturation:{maxLeft:100,maxTop:100,callLeft:"setSaturation",callTop:"setBrightness"},hue:{maxLeft:0,maxTop:100,callLeft:!1,callTop:"setHue"},alpha:{maxLeft:0,maxTop:100,callLeft:!1,callTop:"setAlpha"}},slidersHorz:{saturation:{maxLeft:100,maxTop:100,callLeft:"setSaturation",callTop:"setBrightness"},hue:{maxLeft:100,maxTop:0,callLeft:"setHue",callTop:!1},alpha:{maxLeft:100,maxTop:0,callLeft:"setAlpha",callTop:!1}},template:'<div class="colorpicker dropdown-menu"><div class="colorpicker-saturation"><i><b></b></i></div><div class="colorpicker-hue"><i></i></div><div class="colorpicker-alpha"><i></i></div><div class="colorpicker-color"><div /></div></div>'},i=function(i,e){this.element=t(i).addClass("colorpicker-element"),this.options=t.extend({},o,this.element.data(),e),this.component=this.options.component,this.component=!1!==this.component&&this.element.find(this.component),this.component&&0===this.component.length&&(this.component=!1),this.container=!0===this.options.container?this.element:this.options.container,this.container=!1!==this.container&&t(this.container),this.input=this.element.is("input")?this.element:!!this.options.input&&this.element.find(this.options.input),this.input&&0===this.input.length&&(this.input=!1),this.color=new Color(!1!==this.options.color?this.options.color:this.getValue()),this.format=!1!==this.options.format?this.options.format:this.color.origFormat,this.picker=t(this.options.template),this.options.inline?this.picker.addClass("colorpicker-inline colorpicker-visible"):this.picker.addClass("colorpicker-hidden"),this.options.horizontal&&this.picker.addClass("colorpicker-horizontal"),"rgba"!==this.format&&"hsla"!==this.format||this.picker.addClass("colorpicker-with-alpha"),"right"===this.options.align&&this.picker.addClass("colorpicker-right"),this.picker.on("mousedown.colorpicker touchstart.colorpicker",t.proxy(this.mousedown,this)),this.picker.appendTo(this.container?this.container:t("body")),!1!==this.input&&(this.input.on({"keyup.colorpicker":t.proxy(this.keyup,this)}),!1===this.component&&this.element.on({"focus.colorpicker":t.proxy(this.show,this)}),!1===this.options.inline&&this.element.on({"focusout.colorpicker":t.proxy(this.hide,this)})),!1!==this.component&&this.component.on({"click.colorpicker":t.proxy(this.show,this)}),!1===this.input&&!1===this.component&&this.element.on({"click.colorpicker":t.proxy(this.show,this)}),!1!==this.input&&!1!==this.component&&"color"===this.input.attr("type")&&this.input.on({"click.colorpicker":t.proxy(this.show,this),"focus.colorpicker":t.proxy(this.show,this)}),this.update(),t(t.proxy(function(){this.element.trigger("create")},this))};i.Color=Color,i.prototype={constructor:i,destroy:function(){this.picker.remove(),this.element.removeData("colorpicker").off(".colorpicker"),!1!==this.input&&this.input.off(".colorpicker"),!1!==this.component&&this.component.off(".colorpicker"),this.element.removeClass("colorpicker-element"),this.element.trigger({type:"destroy"})},reposition:function(){if(!1!==this.options.inline||this.options.container)return!1;var t=this.container&&this.container[0]!==document.body?"position":"offset",o=this.component||this.element,i=o[t]();"right"===this.options.align&&(i.left-=this.picker.outerWidth()-o.outerWidth()),this.picker.css({top:i.top+o.outerHeight(),left:i.left})},show:function(o){if(this.isDisabled())return!1;this.picker.addClass("colorpicker-visible").removeClass("colorpicker-hidden"),this.reposition(),t(window).on("resize.colorpicker",t.proxy(this.reposition,this)),!o||this.hasInput()&&"color"!==this.input.attr("type")||o.stopPropagation&&o.preventDefault&&(o.stopPropagation(),o.preventDefault()),!1===this.options.inline&&t(window.document).on({"mousedown.colorpicker":t.proxy(this.hide,this)}),this.element.trigger({type:"showPicker",color:this.color})},hide:function(){this.picker.addClass("colorpicker-hidden").removeClass("colorpicker-visible"),t(window).off("resize.colorpicker",this.reposition),t(document).off({"mousedown.colorpicker":this.hide}),this.update(),this.element.trigger({type:"hidePicker",color:this.color})},updateData:function(t){return t=t||this.color.toString(this.format),this.element.data("color",t),t},updateInput:function(t){return t=t||this.color.toString(this.format),!1!==this.input&&this.input.prop("value",t),t},updatePicker:function(t){void 0!==t&&(this.color=new Color(t));var o=!1===this.options.horizontal?this.options.sliders:this.options.slidersHorz,i=this.picker.find("i");if(0!==i.length)return!1===this.options.horizontal?(o=this.options.sliders,i.eq(1).css("top",o.hue.maxTop*(1-this.color.value.h)).end().eq(2).css("top",o.alpha.maxTop*(1-this.color.value.a))):(o=this.options.slidersHorz,i.eq(1).css("left",o.hue.maxLeft*(1-this.color.value.h)).end().eq(2).css("left",o.alpha.maxLeft*(1-this.color.value.a))),i.eq(0).css({top:o.saturation.maxTop-this.color.value.b*o.saturation.maxTop,left:this.color.value.s*o.saturation.maxLeft}),this.picker.find(".colorpicker-saturation").css("backgroundColor",this.color.toHex(this.color.value.h,1,1,1)),this.picker.find(".colorpicker-alpha").css("backgroundColor",this.color.toHex()),this.picker.find(".colorpicker-color, .colorpicker-color div").css("backgroundColor",this.color.toString(this.format)),t},updateComponent:function(t){if(t=t||this.color.toString(this.format),!1!==this.component){var o=this.component.find("i").eq(0);o.length>0?o.css({backgroundColor:t}):this.component.css({backgroundColor:t})}return t},update:function(t){var o;return!1===this.getValue(!1)&&!0!==t||(o=this.updateComponent(),this.updateInput(o),this.updateData(o),this.updatePicker()),o},setValue:function(t){this.color=new Color(t),this.update(),this.element.trigger({type:"changeColor",color:this.color,value:t})},getValue:function(t){var o;return t=void 0===t?"#000000":t,void 0!==(o=this.hasInput()?this.input.val():this.element.data("color"))&&""!==o&&null!==o||(o=t),o},hasInput:function(){return!1!==this.input},isDisabled:function(){return!!this.hasInput()&&!0===this.input.prop("disabled")},disable:function(){return!!this.hasInput()&&(this.input.prop("disabled",!0),this.element.trigger({type:"disable",color:this.color,value:this.getValue()}),!0)},enable:function(){return!!this.hasInput()&&(this.input.prop("disabled",!1),this.element.trigger({type:"enable",color:this.color,value:this.getValue()}),!0)},currentSlider:null,mousePointer:{left:0,top:0},mousedown:function(o){o.pageX||o.pageY||!o.originalEvent||(o.pageX=o.originalEvent.touches[0].pageX,o.pageY=o.originalEvent.touches[0].pageY),o.stopPropagation(),o.preventDefault();var i=t(o.target).closest("div"),e=this.options.horizontal?this.options.slidersHorz:this.options.sliders;if(!i.is(".colorpicker")){if(i.is(".colorpicker-saturation"))this.currentSlider=t.extend({},e.saturation);else if(i.is(".colorpicker-hue"))this.currentSlider=t.extend({},e.hue);else{if(!i.is(".colorpicker-alpha"))return!1;this.currentSlider=t.extend({},e.alpha)}var r=i.offset();this.currentSlider.guide=i.find("i")[0].style,this.currentSlider.left=o.pageX-r.left,this.currentSlider.top=o.pageY-r.top,this.mousePointer={left:o.pageX,top:o.pageY},t(document).on({"mousemove.colorpicker":t.proxy(this.mousemove,this),"touchmove.colorpicker":t.proxy(this.mousemove,this),"mouseup.colorpicker":t.proxy(this.mouseup,this),"touchend.colorpicker":t.proxy(this.mouseup,this)}).trigger("mousemove")}return!1},mousemove:function(t){t.pageX||t.pageY||!t.originalEvent||(t.pageX=t.originalEvent.touches[0].pageX,t.pageY=t.originalEvent.touches[0].pageY),t.stopPropagation(),t.preventDefault();var o=Math.max(0,Math.min(this.currentSlider.maxLeft,this.currentSlider.left+((t.pageX||this.mousePointer.left)-this.mousePointer.left))),i=Math.max(0,Math.min(this.currentSlider.maxTop,this.currentSlider.top+((t.pageY||this.mousePointer.top)-this.mousePointer.top)));return this.currentSlider.guide.left=o+"px",this.currentSlider.guide.top=i+"px",this.currentSlider.callLeft&&this.color[this.currentSlider.callLeft].call(this.color,o/this.currentSlider.maxLeft),this.currentSlider.callTop&&this.color[this.currentSlider.callTop].call(this.color,i/this.currentSlider.maxTop),this.update(!0),this.element.trigger({type:"changeColor",color:this.color}),!1},mouseup:function(o){return o.stopPropagation(),o.preventDefault(),t(document).off({"mousemove.colorpicker":this.mousemove,"touchmove.colorpicker":this.mousemove,"mouseup.colorpicker":this.mouseup,"touchend.colorpicker":this.mouseup}),!1},keyup:function(t){if(38===t.keyCode)this.color.value.a<1&&(this.color.value.a=Math.round(100*(this.color.value.a+.01))/100),this.update(!0);else if(40===t.keyCode)this.color.value.a>0&&(this.color.value.a=Math.round(100*(this.color.value.a-.01))/100),this.update(!0);else{var o=this.input.val();this.color=new Color(o),!1!==this.getValue(!1)&&(this.updateData(),this.updateComponent(),this.updatePicker())}this.element.trigger({type:"changeColor",color:this.color,value:o})}},t.colorpicker=i,t.fn.colorpicker=function(o){var e,r=arguments,s=this.each(function(){var s=t(this),n=s.data("colorpicker"),l="object"==typeof o?o:{};n||"string"==typeof o?"string"==typeof o&&(e=n[o].apply(n,Array.prototype.slice.call(r,1))):s.data("colorpicker",new i(this,l))});return"getValue"===o?e:s},t.fn.colorpicker.constructor=i});