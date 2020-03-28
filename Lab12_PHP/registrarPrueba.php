<?php
    session_start();
  include("html/_header.html");
  include("html/_title.html");

 ?>

 <html lang="en" dir="ltr">
 <!-- CARD DE BENEFICIARIA -->
   <div class="row d-flex justify-content-center">
     <div class="card mb-3 border-top-0 border-left-0 col-xs-4" style="max-width: 600px;">
       <div class="row no-gutters">
         <div class="col-md-4">
           <?php
           if(!isset($_SESSION['image'])) {
              echo '<img src="images/malala.jpg" class="card-img rounded-circle foto-prueba" alt="Foto beneficiaria">';
           } else {
             echo '<img src="images/'.$_SESSION['image'].'" class="card-img rounded-circle foto-prueba" alt="Foto beneficiaria">';
           }
           ?>
         </div>
         <div class="col-8">
           <div class="card-body">
             <h5 class="card-title">Antonia Hernandez Caballero</h5>
             <p class="card-text">Diagnostico: Discapacidad intelectual leve
             <br> Edad: 16 años</p>
             <form class="" action="upload.php" method="post" enctype="multipart/form-data">
               <p class="card-text"><small class="text-muted">Cambiar foto</small></p>
               <input type="file" name="fileToUpload" id="fileToUpload">
               <input type="submit" value="cambiar foto" name="submit">
             </form>
           </div>
         </div>
       </div>
     </div>
   </div>
   <br>
 </html>

<?php
  include("html/_tabla.html");
  include("html/_footer.html");
 ?>
