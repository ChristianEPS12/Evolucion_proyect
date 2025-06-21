const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

const image = new Image();
image.src = '../../public/certificado.png';

$(document).ready(function(){
    var curd_id = getUrlParameter('curd_id');
    
    $.post("../../controller/usuario.php?op=mostrar_curso_detalle", { curd_id : curd_id }, function (data) {
        data = JSON.parse(data);
        $('#cur_descrip').html(data.cur_descrip);

        ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
        ctx.font = '54px "Pacifico", cursive'; // Cambia "Pacifico" por la fuente que prefieras
        ctx.fillStyle = '#0084c6';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';

        var x = canvas.width / 2;
        ctx.fillText(data.usu_nom + ' '+ data.usu_apep + ' '+data.usu_apem, x, 190);

        ctx.font = 'bold 45px Helvetica Bold';
        ctx.fillStyle = '#000000';
        ctx.fillText('"' + data.cur_nom + '"', x, 315);
    });

});

$(document).on("click", "#btnpng", function(){
    let lblpng = document.createElement('a');
    lblpng.download = "Certificado_Finalizacion.png";
    lblpng.href = canvas.toDataURL();
    lblpng.click();
});

$(document).on("click", "#btnpdf", function(){
    var imgData = canvas.toDataURL('image/png');
    var doc = new jsPDF('l', 'mm');
    doc.addImage(imgData, 'PNG', 30, 15);
    doc.save('Certificado_Finalizacion.pdf');
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
