<?php
  require_once __DIR__.'/../DB.php';
  require_once __DIR__.'/../phpqrcode/qrlib.php';
  $db = new UserQuery();
  if(isset($params['id']))
    $user = $db->getUserById($params['id']);
  if(!isset($user) || empty($user)){
    header("Location: http://localhost/form_user/pages/404.php");
  }
  // create csv file 
  $folder_scv=dirname(__DIR__)."/csv_file/";
  $file_name_csv=$user['id'].".csv";
  $fp = fopen($folder_scv.$file_name_csv, 'w');
  fputcsv($fp, $user);
  fclose($fp);
  // create qr png file 
  $folder_qrs=dirname(__DIR__)."/QRS_PNG/";
  $file_name_qrs=$user['id'].".png";
  QRcode::png($user['qr_code'], $folder_qrs.$file_name_qrs);
?>
<html>
  <body>
    <div style="display: flex;width: 100%; justify-content: center;margin-top: 128px;flex-direction: column;align-items: center;">
      <h1> <?php echo 'Wellcome '.$user['name'] ?> </h1>
      <img src=<?php echo '../QRS_PNG/'.$file_name_qrs ?> >
      <p><a href=<?php echo '../csv_file/'.$file_name_csv ?>>Download CSV file</a></p>
    </div>
  </body>
</html>