<?php

class EditController extends Controller {

	private $edit;
    private $name;
    private $price;
    private $image;
    private $date;

    public function __construct() {
        $this->edit = new Model();

    }
    public function editProduct($id) {
		if(isset($_POST['btnEdit'])){ 
    	$name = $_POST['txtSP'];
    	$price = (int)$_POST['price'];
    	$date = $_POST['date'];
        $target_dir="uploads/";
            $target_file=$target_dir . basename($_FILES["hinh"]["name"]);
            $img=$target_file;
            $uploadOk=1;
            $imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if ($imageFileType !="jpg"&& $imageFileType!="png"&&$imageFileType!="jpeg"&&$imageFileType!="gif") {
              $uploadOk=0;
            }
        if (empty($name) || empty($price) || empty($date) || $uploadOk == 0) {
                $error = "Các trường không được để trống";
                echo "<script>alert('$error');history.back()</script>";
                die();
        }
        move_uploaded_file($_FILES["hinh"]["tmp_name"],$target_file);
    	if ($this->edit->updateProduct($id, $name, $target_file, $price, $date)){
            echo "<script>alert('Sửa sản phẩm thành công !');document.location='index.php'</script>";
        }else{
            echo "<script>alert('Đã có lỗi, vui lòng thử lại!');history.back()</script>";
        }
    }
}
}
// $id = filter_input(INPUT_GET, 'id');
?>
