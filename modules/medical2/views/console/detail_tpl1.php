
<?php 

?>

<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr>
            <th colspan='8' style="background-color:#063058;color:#fff;font-size:26px;padding:10px;"><center>Prescription Details</></th>           
                       
           
        </tr>
        <tr>
            <th>Id</th>           
            <th>Name</th>
            <th>Phone No</th>   
            <th>Address</th>    
            <th>Note</th>         
            <th>Status</th>           
            <th>Image</th> 
            <th>Date</th>           
           
        </tr>
      
    </thead>   
    <tbody>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['id']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['Name']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['phone']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['address']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['note']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['status']) ?></td>
    <td class="center"><a target="_blank" id="prep<?= htmlspecialchars_decode($table_meta['data']['id']) ?>"  href="#"  > <img src='<?=$table_meta['data']['image_capture']?>' /></a> 
 

    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['date']) ?></td>
        
                       
    </tbody>
    
</table>  
<script>
const b64toBlob = (b64Data, contentType='', sliceSize=512) => {
  const byteCharacters = atob(b64Data);
  const byteArrays = [];

  for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
    const slice = byteCharacters.slice(offset, offset + sliceSize);

    const byteNumbers = new Array(slice.length);
    for (let i = 0; i < slice.length; i++) {
      byteNumbers[i] = slice.charCodeAt(i);
    }

    const byteArray = new Uint8Array(byteNumbers);
    byteArrays.push(byteArray);
  }

  const blob = new Blob(byteArrays, {type: contentType});
  return blob;
}
const fulldata='<?=$table_meta['data']['image_capture']?>';

const contentType = 'image/png';
const b64Data = fulldata.split(',')[1]

const blob = b64toBlob(b64Data, contentType);
const blobUrl = URL.createObjectURL(blob);

const img = document.createElement('img');
$('#prep<?= htmlspecialchars_decode($table_meta['data']['id']) ?>').attr('href',blobUrl)
</script>