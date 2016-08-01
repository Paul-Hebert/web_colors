$(function() {
	initializeMobileMenu();

    bodyId = $('body').attr('id');

    if( bodyId === 'contact' ){ 
        initializeContactForm();
    }	

    if( bodyId === 'home' ){ 
        convertColors();

        printColorFormats();

        printColorShades();

        $('.backgroundChanger').on("input change", function(){
            $( $(this).attr('data-target') ).css({
                fill: 'rgb(' + $(this).val() + ',' + $(this).val() + ',' + $(this).val() + ')'
            });
        });

        $('.color.listing').each(function(){
            $(this).css( 'background', $(this).find('span').text() );
        });

        printChart('rectangle','hue');
        printChart('fan','hue');
    }

    if (bodyId === 'home' || bodyId === 'converter'){
        initializeColorPickers();
    }

    if( bodyId === 'home' || bodyId === 'scraper'){ 
        busy = false;

        $('#scraper').submit(function(e){
            e.preventDefault();
            ajaxScrape();
        });  

        $('#scraperButton').click(function(){
            ajaxScrape();
        });
    }

    if( bodyId === 'data'){
        $('#downloads').submit(function(e){
            e.preventDefault();
            
            if( $('#date').val() != 'All'){
                window.location.href = 'assets/data/' + $('#date').val();
            }
        });
    }
});

function ajaxScrape(){
    if ( busy !== true ){
        if( validate( $('#scraper') ) ){
            var scraperUrl = $('#scraperUrl').val();

            if ( scraperUrl.indexOf('http') === -1 ){
                scraperUrl = 'http://' + scraperUrl;
            }

            busy = true;

            $('#scraperButton').html('<div class="loading"></div>');

            $.ajax({
                type: "POST",
                url: 'assets/php/utilities/scrape/index.php?url=' + scraperUrl,
                success: function(data){
                    $('#scraperResults').append(data);
                    
                    busy = false;

                    $('#scraperButton').html('Scrape');
                }
            });
        } else{
            $('#scraperUrl').val();
        }
    }
}

function initializeColorPickers(){
    $('.colorPicker input, .colorPicker select').on("input change", function(){
        var colorPicker = $(this).parents('.colorPicker');

        var colorFormat = colorPicker.attr('data-format');
        colorFormat = colorFormat.split(',');

        var colorDelimiter = colorPicker.attr('data-delimiter');

        var color = colorFormat[0];

        colorPicker.find('input, select').each(function(){
            if ($(this).attr('data-scale') != ''){
                color += $(this).val() / $(this).attr('data-scale') ;
            } else{
                color += $(this).val();                
            }

            color += $(this).attr('data-unit');

            if( ! $(this).is(':last-of-type') ){
                color += colorDelimiter;
            }
        });

        color += colorFormat[1];

        colorPicker.find('.colorBlock').text(color).css('border-color',color);
    }).change();
}

