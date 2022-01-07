 
  <script>
      var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
      });

      <?php if ($this->session->flashdata('success')) { ?>

          Toast.fire({
              icon: 'success',
              title: '<?php echo $this->session->flashdata('success'); ?>'
          })


      <?php  } ?>
  </script>