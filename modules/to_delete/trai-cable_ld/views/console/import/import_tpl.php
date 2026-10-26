<form  method="post" action="<?=base_url().'console/import/upload'?>" enctype="multipart/form-data">
          Select xlsx to upload:
         <input type="file" name="file_name">
         <input type="submit" name="submit" value="Upload"  class="btn btn-success">
         <a href="<?=base_url ()?>console/import/download/cable_sample.xlsx" class="btn btn-primary">Download</a>
      </form> 
