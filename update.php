<?php
session_start();
include('class/database.php');
class profile extends database
{
    protected $link;

    public function insertProfileInfo()
    {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $city = $_POST['city'];
            $country = $_POST['country'];
            $img = time() . '_' . $_FILES['image']['name'];
            $target = 'user_img/' . $img;

            if ($_FILES['image']['name'] == '') {
                //Update query will update all the data inside user_info table
                $sql = "UPDATE `user_info` SET `phone`= '$phone',`country`='$country',`city`='$city', `updated` = CURRENT_TIMESTAMP WHERE email = '$email'";
            } else {
                $sql = "UPDATE `user_info` SET `phone`= '$phone',`country`='$country',`city`='$city', `image` = '$img', `updated` = CURRENT_TIMESTAMP WHERE email = '$email'";
            }


            $res = mysqli_query($this->link, $sql);
            if ($res) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                echo '<div class="alert alert-success">
                <strong>Successfully Updated!</strong>
            </div>';
            } else {
                echo "Not added";
            }
        }
        # code...
    }
}
$obj = new profile;
$objInsertInfo = $obj->insertProfileInfo();