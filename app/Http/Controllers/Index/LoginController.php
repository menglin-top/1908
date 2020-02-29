<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

use App\Member;
//发送邮件
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
	public function login(){
		return view('front.login');
	}
	public function logindo(){
        $post=request()->except('_token');
       // $user['pwd']=$user['pwd'];
    	$admin=Member::where($post)->first();
    	//dd($admin);
    	if($admin){
    		return redirect('/');
    	}
	}

	public function reg(){
		return view('front.reg');
	}

	public function regdo(){
		$post=request()->except('_token');
		$code=session('code');
		//判断验证码
		if($code!=$post['code']){
			return redirect('/reg')->with('msg','您输入的验证码错误');
		}
		//两次密码是否一致
		if($post['pwd']!=$post['repwd']){
			return redirect('/reg')->with('msg','两次密码不一致');
		}
		//入库
		$user=[
			'mobile'=>$post['mobile'],
			'pwd'=>$post['pwd'],
			'add_time'=>time(),
		];
		$res=Member::create($user);

		if($res){
			return redirect('/login');
		}
	}
	//发送邮件
	public function sendEmail(){
		$email='1501113246@qq.com';
		Mail::to($email)->send(new SendCode());
	}
	
    public function ajaxsend(){
    	//接受注册页面的手机号
    	$mobile = request()->mobile;
    	$code = rand(1000,9999);
    	$res = $this->sendSms($mobile,$code);
    	if( $res['Code']=='OK'){
    		session(['code'=>$code]);
    		request()->session()->save();
    		echo json_encode(['code'=>'00000','msg'=>'ok']);die;
    	}
    	   echo json_encode(['code'=>'00001','msg'=>'短信发送失败']);die;
    }

     public function sendSms($moblie,$code){

			AlibabaCloud::accessKeyClient('LTAI4Fk4dFanUwQG69bDzSGn', 'PGE3yaclBRuisZPCfM3SX7R0vkL0VE')
			                        ->regionId('cn-hangzhou')
			                        ->asDefaultClient();

			try {
			    $result = AlibabaCloud::rpc()
			                          ->product('Dysmsapi')
			                          // ->scheme('https') // https | http
			                          ->version('2017-05-25')
			                          ->action('SendSms')
			                          ->method('POST')
			                          ->host('dysmsapi.aliyuncs.com')
			                          ->options([
			                                        'query' => [
			                                          'RegionId' => "cn-hangzhou",
			                                          'PhoneNumbers' => $moblie,
			                                          'SignName' => "风也这样",
			                                          'TemplateCode' => "SMS_178760828",
			                                          'TemplateParam' => "{code:$code}",
			                                        ],
			                                    ])
			                          ->request();
			    return $result->toArray();
			} catch (ClientException $e) {
			    return $e->getErrorMessage();
			} catch (ServerException $e) {
			    return $e->getErrorMessage();
			}
    }

}
