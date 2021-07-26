<div class="content">
   <div class="header">
      <h1 class="page-title"><?php echo $page_title;?></h1>
   </div>
   <ul class="breadcrumb">
      <li><a href="<?php echo base_url();?>">Beranda</a> <span class="divider">/</span></li>
      <li><a href="<?php echo base_url();?>web/pengampu">Modul Pengampu</a> <span class="divider">/</span></li>
      <li class="active">Tambah Data</li>
   </ul>
   
   <div class="container-fluid">
      <div class="row-fluid">
        <?php if(isset($msg)) { ?>                        
              <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">�</button>                
                <?php echo $msg;?>
              </div>  
        <?php } ?>   

        <form id="tab" method="POST" >
          
            
            <input id="semester_tipe" type="hidden" name="semester_tipe" class="input-xsmall" value="1"/>
          
            <label>Posisi</label>
            <select name="kode_mk" class="input-xlarge" id="option_matakuliah">
              <?php foreach($rs_mk->result() as $mk) { ?>
                <option value="<?php echo $mk->kode;?>" <?php echo set_select('kode_mk',$mk->kode);?> /> <?php echo $mk->nama;?>
              <?php } ?>            
            </select>
            
            <label>Pekerja</label>
            <select name="kode_dosen" class="input-xlarge">
              <?php foreach($rs_dosen->result() as $dosen) { ?>
                <option value="<?php echo $dosen->kode;?>" <?php echo set_select('kode_dosen',$dosen->kode);?> /> <?php echo $dosen->nama;?>
              <?php } ?>
            </select>
            
            <label>Banyak Hari</label>
            <input id="banyak" type="text" value="<?php echo set_value('banyak');?>" name="banyak" class="input-xsmall" />
            <input id="kelas" type="hidden" name="kelas" class="input-xsmall" />
            
            <input id="tahun_akademik" type="hidden" name="tahun_akademik" class="input-xsmall" value="2011-2012" />
			
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Save</button>
              <a href="<?php echo base_url() .'web/pengampu'; ?>"><button type="button" class="btn">Cancel</button></a>
            </div>
        </form>

        <footer>
          <hr />
          <p class="pull-right">Design by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
          <p>&copy; 2012 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
        </footer>

      </div>
   </div>
</div>      