function convertColors(){
    colors = [];

    $('#aggregate .color.listing').each(function(){
        // Get original text
        var color = {original: $(this).text()};

        // Determine original color format and convert to hexadecimal        
        if ( /#(?:[0-9a-fA-F]{6})/.test(color.original) ){
            color.originalFormat = 'hexadecimal';

            color.hex = color.original.toUpperCase();            

            color.rgb = hexToRgb(color.original);       

        } else if ( /#(?:[0-9a-fA-F]{3})/.test(color.original) ){
            color.originalFormat = 'threeDigitHexadecimal';

            color.hex = threeDigitsToSix(color.original).toUpperCase();

            color.rgb = hexToRgb(color.hex);             

        } else if ( /(rgba)\(\d{1,3}%?(,\s?\d{1,3}%?){2},\s?(1|0|0?\.\d+)\)/.test(color.original) ){
            color.originalFormat = 'rgba';

            color.rgb = rgbaToRgb(color.original);

            color.hex = rgbToHex(color.rgb).toUpperCase();

            if ( /#(?:[0-9a-fA-F]{3})/.test(color.hex) ){
                color.hex = threeDigitsToSix(color.hex);
            }            

        } else if ( /(rgb)\(\d{1,3}%?(,\s?\d{1,3}%?){2}\)/.test(color.original) ){
            color.originalFormat = 'rgb';

            color.rgb = color.original;            

            color.hex = rgbToHex(color.original).toUpperCase();

            colors.hsv = rgbToHsv(color.rgb);
            if ( /#(?:[0-9a-fA-F]{3})/.test(color.hex) ){
                color.hex = threeDigitsToSix(color.hex).toUpperCase();
            }            
        } else if ( /(hsla)\(\d{1,3}%?(,\s?\d{1,3}%?){2},\s?(1|0|0?\.\d+)\)/.test(color.original) ){
            color.originalFormat = 'hsla';
        } else if ( /(hsl)\(\d{1,3}%?(,\s?\d{1,3}%?){2}\)/.test(color.original) ){
            color.originalFormat = 'hsl';
        } else{
            color.originalFormat = 'named';
            color.hex = namedToHex(color.original).toUpperCase();
            color.rgb = hexToRgb(color.hex);
        }

        separateRgbValues(color);

        rgbToHsl(color);
        
        colors.push( color );
    });
}

function printColorFormats(){
    for(i = 0; i < colors.length; i++){
        $( '#' + colors[i].originalFormat + 'Colors').append('<div class="color" style="background:' + colors[i].original + ';"><span>' + colors[i].original + '</span></div>');
    }

    colorFormatsUsed = 0;

    $('.format.bar.chart .barColumn').each(function(){
        if ( $(this).html() !== '' ){
            colorFormatsUsed ++;
        }
    });

    if (colorFormatsUsed < 6){
        $('#colorFormatParagraph').append('Only ' + colorFormatsUsed + ' of the six color formats were used by these sites.')
    }
}

function printColorShades(){
    for(i = 0; i < colors.length; i++){
        if (colors[i].sat < 0.1 && colors[i].light < 0.05){
            shade = 'black';
        } else if(colors[i].sat < 0.1 && colors[i].light > 0.9){
            shade = 'white';
        } else if(colors[i].sat < 0.1 ){
            shade = 'grey';
        } else if( colors[i].hue > 233.75 || colors[i].hue <= 21.25 ){
            shade = 'red';
        } else if( colors[i].hue > 21.25 && colors[i].hue <= 63.75 ){
            shade = 'yellow';
        } else if( colors[i].hue > 63.75 && colors[i].hue <= 127.5 ){
            shade = 'green';
        } else if( colors[i].hue > 127.5 && colors[i].hue <= 148.75 ){
            shade = 'turquoise';
        } else if( colors[i].hue > 148.75 && colors[i].hue <= 191.25 ){
            shade = 'blue';
        } else if( colors[i].hue > 191.25 && colors[i].hue <= 233.75 ){
            shade = 'purple';
        }
        
        $('#' + shade + 'Colors').append('<div class="color" style="background:' + colors[i].rgb + ';"><span>' + colors[i].original + '</span></div>');
    }
}

function sortColors(sortCriteria) {
    if (sortCriteria == 'hue'){
        return colors.sort(
            firstBy(function (v1, v2) { return v1.hue - v2.hue; })
            .thenBy(function (v1, v2) { return v1.sat - v2.sat; })
            .thenBy(function (v1, v2) { return v2.val - v1.val; })
        );
    }
    if (sortCriteria == 'sat'){
        return colors.sort(
            firstBy(function (v1, v2) { return v1.sat - v2.sat; })
            .thenBy(function (v1, v2) { return v1.hue - v2.hue; })
            .thenBy(function (v1, v2) { return v1.val - v2.val; })

        );
    }
    if (sortCriteria == 'val'){
        return colors.sort(
            firstBy(function (v1, v2) { return v1.val - v2.val; })
            .thenBy(function (v1, v2) { return v2.sat - v1.sat; })
            .thenBy(function (v1, v2) { return v1.hue - v2.hue; })
        );
    }
}

