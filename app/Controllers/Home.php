<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{	
		$user = $this->UserModel->findAll();
		return view('index');
	}

	public function post(){
		$csrf_test_name = strip_tags(htmlspecialchars($this->request->GetPost("csrf_test_name")));
		$name = strip_tags(htmlspecialchars($this->request->GetPost("name")));
		$email = strip_tags(htmlspecialchars($this->request->GetPost("email")));
		$phone = strip_tags(htmlspecialchars($this->request->GetPost("phone")));
		$lat = strip_tags(htmlspecialchars($this->request->GetPost("lat")));
		$longt = strip_tags(htmlspecialchars($this->request->GetPost("longt")));

		/*cek if email is exist*/
		$cek_email = $this->UserModel->where(["email" => $email])->first();
		if(is_null($cek_email)){
			/*Insert User*/
			$id_user = $this->UserModel->insert([
				"name" => $name,
				"email" => $email,
				"phone" => $phone,
			]);
			/*Insert Checkin*/
			$save = $this->CheckinModel->save([
				"id_user" => $id_user,
				"lat" => $lat,
				"longt" => $longt
			]);
			$newdata = [
				"email" => $email,
				"name" => $name,
				"phone" => $phone,
			];
			session()->set($newdata);
		}else{
			$id_user = $cek_email['id_user'];
			/*Insert Checkin*/
			$save = $this->CheckinModel->save([
				"id_user" => $id_user,
				"lat" => $lat,
				"longt" => $longt
			]);
			$newdata = [
				"email" => $email,
				"name" => $name,
				"phone" => $phone,
			];
			session()->set($newdata);
		}
		session()->setFlashData('pesan', 'Data Berhasil di simpan');

		echo json_encode(array("code"=>200));
	}

	//--------------------------------------------------------------------

}
