<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    public $Main;

    public function __construct() {
        parent::__construct(); 
        $this->load->model('usermodel');

        $this->Main = new Usermodel;
    }
	public function index()
	{
        // header("Content-type: application/json");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "POST"){
            $command = $_POST['command'];
            if($command == "show"){
                $id = $_POST['data']['id'];
                $user = $this->usermodel->find_user($id);
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($user));
            }else if($command == "list"){
                $page = $_POST['data']['page'];
                $users = $this->usermodel->get_user($page);
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($users));
            }else if($command == "create"){
                $data = $_POST['data'];
                $arr = array(
                    'email'         => $data['email'],
                    'pwd'           => $data['pwd'],
                    'name'          => $data['name'],
                    'phone'         => $data['phone'],
                    'recommender'   => $data['recommender']
                );
                $result = $this->usermodel->insert_user($arr);
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('success'=>$result)));
            }else if($command == "update"){
                $data = $_POST['data'];
                $id = $data['id'];
                $arr = array(
                    'email'         => $data['email'],
                    'pwd'           => $data['pwd'],
                    'name'          => $data['name'],
                    'phone'         => $data['phone']
                );
                $result = $this->usermodel->update_user($id, $arr);
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('success'=>$result)));
            }else if($command == "delete"){
                $id = $_POST['data']['id'];
                if($this->usermodel->find_user($id) != null){
                    $this->usermodel->delete_user($id);
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('success'=>true)));
                }else{
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('success'=>false)));
                }
            }
        }else{
            echo '에러';
        }
    }
}

// // ---- 유저확인 ----
// var id = 1
// var json = {'command':'show',data:{'id':id}}
// var send = {
//     type:'POST',
//     url:'http://localhost/userapi/index.php/main',
//     data:json,
//     success:function(data,status,xhr){
//         console.log(data);
//     },
//     error:function(jqXHR, textStatus, errorThrown){
//         console.log(jqXHR.responseText);
//     }
// }
// $.ajax(send)

// // ---- 유저목록 ----
// var page = 1
// var json = {'command':'list',data:{'page':page}}
// var send = {
//     type:'POST',
//     url:'http://localhost/userapi/index.php/main',
//     data:json,
//     success:function(data,status,xhr){
//         console.log(data);
//     },
//     error:function(jqXHR, textStatus, errorThrown){
//         console.log(jqXHR.responseText);
//     }
// }
// $.ajax(send)

// // ---- 회원가입 ----
// var email = '1414@1414.14'
// var pwd = '1414'
// var name = 'fourteen'
// var phone = '010-1414-1414'
// var recommender = null
// var json = {
//     'command':'create',
//     data:{
//         'email': email,
//         'pwd': pwd,
//         'name': name,
//         'phone': phone,
//         'recommender': recommender
//     }
// }
// var send = {
//     type:'POST',
//     url:'http://localhost/userapi/index.php/main',
//     data:json,
//     success:function(data,status,xhr){
//         console.log(data);
//     },
//     error:function(jqXHR, textStatus, errorThrown){
//         console.log(jqXHR.responseText);
//     }
// }
// $.ajax(send)

// // ---- 업데이트 ----
// var email = null
// var pwd = null
// var name = 'one'
// var phone = null
// var json = {
//     'command':'update',
//     data:{'id': '1',
//         'email': email,
//         'pwd': pwd,
//         'name': name,
//         'phone': phone
//     }
// }
// var send = {
//     type:'POST',
//     url:'http://localhost/userapi/index.php/main',
//     data:json,
//     success:function(data,status,xhr){
//         console.log(data);
//     },
//     error:function(jqXHR, textStatus, errorThrown){
//         console.log(jqXHR.responseText);
//     }
// }
// $.ajax(send)

// // ---- 유저삭제 ----
// var id = 1
// var json = {'command':'delete',data:{'id':id}}
// var send = {
//     type:'POST',
//     url:'http://localhost/userapi/index.php/main',
//     data:json,
//     success:function(data,status,xhr){
//         console.log(data);
//     },
//     error:function(jqXHR, textStatus, errorThrown){
//         console.log(jqXHR.responseText);
//     }
// }
// $.ajax(send)