function printChart(type,sortCriteria){
    sortedColors = sortColors(sortCriteria);

    usedColors = [];

    if (type === 'fan'){
        fan = Snap('.chart.' + type + '.' + sortCriteria);
        center = $('.chart.' + type + '.' + sortCriteria).width()/2;

        $('.chart.' + type + '.' + sortCriteria).height( center * 2 );

        var circle = fan.circle(center, center, 0);

        circle.attr({
            fill: '#fff',
            class: 'background',
            r: center
        });
    }

    for(i = 0; i < sortedColors.length; i++){         
        var used = 1;


        for(z = 0; z < usedColors.length; z++){
            if (sortedColors[i].hex === usedColors[z]){
                used ++;
            }
        }

        if (used != 1){
            $( '.chart.' + type + ' #' + sortedColors[i].hex.replace('#','c_') ).remove();
        }   

        usedColors.push(sortedColors[i].hex);

        if (type === 'fan'){
            // Calculate rotation of hue.
            var rot = sortedColors[i].hue * 360/255;
            // Convert from degrees to radians.
            rot *= 3.141592653589793 / 180;

            // Use simple trig to plot colors.
            x = center + Math.sin(rot) * sortedColors[i].sat * center * 9/10;
            y = center + Math.cos(rot) * sortedColors[i].sat * center * 9/10;

            var circle = fan.circle(x, y, center/100 * Math.sqrt(used));

            circle.attr({
                fill: sortedColors[i].hex, //'hsl(' + colors[i].hue + ',' + colors[i].sat + '%,' + colors[i].val + '%)'
                id: sortedColors[i].hex.replace('#','c_')
            });

        } else if(type === 'histogram'){
            var height = 4;

            dataPoint = '<div class="color" style="';
            dataPoint += 'background:' + sortedColors[i].hex + ';';
            dataPoint += 'height:' + (height * used) + 'px;"';
            dataPoint += ' id="c_' + sortedColors[i].hex.replace('#','') + '">';
            dataPoint += '<span>' + sortedColors[i].hex + '</span></div>';

            $('.chart.' + type + '.' + sortCriteria).append(dataPoint);   
        }
    }
}

function threeDigitsToSix(color){ 
   return '#' + color[1] + color[1] + color[2] + color[2] + color[3] + color[3];
}

function hexToRgb(color){
    var red   = base16ToBase10( color.substring( 1, 3 ) );
    var green = base16ToBase10( color.substring( 3, 5 ) );
    var blue  = base16ToBase10( color.substring( 5, 7 ) );
 
    return 'rgb(' + red + ',' + green + ',' + blue + ')';
}

function rgbToHex(color){
    var temp_color = color.replace("rgb(", "");
    temp_color = temp_color.replace(")", "");
    temp_color = temp_color.split(',');

    var red = base10ToBase16(temp_color[0]);
    var green = base10ToBase16(temp_color[1]);
    var blue = base10ToBase16(temp_color[2]);

    return '#' + red + green + blue;
}

function rgbaToRgb(color){
    var temp_color = color.replace("rgba(", "");
    temp_color = temp_color.replace(")", "");        
    temp_color = temp_color.split(',');

    return 'rgb(' + temp_color[0] + ',' + temp_color[1] + ',' + temp_color[2] + ')';
}

function base16ToBase10(base16){
    return parseInt(base16,16);
}

function base10ToBase16(base10){
    var base16 = parseFloat(base10).toString(16);

    // If the hexadecimal number is only 1 character long, add 0 to the front.
    if (base16.length == 1){
        base16 = '0' + base16;
    }

    return base16;
}

function namedToHex(named){
    for (x = 0; x < colorNames.length; x++){
        if (named.toLowerCase() === colorNames[x][0].toLowerCase()){
            return colorNames[x][1];
        }
    }
}

