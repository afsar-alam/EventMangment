<?php
include('includes/checklogin.php');
check_login();
if(isset($_GET['delid']))
{
    $rid=intval($_GET['delid']);
    $sql="update tbladmin set Status='0' where ID='$rid'";
    $query=$dbh->prepare($sql);
    $query->bindParam(':rid',$rid,PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('User blocked');</script>"; 
    echo "<script>window.location.href = 'userregister.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>
<!--  Author Name: Afsar Alam From India 
 for any PHP, Codeignitor, Laravel OR Python work contact me at +919423979339 OR ndbhalerao91@gmail.com  
 Visit website : www.nikhilbhalerao.com -->
    <div class="container-scroller">
        
        <?php @include("includes/header.php");?>
        
        <div class="container-fluid page-body-wrapper">
            
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="float: left;">User Permissions</h5>
                                </div>
                                
                                <div id="editData" class="modal fade">
                                  <div class="modal-dialog ">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Change permissions</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body" id="info_update">
                                     <?php @include("change_permissions.php");?>
                                 </div>
                                 <div class="modal-footer ">
                              </div>
                              
                          </div>
                          
                      </div>
                      
                  </div>
                  

                  <div class="card-body table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="d-none d-sm-table-cell" style="width: 20%">Permission Name</th>
                                <th class="d-none d-sm-table-cell text-center" >Action</th>
                            </tr>
                        </thead>
                        <!--  Author Name: Afsar Alam From India 
 for any PHP, Codeignitor, Laravel OR Python work contact me at +919423979339 OR ndbhalerao91@gmail.com  
 Visit website : www.nikhilbhalerao.com -->
<tbody>
                            <?php
                            $companyname=$_SESSION['companyname'];
                            $sql="SELECT * from permissions  ";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $row)
                                {    
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo htmlentities($cnt);?></td>

                                        <td><?php  echo htmlentities($row->permission);?></td>
                                        <td class="d-none d-sm-table-cell text-center">
                                         <button class="btn btn-primary btn-xs edit_data" id="<?php echo  ($row->id); ?>" title="click for edit">Change Permission</button>
                                     </td>
                                 </tr>
                                 <?php $cnt=$cnt+1;
                             }
                         } ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>
</div>


<?php @include("includes/footer.php");?>

</div>

</div>

</div>

<?php @include("includes/foot.php");?>
<!--  Author Name: Afsar Alam From India 
 for any PHP, Codeignitor, Laravel OR Python work contact me at +919423979339 OR ndbhalerao91@gmail.com  
 Visit website : www.nikhilbhalerao.com -->

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click','.edit_data',function()
        {
            var edit_id=$(this).attr('id');
            $.ajax(
            {
                url:"change_permissions.php",
                type:"post",
                data:{edit_id:edit_id},
                success:function(data)
                {
                    $("#info_update").html(data);
                    $("#editData").modal('show');
                }
            });
        });
    });
</script>
</body>
<!--  Author Name: Afsar Alam From India 
 for any PHP, Codeignitor, Laravel OR Python work contact me at +919423979339 OR ndbhalerao91@gmail.com  
 Visit website : www.nikhilbhalerao.com -->
</html>
