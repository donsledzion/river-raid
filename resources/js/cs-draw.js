let i = $('.cs-p').length-1;
draw();

$(document).on('click', '#add',function(){
    draw();
    ++i;
    console.log("Clicked! (i = "+i+" )");
    $("#dynamicTable")
        .append('' +
            '<tr class="cs-p p-0 m-0" data-id="'+i+'">' +
                '<td class="p-0 m-0">' +
                    '<input id="cs-i-'+i+'" type="number"  name="point['+i+'][number]" class="form-control text-sm-center" readonly value="'+(i+1)+'" />' +
                '</td>' +
                '<td class="p-0 m-0">' +
                    '<input id="cs-x-'+i+'" type="number" name="point['+i+'][x]" data-id="'+i+'" class="cs-x form-control text-sm-center" step="0.01" value="0.00" />' +
                '</td>' +
                '<td class="p-0 m-0">' +
                    '<input id="cs-y-'+i+'" type="number" name="point['+i+'][y]" data-id="'+i+'" class="cs-y form-control text-sm-center" step="0.01" value="0.00"  /></td>' +
                '<td class="p-0 m-0">' +
                    '<button type="button" class="btn btn-danger remove-tr w-100">-</button>' +
                '</td>' +
            '</tr>');
});

$(document).on('click', '.remove-tr', function(){
    $(this).parents('tr').remove();
    draw();
});

$(document).on('click', '#draw-button', function(){
    draw();
});

function CsPoint(_distance=0, _height=0){
    this.distance = _distance;
    this.height = _height;
}


function draw() {
    console.clear();

    let CrossSection = [];
    let refLvl = $("#ref_lvl").val();

    $(".cs-x").each(function() {
            let x = $("#cs-x-" + $(this).data("id")).val();
            let y = $("#cs-y-" + $(this).data("id")).val();
            let cssss = CrossSection.push(new CsPoint(x, y));
            console.log(CrossSection[cssss-1]);

        }
    );

    CrossSection.sort((a,b) => {
        return a.distance - b.distance ;
    });

    $('.cs-p').remove();

    let j = 0 ;
    let csHeight = 0 ;
    /*******************************
     * testing another approach
     * */
    for(let r = 0 ; r < CrossSection.length ; r++) {
        let insertButton = '<button type="button" class="btn btn-danger remove-tr w-100">-</button>' ;
        if(r===0){
            insertButton = '<button type="button" name="add" id="add" class="btn btn-success w-100">+</button>'
        }

        $("#dynamicTable")
            .append('' +
                '<tr class="cs-p p-0 m-0" data-id="' + r + '">' +
                '<td class="p-0 m-0">' +
                '<input id="cs-i-' + r + '" type="number"  name="point[' + r + '][number]" class="form-control text-sm-center" readonly value="' + (r + 1) + '" />' +
                '</td>' +
                '<td class="p-0 m-0">' +
                '<input id="cs-x-' + r + '" type="number" name="point[' + r + '][x]" data-id="' + r + '" class="cs-x form-control text-sm-center" step="0.01" value="'+CrossSection[r].distance+'" />' +
                '</td>' +
                '<td class="p-0 m-0">' +
                '<input id="cs-y-' + r + '" type="number" name="point[' + r + '][y]" data-id="' + r + '" class="cs-y form-control text-sm-center" step="0.01" value="'+CrossSection[r].height+'"  /></td>' +
                '<td class="p-0 m-0">' +
                insertButton +
                '</td>' +
                '</tr>');
        if(CrossSection[r].height > csHeight){
            csHeight = CrossSection[r].height ;
        }
    }
    /******************************
     * */
    /*$(".cs-i").each(function() {

            $("#cs-i-" + j)
                .attr("value",j+1)
                .attr("id","cs-i-"+j)
                .attr("name","point["+j+"][number]");
            //console.log("Insert into: x = "+$("#cs-x-" + j).val());
            $("#cs-x-" + j)
                .attr("value",CrossSection[j].distance)
                .attr("id","cs-x-"+j)
                .attr("data-id",+j)
                .attr("name","point["+j+"][x]");
            //console.log("Insert into: y = "+$("#cs-y-" + j).val());
            $("#cs-y-" + j)
                .attr("value",CrossSection[j].height)
                .attr("id","cs-y-"+j)
                .attr("data-id",+j)
                .attr("name","point["+j+"][y]");

            if(CrossSection[j].height > csHeight){
                csHeight = CrossSection[j].height ;
            }
            console.log("Point ["+(j+1)+"] = " + CrossSection[j].distance+" , " + CrossSection[j].height+" |");
            j++;
        }
    );*/

    let csWidth = CrossSection[CrossSection.length-1].distance ;
    let canvas = document.getElementById('canvas');

    if (canvas.getContext) {
        let ctx = canvas.getContext('2d');
        ctx.clearRect(0,0,canvas.width,canvas.height);
        console.log("csWidth: "+csWidth);
        console.log("csHeight: "+csHeight);
        let x_offset = canvas.width*0.1;
        let y_offset = +120;

        let xMultip = 1 ;
        let yMultip = 1 ;

        if(i > 1) {
            xMultip = ((canvas.width - 2 * x_offset)) / (+csWidth);
            yMultip = ((canvas.height - 2 * x_offset)) / (+csHeight);
        }
        console.log("xMultip: "+xMultip);
        console.log("yMultip: "+yMultip);
        console.log("refLvl: "+refLvl);
        ctx.beginPath();
        ctx.moveTo(0,y_offset);
        ctx.lineTo(x_offset,y_offset);
        ctx.lineTo(x_offset+ +CrossSection[0].distance,y_offset- (+CrossSection[0].height - +refLvl)*yMultip);
        for(let k = 1 ; k < CrossSection.length ; k++){
            ctx.moveTo(x_offset+ +xMultip*CrossSection[k-1].distance,y_offset);
            ctx.lineTo(x_offset+ +xMultip*CrossSection[k].distance,y_offset);
            ctx.lineTo(x_offset+ +xMultip*CrossSection[k].distance,y_offset- (+CrossSection[k].height - +refLvl)*yMultip);
            ctx.lineTo(x_offset+ +xMultip*CrossSection[k-1].distance,y_offset- (+CrossSection[k-1].height - +refLvl)*yMultip);
        }

        //ctx.closePath();
        ctx.lineWidth = 2;
        ctx.stroke();

    }
}