function separateRgbValues(color){
    var temp_color = color.rgb.replace("rgb(", "");
    temp_color = temp_color.replace(")", "");
    temp_color = temp_color.split(',');

    color.red = temp_color[0];
    color.green = temp_color[1];
    color.blue = temp_color[2];    
}

function rgbToHsl(color){
    var rgb = color;
    rgb.red /= 255; 
    rgb.green /= 255; 
    rgb.blue /= 255;   

    /* Getting the Max and Min values. */
    var max = Math.max.apply(Math, [rgb.red,rgb.green,rgb.blue]);
    var min = Math.min.apply(Math, [rgb.red,rgb.green,rgb.blue]); 

    var lightness = (min + max)/2;

    if (min === max){
        var saturation = 0;
        var hue = 0;
    } else{
        if( lightness < 0.5){
            var saturation = (max-min)/(max+min);
        } else{
            var saturation = (max-min)/(2-max-min);
        }

        if (rgb.red == max) {
            var temp_hue = (rgb.green-rgb.blue)/(max-min);
        } else if (rgb.green == max) {
            var temp_hue = 2 + (rgb.blue-rgb.red)/(max-min);
        } else if (rgb.blue == max) {
            var temp_hue = 4 + (rgb.red-rgb.green)/(max-min);
        }

        var hue = temp_hue * 42.6;

        if (hue < 0){
            hue += 255;
        }
    }

    rgb.hue = hue;
    rgb.sat = saturation;
    rgb.light = lightness;
}


/*****************************************************************************************************/
// Default template functions
/*****************************************************************************************************/

function initializeMobileMenu(){
	$('#menu-toggle').click(function(){
		if ( $('#menu-toggle svg').attr('class') === 'open' ){
			$('#menu-toggle svg').attr('class','');
			$('#mobile_modal').fadeOut();
		} else{
			$('#menu-toggle svg').attr('class','open');
			$('#mobile_modal').fadeIn();			
		}

		var first_y = $('.first-line').attr('y2');
		var last_y = $('.last-line').attr('y2');

		animate(
	        $('.first-line'), // target jQuery element
	        { y2: last_y}, // target attributes
	        300 // optional duration in ms, defaults to 400
	    );
		animate(
	        $('.last-line'), // target jQuery element
	        { y2: first_y}, // target attributes
	        300 // optional duration in ms, defaults to 400
	    );

		$('header nav').toggleClass('open');
	});
}

function initializeContactForm(){
	$( ".contact_form" ).on( "submit", function( event ) {
	    event.preventDefault();

	    if ( validate( $(this) ) ){
		    var form_data = $('.contact_form').serialize();

		    $.ajax({
			    type : 'POST',
			    url : 'assets/php/utilities/email.php',
			    data : form_data,
			    success: function(data){
			    	$('.contact_form *').animate({'opacity':0},300);
			    	$('.contact_form').append(data);
			    	$('#success').fadeIn(300);
			    }
			});
		}
	});
}

function validate(form){
	form.find('.error').removeClass('error');
	form.find('.error_text').remove();

	form.find('.required').each(function(){
		if ( $(this).val() === '' || $(this).val() === null || $(this).val() === undefined ){
			$(this).addClass('error');
			$(this).change(function(){ $(this).removeClass('error') });
		}
	});

	if ( $('.error').length > 0 ){
        var error_text = $('<div class="error_text">Please fill out all required fields above. Required fields have a red outline.</div>');

        error_text.insertBefore( form.find('input[type=submit], .button') );

		form.find('.error_text').slideDown(350);

		return false;
	} else{
		return true;
	}
}

/*****************************************************************************************************/
// Borrowed functions
/*****************************************************************************************************/

