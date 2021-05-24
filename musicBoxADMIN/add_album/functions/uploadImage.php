<?php

  $error_img = array();
if($id != ''){
  if($_FILES['upload_image']['error'] > 0)
  {
   //�������� �������
   switch ($_FILES['upload_image']['error'])
   {
   case 1: $error_img[] =  '����� ����� �������� ��������� �������� UPLOAD_MAX_FILE_SIZE'; break;
   case 2: $error_img[] =  '����� ����� �������� ��������� �������� MAX_FILE_SIZE'; break;
   case 3: $error_img[] =  '�� ������� ��������� ������� �����'; break;
   case 4: $error_img[] =  '���� �� ��� ����������'; break;
   case 6: $error_img[] =  '³������ ��������� �����.'; break;
   case 7: $error_img[] =  '�� ������� �������� ���� �� ����.'; break;
   case 8: $error_img[] =  'PHP-���������� �������� �������� �����.'; break;
   }
  
  }else
  {
  //�������� ����������
  if($_FILES['upload_image']['type'] == 'image/jpeg' || $_FILES['upload_image']['type'] == 'image/jpg' || $_FILES['upload_image']['type'] == 'image/png')
  { 
  
  $imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image']['name']));
  
      //����� ��� ��������
  $uploaddir = './artworkAlbum/';
  //���� ���

  $newfilename = $_POST["albumName"].'-'.$id.rand(1,1000).'.'.$imgext;
  //���� �� �����
  $uploadfile = $uploaddir.$newfilename;
   
  //�������� �����
  if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile))
  {
    
    $update = mysql_query("UPDATE albums SET artworkPath = '$newfilename' WHERE id = '$id'", $link);   
    echo ("<script>alert('Альбом успішно додано !');</script>");
  }
  else
  {
   $error_img[] =  "������� �������� �����.";    
  }
   
  
      
  }else
  {
   $error_img[] =  '�������� ����������: jpeg, jpg, png';
  }
  }

}


?>