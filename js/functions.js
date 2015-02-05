var sortColors = function(colors, sortCriteria) {
    for (var c = 0; c < colors.length; c++) {
        hex = colors[c].hex;
         
        /* Get the RGB values to calculate the Hue. */
        var r = parseInt(hex.substring(0,2),16)/255;
        var g = parseInt(hex.substring(2,4),16)/255;
        var b = parseInt(hex.substring(4,6),16)/255;
 
        /* Getting the Max and Min values for Chroma. */
        var max = Math.max.apply(Math, [r,g,b]);
        var min = Math.min.apply(Math, [r,g,b]);
 
        /* Variables for HSV value of hex color. */
        var chr = max-min;
        var hue = 0;
        if (max){
            var val = max;
        } else{
            val = 0;
        }
        var sat = 0;
 
        if (val > 0) {
            /* Calculate Saturation only if Value isn't 0. */
            sat = chr/val;
            if (sat > 0) {
                if (r == max) {
                    hue = 60*(((g-min)-(b-min))/chr);
                    if (hue < 0) {hue += 360;}
                } else if (g == max) {
                    hue = 120+60*(((b-min)-(r-min))/chr);
                } else if (b == max) {
                    hue = 240+60*(((r-min)-(g-min))/chr);
                }
            }
        }
         
        /* Modifies existing objects by adding HSV values. */
        colors[c].hue = hue;
        colors[c].sat = sat;
        colors[c].val = val;
    }
 
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


function printColors(sortCriteria){
    colors2 = sortColors(colorsOG,sortCriteria);
    
    for(i = 0; i < colors2.length; i++){
        $('#' + sortCriteria).append('<div class="color" style="background:#' + colors2[i].hex + ';"><span>H:' + parseInt(colors2[i].hue) + '  S:' + colors2[i].sat.toFixed(2) + '  V:' + colors2[i].val.toFixed(2) + '<hr/>#' + colors2[i].hex.toLowerCase() + '</span></div>');
    }

}

function getMatches(num){
    for(i = 0; i < num; i++){
        if (colorsOG[i].hex == colorsOG[num].hex){
            return true;
        }
    }
}