// Function allows you to animate SVG attributes like you would CSS properties. http://stackoverflow.com/a/17361309
function animate($el, attrs, speed) {
    speed = speed || 400;
    var start = {},
        timeout = 20,
        steps = Math.floor(speed/timeout),
        cycles = steps;
    
    $.each(attrs, function(k,v) {
        start[k] = $el.attr(k);
    });
    
    (function loop() {
        $.each(attrs, function(k,v) {
            var pst = (v - start[k])/steps;
            $el.attr(k, function(i, old) {
                return + old + pst;
            });
        });
      if ( --cycles )
          setTimeout(loop, timeout);
      else
          $el.attr(attrs);
    })();
}

/***
   Copyright 2013 Teun Duynstee

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
 */
firstBy = (function() {
    /* mixin for the `thenBy` property */
    function extend(f) {
        f.thenBy = tb;
        return f;
    }
    /* adds a secondary compare function to the target function (`this` context)
       which is applied in case the first one returns 0 (equal)
       returns a new compare function, which has a `thenBy` method as well */
    function tb(y) {
        var x = this;
        return extend(function(a, b) {
            return x(a,b) || y(a,b);
        });
    }
    return extend;
})();

/*****************************************************************************************************/
// Array of named colors
/*****************************************************************************************************/

var colorNames = [
    ['AliceBlue','#F0F8FF'],
    ['AntiqueWhite','#FAEBD7'],
    ['Aqua','#00FFFF'],
    ['Aquamarine','#7FFFD4'],
    ['Azure','#F0FFFF'],
    ['Beige','#F5F5DC'],
    ['Bisque','#FFE4C4'],
    ['Black','#000000'],
    ['BlanchedAlmond','#FFEBCD'],
    ['Blue','#0000FF'],
    ['BlueViolet','#8A2BE2'],
    ['Brown','#A52A2A'],
    ['BurlyWood','#DEB887'],
    ['CadetBlue','#5F9EA0'],
    ['Chartreuse','#7FFF00'],
    ['Chocolate','#D2691E'],
    ['Coral','#FF7F50'],
    ['CornflowerBlue','#6495ED'],
    ['Cornsilk','#FFF8DC'],
    ['Crimson','#DC143C'],
    ['Cyan','#00FFFF'],
    ['DarkBlue','#00008B'],
    ['DarkCyan','#008B8B'],
    ['DarkGoldenRod','#B8860B'],
    ['DarkGray','#A9A9A9'],
    ['DarkGrey','#A9A9A9'],
    ['DarkGreen','#006400'],
    ['DarkKhaki','#BDB76B'],
    ['DarkMagenta','#8B008B'],
    ['DarkOliveGreen','#556B2F'],
    ['DarkOrange','#FF8C00'],
    ['DarkOrchid','#9932CC'],
    ['DarkRed','#8B0000'],
    ['DarkSalmon','#E9967A'],
    ['DarkSeaGreen','#8FBC8F'],
    ['DarkSlateBlue','#483D8B'],
    ['DarkSlateGray','#2F4F4F'],
    ['DarkSlateGrey','#2F4F4F'],
    ['DarkTurquoise','#00CED1'],
    ['DarkViolet','#9400D3'],
    ['DeepPink','#FF1493'],
    ['DeepSkyBlue','#00BFFF'],
    ['DimGray','#696969'],
    ['DimGrey','#696969'],
    ['DodgerBlue','#1E90FF'],
    ['FireBrick','#B22222'],
    ['FloralWhite','#FFFAF0'],
    ['ForestGreen','#228B22'],
    ['Fuchsia','#FF00FF'],
    ['Gainsboro','#DCDCDC'],
    ['GhostWhite','#F8F8FF'],
    ['Gold','#FFD700'],
    ['GoldenRod','#DAA520'],
    ['Gray','#808080'],
    ['Grey','#808080'],
    ['Green','#008000'],
    ['GreenYellow','#ADFF2F'],
    ['HoneyDew','#F0FFF0'],
    ['HotPink','#FF69B4'],
    ['IndianRed ','#CD5C5C'],
    ['Indigo ','#4B0082'],
    ['Ivory','#FFFFF0'],
    ['Khaki','#F0E68C'],
    ['Lavender','#E6E6FA'],
    ['LavenderBlush','#FFF0F5'],
    ['LawnGreen','#7CFC00'],
    ['LemonChiffon','#FFFACD'],
    ['LightBlue','#ADD8E6'],
    ['LightCoral','#F08080'],
    ['LightCyan','#E0FFFF'],
    ['LightGoldenRodYellow','#FAFAD2'],
    ['LightGray','#D3D3D3'],
    ['LightGrey','#D3D3D3'],
    ['LightGreen','#90EE90'],
    ['LightPink','#FFB6C1'],
    ['LightSalmon','#FFA07A'],
    ['LightSeaGreen','#20B2AA'],
    ['LightSkyBlue','#87CEFA'],
    ['LightSlateGray','#778899'],
    ['LightSlateGrey','#778899'],
    ['LightSteelBlue','#B0C4DE'],
    ['LightYellow','#FFFFE0'],
    ['Lime','#00FF00'],
    ['LimeGreen','#32CD32'],
    ['Linen','#FAF0E6'],
    ['Magenta','#FF00FF'],
    ['Maroon','#800000'],
    ['MediumAquaMarine','#66CDAA'],
    ['MediumBlue','#0000CD'],
    ['MediumOrchid','#BA55D3'],
    ['MediumPurple','#9370DB'],
    ['MediumSeaGreen','#3CB371'],
    ['MediumSlateBlue','#7B68EE'],
    ['MediumSpringGreen','#00FA9A'],
    ['MediumTurquoise','#48D1CC'],
    ['MediumVioletRed','#C71585'],
    ['MidnightBlue','#191970'],
    ['MintCream','#F5FFFA'],
    ['MistyRose','#FFE4E1'],
    ['Moccasin','#FFE4B5'],
    ['NavajoWhite','#FFDEAD'],
    ['Navy','#000080'],
    ['OldLace','#FDF5E6'],
    ['Olive','#808000'],
    ['OliveDrab','#6B8E23'],
    ['Orange','#FFA500'],
    ['OrangeRed','#FF4500'],
    ['Orchid','#DA70D6'],
    ['PaleGoldenRod','#EEE8AA'],
    ['PaleGreen','#98FB98'],
    ['PaleTurquoise','#AFEEEE'],
    ['PaleVioletRed','#DB7093'],
    ['PapayaWhip','#FFEFD5'],
    ['PeachPuff','#FFDAB9'],
    ['Peru','#CD853F'],
    ['Pink','#FFC0CB'],
    ['Plum','#DDA0DD'],
    ['PowderBlue','#B0E0E6'],
    ['Purple','#800080'],
    ['RebeccaPurple','#663399'],
    ['Red','#FF0000'],
    ['RosyBrown','#BC8F8F'],
    ['RoyalBlue','#4169E1'],
    ['SaddleBrown','#8B4513'],
    ['Salmon','#FA8072'],
    ['SandyBrown','#F4A460'],
    ['SeaGreen','#2E8B57'],
    ['SeaShell','#FFF5EE'],
    ['Sienna','#A0522D'],
    ['Silver','#C0C0C0'],
    ['SkyBlue','#87CEEB'],
    ['SlateBlue','#6A5ACD'],
    ['SlateGray','#708090'],
    ['SlateGrey','#708090'],
    ['Snow','#FFFAFA'],
    ['SpringGreen','#00FF7F'],
    ['SteelBlue','#4682B4'],
    ['Tan','#D2B48C'],
    ['Teal','#008080'],
    ['Thistle','#D8BFD8'],
    ['Tomato','#FF6347'],
    ['Turquoise','#40E0D0'],
    ['Violet','#EE82EE'],
    ['Wheat','#F5DEB3'],
    ['White','#FFFFFF'],
    ['WhiteSmoke','#F5F5F5'],
    ['Yellow','#FFFF00'],
    ['YellowGreen','#9ACD32']
];