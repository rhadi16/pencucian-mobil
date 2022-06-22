<div class="container">
  <form method="get">
    <div class="row">
      <div class="col-md-6">
        <select name="Kolom" id="select-column-paginasi" class="form-select">
          <?php 
            for ($i=0; $i < count($column['value']); $i++) {
          ?>
            <option value="<?php echo $column['value'][$i]; ?>" <?php if(isset($_GET['Kolom']) AND $_GET['Kolom']==$column['value'][$i]){echo'selected';} ?>><?php echo $column['label'][$i]; ?></option>
          <?php } ?>
        </select>
      </div>

      <div class="col-md-6">
        <input id="input-column-paginasi" type="text" class="form-control" placeholder="Nama Yang Dicari" name="KataKunci" value="<?php if(isset($_GET['KataKunci'])){echo $_GET['KataKunci'];} ?>">
      </div>

      <div class="col-md-6 tombol">
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>Cari</button>
        <?php 
          if(isset($_GET['Kolom']) || isset($_GET['KataKunci'])){
        ?>
          <a href="<?php echo $view; ?>" class="btn btn-danger"><i class="fas fa-times"></i>Batal</a>
        <?php } ?>
      </div>
    </div>  
  </form>
</div>