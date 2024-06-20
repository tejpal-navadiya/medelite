<?php include "css.php"; 
$is_provider_user=0;
if(isset($_SESSION['me_user_type_name']))
{
    if($_SESSION['me_user_type_name']=="Provider" && $_SESSION['me_user_type']=="0")
    {
      $is_provider_user=1;
    }
}
?>
<style>
 
</style>

<?php include "topbar.php"; ?>
<?php include "sidebar.php"; ?>
  <div class="content-wrapper <?php echo $body_class_addition; ?>">
    <?php include "content.php"; ?>    
  </div>
<?php include "js.php"; ?>
<script>
  function ToggleClickById(ele_id)
  {
    document.getElementById(ele_id).click();
  }
  $("#main-sidebar-toggle-button").click(function(){
    // alert('ok');
  });
  </script>