<!DOCTYPE html>
<html lang="en">
<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
// define("ADMIN_CRM_TITLE","MedElite");
// session_start();
    include "config_front.php";
    // include("functions.php"); 
    include "page_titles.php";
    include("functions.php");

    // Get Access Role Data
    $API_REQ_DATA=array();
    $API_REQ_DATA['apitoken']=$_SESSION['me_apitoken'];
    // $API_REQ_DATA['apitoken']=$_SESSION['me_user_type'];
    
    $API_REQ_URL=$api_url."user_access/app_access_list.php";
    $UserAccessRoleDataJSON=CallAPI("POST", $API_REQ_URL, $API_REQ_DATA);
    $UserAccessRoleDataArray=array();
    $UserAccessRoleData=array();
    $UserAccessRoleDataArray=json_decode($UserAccessRoleDataJSON,true);
    $UserAccessRoleData= $UserAccessRoleDataArray["data"];
    // print_r($UserAccessRoleData);
?>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php if(isset($page_title)){echo $page_title." | ";}  echo ADMIN_CRM_TITLE;  ?></title>
       <?php
        $uniq_version=uniqid(); 
       ?> 
      <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

      <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css?v=<?php echo $uniq_version; ?>">

      <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css?v=<?php echo $uniq_version; ?>">

      <link rel="stylesheet" href="assets/css/adminlte.min2167.css?v=<?php echo $uniq_version; ?>">
      <link rel="stylesheet" href="assets/css/custom-main.css?v=<?php echo $uniq_version; ?>">

        <link rel="stylesheet" href="plugins/select2/css/select2.min.css?v=<?php echo $uniq_version; ?>">
        <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


      <meta name="apitoken" content="<?php echo $_SESSION['me_apitoken'] ?>">
    <meta name="api-url" content="<?php echo $api_url;?>">   

      <!-- <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css?v=<?php echo $uniq_version; ?>"> -->
      <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css?v=<?php echo $uniq_version; ?>">
      <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css?v=<?php echo $uniq_version; ?>">

      <link href="plugins/jquery.filer/src/jquery.fileuploader.css?v=<?php echo $uniq_version; ?>" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="plugins/bootstrap-timepicker/compiled/timepicker.css?v=<?php echo $uniq_version; ?>">
      
      <style>
            /* .datepicker-dropdown td,.datepicker-dropdown th
            {
                padding:10px;
            }
            .datepicker-switch
            {
                text-align: center!important;
            } */
            .fileuploader-input-button
            {
                display: none;
            }
            .custom-display-items
            {
                text-align: center;
                padding: 15px;
            }
            .custom-display-items .custom-column-title
            {
                padding-top: 10px;
                color: white!important;
            }
            .custom-display-items .custom-column-heading
            {
                padding-bottom: 10px;
                font-weight: bold;
                font-size: 15px;
                color: white!important;
            }
            .custom-display-items .fileupload-no-thumbnail
            {
                height: 100px;
                width: 100px;
                background-color: #1a73e8;
                color: white;
                margin: 0 20%;
            }
            .custom-display-items .fileuploader-item-icon
            {
                padding-top: 30px;
                font-size: 25px;
            }
            .dataTables_paginate .paginate_button
            {
                border: 1px solid;
                background-color: #3f474e;
                color: #fff;
                border-color: #727b84;
                padding: 5px 10px;
                border-radius: 5px;
                margin-right: 10px;
            }
            .dataTables_paginate .paginate_button:hover
            {
                /* color: #dee2e6!important; */
                cursor: pointer;
            }
            .dataTables_paginate .paginate_button.current
            {
                /* color: #007bff!important; */
                border-color: #007bff;
            }
            .table-responsive
            {
                /* overflow-x: unset; */
            }
            .help
            {
                color: red;
                font-size: 14px;
            }
            #example1 thead th:last-child:before,#example1 thead th:last-child:after
            {
                content: "";
            }
            table.dataTable>thead th:first-child.sorting_desc:before,table.dataTable>thead th:first-child.sorting_desc:after
            {
                content: ''!important;
            }
        </style>
    </head>
    <?php 
    $body_class_addition="";
    if(isset($_REQUEST['pid']) && $_REQUEST['pid']=="home")
    {
        $body_class_addition="custom-dark-back";
    }
    ?>
  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed ">
      <div class="wrapper">

          <!-- <div class="preloader flex-column justify-content-center align-items-center">
              <img class="animation__wobble" src="assets/img/logo.png" alt="AdminLTELogo" height="250" >
          </div> -->