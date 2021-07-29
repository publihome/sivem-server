
$('#agregarCliente').submit(function(e){
    e.preventDefault()
    let formData = new FormData($("#agregarCliente")[0]);

    $.ajax({
        url:'guardarCliente',
        type:'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,


    })
    .done(function(response){
        console.log(response)
        let res =  JSON.parse(response);
        if(res.success){
            alertify.success(res.success)
        }
        if(res.error){
            alertify.error(res.error)
        }
        $("#agregarCliente")[0].reset();
    })
    .fail(function(e){
        console.log(e)
    })
})




$('#editarCliente').submit(function(e){
    e.preventDefault()
    let formData = new FormData($("#editarCliente")[0]);

    $.ajax({
        url:'../guardarClienteEditado',
        type:'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(response){
        console.log(response)
        let res = JSON.parse(response);
        if(res.success){
            // $("#editarCliente")[0].reset();
            alertify.success(res.success)
        }
        if(res.error){
            alertify.error(res.error);
        }
        
    })
    .fail(function(e){
        console.log(e)
    })
})


$(document).ready(function(){
    $('#telefono').mask('000-000-00-00');
    $('#codigoPostal').mask('00000');
    $('#rfc').mask('AAAA000000AAAA');
})


function eliminarCliente(cliente_id){
    $.ajax({
        url:'clientes/eliminarCliente',
        type: 'post',
        data: {id:cliente_id},
    })
    .done(function(response){
        console.log(response)
        alertify.success(response.success)
        setTimeout(() => {
           window.location.reload(); 
        }, 1200);
     })
    .fail(function(err){
         console.log(err)
            alertify.error(err)

    })
}
