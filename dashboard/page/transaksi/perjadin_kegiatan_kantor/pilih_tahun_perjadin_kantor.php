<?php
require_once '../../../../inc/inc.library.php';
?>
<div class="modal-header">
  <h3 class="modal-title" id="exampleModalLabel">Pilih Tahun Perjadin Kantor</h3>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="cekOffice" role="form" action="javascript:void(0)">
  <div class="modal-body">
    <div class="mb-3">
      <select class="form-select" id="byYear" aria-label="Default select example">
        <option selected="" disabled>Pilih Tahun...</option>
        <?php
        $sekarang = date('Y');
        for ($i = $sekarang - 1; $i <= $sekarang + 1; $i++) {
          echo '<option value=' . encrypt($i);
          if ($i == $sekarang) {
            echo ' selected ';
          }
          echo '>' . $i . '</option>';
        }
        ?>
      </select>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-success" name="">Lanjut</button>
    <!-- <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button> -->
  </div>
</form>
<script type="text/javascript">
  $('#cekOffice').submit(function(e) {
    var byYear = document.getElementById("byYear").value;
    window.location = "documentOffice?_token=" + byYear;
  });
</script>