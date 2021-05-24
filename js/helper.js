function generateQR(){

    var idArtefacto = $('#idartefacto').val();


    var idsala = $('#inputidSala').val();
   console.log(idArtefacto + '_' + idsala);
    var typeNumber = 4;
    var errorCorrectionLevel = 'L';
    var qr = qrcode(typeNumber, errorCorrectionLevel);
    qr.addData(idArtefacto + '_' + idsala);
    qr.make();
    document.getElementById('placeHolder').innerHTML = qr.createImgTag();
    $('#inputqr').val(idArtefacto + '_' + idsala);


//Descargar Imagen
    $("#descargar").attr("href",$("#placeHolder img").attr("src"));
    $("#descargar").attr("download","QR_"+$("#inputArtefacto").val()+".png");

    //Imprimir Imagen
 /* $("#imprimir").click(function () {
        var url=window.location;




       window.onbeforeprint=function(e){
           window.location=$("#placeHolder img").attr("src");
       }
       window.onafterprint=function (e) {
           window.location=url;
       };
      window.print();

   });*/



}


$(function () {


    $('#editar_video').on("change",function (e) {
    $("#preview_nombre").val(e.target.files[0].name);





    });

    $('#subir_video').on("change",function (e) {
        $("#preview_nombre2").val(e.target.files[0].name);


    });

    $('#subir_imagen').on("change",function (e) {
        $("#preview_nombre3").val(e.target.files[0].name);



    });

    $('#subir_imagen2').on("change",function (e) {
        $("#preview_nombre35").val(e.target.files[0].name);



    });


/*
    $('#exampleInputPassword1').on("focusin",function(){
        $('#imgver').css("display","block");
    });

    $('#exampleInputPassword1').on("focusout",function(){
        $('#imgver').css("display","none");
    });*/

    $('#imgver').on("mouseenter",function(){
        $('#imgver').css("opacity","1");
    });
    $('#imgver').on("mouseleave",function(){
        $('#imgver').css("opacity","0");
    });

$('#imgver').on("click",function(e){

    if($('#exampleInputPassword1').attr("type")=="password"){
        $('#exampleInputPassword1').attr("type","text");
       var a=$('#imgver').attr("src").split("/");
       a[a.length-1]="View3.png";
        $('#imgver').attr("src",a.join("/"));
    }else{
        $('#exampleInputPassword1').attr("type","password");
        var a=$('#imgver').attr("src").split("/");
        a[a.length-1]="View2.png";
        $('#imgver').attr("src",a.join("/"));
    }
});


});