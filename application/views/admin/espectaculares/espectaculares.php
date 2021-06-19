<h1 class=" text-center">Espectaculares</h1>
<!-- <?php var_dump($espectaculares)?> -->
<hr>
<div class="d-flex justify-content-between my-4">
    <div class="d-flex align-items-center">
        <input type="text" class="form-control mr-2" id="buscadorespactacular" name="buscadorespactacular" value=""
            placeholder="Busca espectacular">
        <a class="btn btn-info search" href="Javascript:BuscaEspectacular();" role="button"><i class="fas fa-search"></i><span> Buscar</span></a>&nbsp;
    </div>
    <div class="d-flex align-items-center">
        <a class="btn btn-warning add" href="<?php echo base_url('admin/espectaculares/agregarEspectacular')?>" role="button"><i class="fas fa-plus"></i> <span>+ Nuevo Espectacular +</span></a>
    </div>
</div>
<div class="table-responsive" id="espectacularesContainer">
<table class="table table-hover table-sm table-responsive-xs" id="table">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>Clave master</th>
      <th>Localidad</th>
      <th>Municipio</th>
      <th>Estado</th>
      <th>medidas</th>
      <th>Status</th>
      <th>Costo mensual</th>
      <th>Costo impresión</th>
      <th>Costo instalación</th>
      <th>Costo material</th>
      <th>Costo total</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
      
      <?php 
      $index = 1;
      foreach($espectaculares as $espectacular):?>
    <tr>
      <th><?= $index?></th>
      <th><?= $espectacular['nocontrol']?></th>
      <td><?= $espectacular['localidad']?></td>
      <td><?= $espectacular['municipio']?></td>
      <td><?= $espectacular['nombre_estado']?></td>
      <td><?= $espectacular['ancho'] . "m x ". $espectacular['alto']."m"?></td>
      <td><?= $espectacular['status']?></td>
      <td>$<?= $espectacular['costo_renta']?></td>
      <td>$<?= $espectacular['costo_impresion']?></td>
      <td>$<?= $espectacular['costo_instalacion']?></td>
      <td>$<?= $espectacular['precio_material']?></td>
      <td>$<?= $espectacular['precio']?></td>
      <td><button class="btn btn-info btn-sm" onclick="imagesEspecatulares(<?=$espectacular['id']?>)" data-toggle="modal" data-target="#imagenes"><i class="fas fa-eye"></i></button>
      <a href="<?= base_url('admin/espectaculares/editarEspectacular/'.$espectacular['id'])?>" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a>
      <?php if($this->session->userdata("tipo") == 1){?>
      <button class="btn btn-danger btn-sm" onclick="eliminarEspectacular(<?=$espectacular['id']?>)" ><i class="fas fa-trash"></i></button></td>
      <?php }?>
    </tr>
    <?php
    $index++;
    endforeach?>
  </tbody>
</table>
</div>

<!-- Modal -->
<div class="modal fade" id="imagenes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitle"></h5>
        <button type="button" onclick="removeImg()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="carousel">
      </div>

      </div>
  </div>
</div>
</div>
<script src="<?= base_url('assets/js/espectaculares.js')?>"></script>

<script>
function removeImg(){
    $(".img-carousel").removeAttr('src');
    // $("#img2").removeAttr('src');
    // $("#img3").removeAttr('src');
}

function imagesEspecatulares(id){
  $.get('espectaculares/obtenerImagenesEspectacularPorId/'+id, function(response){
    // console.log(response);
    if(response == ''){
    }else{
      let resp = JSON.parse(response);
      console.log(resp);
      
      resp.map(res =>{
        
           document.getElementById('ModalTitle').innerHTML = `Imagenes del espectacular ${res.nocontrol}`
           document.getElementById('carousel').innerHTML= `
           <div class="owl-carousel">
              <div><img src="../assets/images/medios/${res.vista_corta}" id="img1" class="img-carousel" alt=""></div>
              <div><img src="../assets/images/medios/${res.vista_media}" id="img2" class="img-carousel" alt=""></div>
              <div><img src="../assets/images/medios/${res.vista_larga}" id="img3" class="img-carousel" alt=""></div>
            </div>
           
           `
          //  let element = document.querySelectorAll('.img-carousel')
          //  console.log(element)
          //    element[0].setAttribute('src',`<?= base_url()?>assets/images/medios/${res.vista_corta}`);
          //    element[1].setAttribute('src',`<?= base_url()?>assets/images/medios/${res.vista_media}`);
          //    element[2].setAttribute('src',`<?= base_url()?>assets/images/medios/${res.vista_larga}`);

           
         })
         $('.owl-carousel').owlCarousel({
    loop:true,
    margin:0,
    responsiveClass:true,
    nav: true,
    center: true,
    responsive:{
        0:{
            items:1,
            nav:true,
            center: true
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            center: true

        }
    }
})
    }
  })


}


// $('#monto').mask('000000');

</script>


<script>espectacularesit.classList.add("selected");</script>
