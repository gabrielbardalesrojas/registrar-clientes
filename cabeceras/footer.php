


<footer class="footer">
    <p>&copy; 2024 MIRADOR DOS ENCUENTROS. Todos los derechos reservados.</p>
    <div class="nav-links">
        
        <a  target="_blank"><img src="../img/logo1.png" alt="Facebook"></a>
        <a  target="_blank"><img src="../img/logo2.png" alt="WhatsApp"></a>
    </div>
</footer>
        <!-- Bootstrap JavaScript Libraries -->
       
        

<script>
    function borrar(id){
alert(id);
Swal.fire({
  title: "desea borrar el registro?",
  showCancelButton: true,
  confirmButtonText: "Si"
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    window.location="index.php?txtID="+id;
  } 
})
//index.php?txtID=
    }
</script>
       
    </body>
</html>
