<?php 
class APIController extends Controller{
	public function actionIndex()
	{
		echo "{'response': 'works'}";
	}
	public function actionSignUpUser(){
		$name = $_POST['name'];
		$number = $_POST['number'];
		$device_id = $_POST['device_id'];
		$model = new usermodel();
		$return_value = $model->createUser($name, $number, $device_id);
		if($return_value){
			echo json_encode(array('user_id'=>$return_value));
		}
		else{
			echo json_encode(array('user_id'=>null));
		}
	}
	
	public function actionsyncContact(){
		$numbers= $_POST['numbers'];
		$my_number = $_POST['my_number'];
		$numbers = explode( ",", $numbers);
		$model = new usermodel();
		$return_value = $model->syncContact($my_number, $numbers);
		echo json_encode($return_value);
	}
	
	public function actionsendMessage(){
		$to  =$_POST['to'];
		$from  =$_POST['from'];
		$msg = $_POST['msg'];
		$model = new usermodel();
		$return_value = $model->sendMessage($to, $from, $msg);
		echo json_encode($return_value);
	}
}