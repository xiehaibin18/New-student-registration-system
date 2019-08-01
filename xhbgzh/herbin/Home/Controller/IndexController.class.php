<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    //登录
public function Login(){
    $this->display();
}
//登出
public function Logout(){
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    $this->success('注销成功','Login',5);
}
public function DataShow(){
    //
    layout(true);
    //登录信息
    //session_start();
    $username=$_POST['username'];
    $password=$_POST['password'];
    $_SESSION["username"]=$username;
    $_SESSION["password"]=$password;
    $a=$_SESSION["username"];
    $b=$_SESSION["password"];
    $code=I('post.check');
    $verify = new \Think\Verify();
    $res=$verify->check($code);
    $_SESSION["table"] = $_POST['table'];
    $table = $_SESSION["table"];
    $updatatable = $_GET["table"];
    //验证登录
    $c=M('admin');
    $data = $c->query("select * from gzh_admin WHERE username='$a' AND password='$b'");
    if ($updatatable) {
        $m = M($updatatable);
        //分页
        $count = $m->count(); 
        $Page = new \Org\Xhb\Page($count,10);
        $Page -> setConfig('header','');
        $show = $Page->show();
        $pagename = $updatatable.'page';
        //DataShow
        $list=$m->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign($updatatable,$list);
        $this->assign($pagename,$show);
        $this->display();
    }else{
    if($table){
        // //排序条件
        // $_SESSION["order"] = $_POST['order'];
        // $role = $_SESSION["order"];
        // //模糊查询条件
        // $vale = $_POST['found'];
        // $text = $_POST['foundtext'];
        // $w[$vale] = array('LIKE','%'.$text.'%');
        //实例化
        $m = M($table);
        //分页
        $count = $m->count(); 
        $Page = new \Org\Xhb\Page($count,10);
        $Page -> setConfig('header','');
        $show = $Page->show();
        $pagename = $table.'page';
        //DataShow
        $list=$m->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign($table,$list);
        $this->assign($pagename,$show);
        $this->display();
    }else{
        if($data && $res){
        //实例化
            $m = M('info');
        //分页
            $count = $m->count(); 
            $Page = new \Org\Xhb\Page($count,10);
            $Page -> setConfig('header','');
            $show = $Page->show();
            $pagename = $table.'page';
        //DataShow
            $list=$m->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('info',$list);
            $this->assign($pagename,$show);
            $this->display();
        }else{
            $this->error('登录验证：“'.$data.'”验证码验证：“'.$res.'”其他内容：'.$table,'Login',60);
        }
    }
    }

}

public function _before_del(){
    if(!isset($_SESSION["username"])&&!isset($_SESSION["table"])){
        redirect('Login');
    }
}

public function del(){
    $info = $_GET['info'];
    $login = $_GET['login'];
    $selfhelp = $_GET['selfhelp'];
    if ($info) {
         $m=M('info');
         $c=$m->where("id_card='$info'")->delete();
         if($c){
            $this->success('Success','DataShow',5);
        }else{
            $this->error('Fail','DataShow',3);
        }
    }
    if ($login) {
         $m=M('login');
         $c=$m->where("id_card='$login'")->delete();
         if($c){
            $this->success('Success','DataShow',5);
        }else{
            $this->error('Fail','DataShow',3);
        }
    }
    if ($selfhelp) {
         $m=M('selfhelp');
         $c=$m->where("id_card='$selfhelp'")->delete();
         if($c){
            $this->success('Success','DataShow',5);
        }else{
            $this->error('Fail','DataShow',3);
        }
    }

}

public function DataUpdate(){
        $info = $_GET['info'];
        $login = $_GET['login'];
        $selfhelp = $_GET['selfhelp'];
        if ($info) {
            $m=M('info');
            $list=$m->query("SELECT * FROM gzh_info WHERE (id_card='$info')");
            $this->assign('infodataupdate',$list);
            $this->display();
        }
        if ($login) {
             $m=M('login');
            $list=$m->query("SELECT * FROM gzh_login WHERE (id_card='$login')");
            $this->assign('logindataupdate',$list);
            $this->display();
        }
        if ($selfhelp) {
             $m=M('selfhelp');
            $list=$m->query("SELECT * FROM gzh_selfhelp WHERE (id_card='$selfhelp')");
            $this->assign('selfhelpdataupdate',$list);
            $this->display();
        }
}

public function info_update(){
    $m=M('info');
    $info_openid =$_POST['info_openid'];
    $info_id_card =$_POST['info_id_card'];
    $info_adm_time =$_POST['info_adm_time'];
    $info_dep_number =$_POST['info_dep_number'];
    $info_maj_number =$_POST['info_maj_number'];
    $info_stu_number =$_POST['info_stu_number'];
    $info_stu_name =$_POST['info_stu_name'];
    $info_stu_sex =$_POST['info_stu_sex'];
    $info_stu_class =$_POST['info_stu_class'];
    $info_stu_dep =$_POST['info_stu_dep'];
    $info_stu_maj =$_POST['info_stu_maj'];
    $info_stu_room =$_POST['info_stu_room'];
    $info_apl_status =$_POST['info_apl_status'];
    $table =$_POST['table'];
    $m->execute("UPDATE gzh_info SET id_card='$info_id_card' WHERE id_card='$info_id_card'");
    $m->execute("UPDATE gzh_info SET openid='$info_openid' WHERE id_card='$info_id_card'");
    $m->execute("UPDATE gzh_info SET adm_time='$info_adm_time' WHERE id_card='$info_id_card'");
    $m->execute("UPDATE gzh_info SET dep_number='$info_dep_number' WHERE id_card='$info_id_card'");
    $m->execute("UPDATE gzh_info SET maj_number='$info_maj_number' WHERE id_card='$info_id_card'");
    $m->execute("UPDATE gzh_info SET stu_number='$info_stu_number' WHERE id_card='$info_id_card'");
    $m->execute("UPDATE gzh_info SET stu_sex='$info_stu_sex' WHERE id_card='$info_id_card'");
    $m->execute("UPDATE gzh_info SET stu_class='$info_stu_class' WHERE id_card='$info_id_card'");
    $m->execute("UPDATE gzh_info SET stu_dep='$info_stu_dep' WHERE id_card='$info_id_card'");
    $m->execute("UPDATE gzh_info SET stu_maj='$info_stu_maj' WHERE id_card='$info_id_card'");
    $m->execute("UPDATE gzh_info SET stu_room='$info_stu_room' WHERE id_card='$info_id_card'");
    $m->execute("UPDATE gzh_info SET apl_status='$info_apl_status' WHERE id_card='$info_id_card'");
    redirect('http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/DataShow.html?table='.$table);
}
public function login_update(){
    $m=M('login');
    $login_openid =$_POST['login_openid'];
    $login_id_card =$_POST['login_id_card'];
    $table =$_POST['table'];
    $m->execute("UPDATE gzh_login SET id_card='$login_id_card' WHERE id_card='$login_id_card'");
    $m->execute("UPDATE gzh_login SET openid='$login_openid' WHERE id_card='$login_id_card'");
    redirect('http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/DataShow.html?table='.$table);
}
public function selfhelp_update(){
    $m=M('selfhelp');
    $selfhelp_openid =$_POST['selfhelp_openid'];
    $selfhelp_id_card =$_POST['selfhelp_id_card'];
    $selfhelp_tuition_status =$_POST['selfhelp_tuition_status'];
    $selfhelp_tuition_sum =$_POST['selfhelp_tuition_sum'];
    $selfhelp_stucard_handle =$_POST['selfhelp_stucard_handle'];
    $selfhelp_stucard_status =$_POST['selfhelp_stucard_status'];
    $selfhelp_stucard_sum =$_POST['selfhelp_stucard_sum'];
    $selfhelp_junfu_status =$_POST['selfhelp_junfu_status'];
    $selfhelp_junfu_size =$_POST['selfhelp_junfu_size'];
    $selfhelp_junxie_size =$_POST['selfhelp_junxie_size'];
    $table =$_POST['table'];
    $m->execute("UPDATE gzh_selfhelp SET id_card='$selfhelp_id_card' WHERE id_card='$selfhelp_id_card'");
    $m->execute("UPDATE gzh_selfhelp SET openid='$selfhelp_openid' WHERE id_card='$selfhelp_id_card'");
    $m->execute("UPDATE gzh_selfhelp SET tuition_status='$selfhelp_tuition_status' WHERE id_card='$selfhelp_id_card'");
    $m->execute("UPDATE gzh_selfhelp SET tuition_sum='$selfhelp_tuition_sum' WHERE id_card='$selfhelp_id_card'");
    $m->execute("UPDATE gzh_selfhelp SET stucard_handle='$selfhelp_stucard_handle' WHERE id_card='$selfhelp_id_card'");
    $m->execute("UPDATE gzh_selfhelp SET stucard_status='$selfhelp_stucard_status' WHERE id_card='$selfhelp_id_card'");
    $m->execute("UPDATE gzh_selfhelp SET stucard_sum='$selfhelp_stucard_sum' WHERE id_card='$selfhelp_id_card'");
    $m->execute("UPDATE gzh_selfhelp SET junfu_status='$selfhelp_junfu_status' WHERE id_card='$selfhelp_id_card'");
    $m->execute("UPDATE gzh_selfhelp SET junfu_size='$selfhelp_junfu_size' WHERE id_card='$selfhelp_id_card'");
    $m->execute("UPDATE gzh_selfhelp SET junxie_size='$selfhelp_junxie_size' WHERE id_card='$selfhelp_id_card'");
    redirect('http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/DataShow.html?table='.$table);
}

public function verify(){
    $config = [
        'fontSize' => 15, // 验证码字体大小
        'length' => 4, // 验证码位数
        'imageH' => 0,  //验证码高度，0为自动
        'imageW' => 0,
        'useNoise'    =>    false, // 关闭验证码杂点
    ];
    $Verify = new \Think\Verify($config);
    $Verify->entry();
}



//chk_loginopenid
public function chk_loginopenid()
{
    $getopenid=$_GET['openid'];
    $b=M('login');
    $chkoi = $b->query("select * from gzh_login WHERE openid='$getopenid'");
    if ($chkoi) {
        $this->error('你的微信号已经被绑定了', 'close', 5);
    }else{
        redirect('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxbcfa6f6a2b9e8c58&redirect_uri=http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/StuLogin&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect');
    }
}
//chk_getinfoopenid
public function chk_getinfoopenid()
{
    $getopenid=$_GET['openid'];
    $b=M('info');
    $chkoi = $b->query("select * from gzh_info WHERE openid='$getopenid'");
    if ($chkoi) {
        redirect('http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/StuGetinfo?getinfodata='.$chkoi[0]['stu_name'].','.$chkoi[0]['stu_sex'].','.$chkoi[0]['stu_dep'].','.$chkoi[0]['stu_maj'].','.$getopenid.','.$chkoi[0]['apl_status']);
    }else{
        $this->error('请先登录', 'ChkLoginOpenid', 5);
    }
}
//chk_tuitionopenid
public function chk_tuitionopenid()
{
    $getopenid=$_GET['openid'];
    $b=M('info');
    $chkoi = $b->query("select * from gzh_selfhelp WHERE openid='$getopenid'");
    if ($chkoi) {
        //var_dump($chkoi[0]['tuition_sum']);
        redirect('http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/StuTuition?tuition_sum='.$chkoi[0]['tuition_sum'].','.$chkoi[0]['tuition_status'].','.$getopenid);
    }else{
        $this->error('请先登录', 'ChkLoginOpenid', 5);
    }
}
//chk_stucardopenid
public function chk_stucardopenid()
{
    $getopenid=$_GET['openid'];
    $b=M('info');
    $chkoi = $b->query("select * from gzh_selfhelp WHERE openid='$getopenid'");
    if ($chkoi) {
        if ($chkoi[0]['tuition_status'] == "false") {
            $this->error('请先缴费', 'http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/StuTuition?tuition_sum='.$chkoi[0]['tuition_sum'].','.$chkoi[0]['tuition_status'].','.$getopenid, 5);
        }
        //var_dump($chkoi[0]['tuition_sum']);
        redirect('http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/StuCard?stucard_data='.$chkoi[0]['stucard_handle'].','.$chkoi[0]['stucard_status'].','.$chkoi[0]['stucard_sum'].','.$getopenid);
    }else{
        $this->error('请先登录', 'ChkLoginOpenid', 5);
    }
}
//chk_junfuopenid
public function chk_junfuopenid()
{
    $getopenid=$_GET['openid'];
    $b=M('selfhelp');
    $chkoi = $b->query("select * from gzh_selfhelp WHERE openid='$getopenid'");
    if ($chkoi) {
        if ($chkoi[0]['tuition_status'] == "false") {
            $this->error('请先缴费', 'http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/StuTuition?tuition_sum='.$chkoi[0]['tuition_sum'].','.$chkoi[0]['tuition_status'].','.$getopenid, 5);
        }
        //var_dump($chkoi[0]['tuition_sum']);
        redirect('http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/Junfu?junfu_data='.$chkoi[0]['junfu_status'].','.$chkoi[0]['junfu_size'].','.$chkoi[0]['junxie_size'].','.$getopenid);
    }else{
        $this->error('请先登录', 'ChkLoginOpenid', 5);
    }
}
//chk_sturoomopenid
public function chk_sturoomopenid()
{
    $getopenid=$_GET['openid'];
    $b=M('info');
    $chkoi = $b->query("select * from gzh_info WHERE openid='$getopenid'");
    if ($chkoi) {
        if ($chkoi[0]['tuition_status'] == "false") {
            $this->error('请先缴费', 'http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/StuTuition?tuition_sum='.$chkoi[0]['tuition_sum'].','.$chkoi[0]['tuition_status'].','.$getopenid, 5);
        }
        //var_dump($chkoi[0]['tuition_sum']);
        redirect('http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/StuRoom?sturoom_data='.$chkoi[0]['stu_room'].','.$getopenid);
    }else{
        $this->error('请先登录', 'ChkLoginOpenid', 5);
    }
}
//chk_getstuallopenid
public function chk_getstuallopenid()
{
    $getopenid=$_GET['openid'];
    $b=M();
    $chkoi = $b->query("select * from gzh_info WHERE openid='$getopenid'");
    $selfhelp = $b->query("select * from gzh_selfhelp WHERE openid='$getopenid'");
    if ($chkoi) {
        if ($chkoi[0]['stu_sex'] == "1") {
            if((int)$chkoi[0]['stu_number'] < 10){
            $chkoi = array('0' => array('stu_number' => '00'.$chkoi[0]['stu_number'],
                                        'openid' => $chkoi[0]['openid'],
                                        'id_card' => $chkoi[0]['id_card'],
                                        'adm_time' => $chkoi[0]['adm_time'],
                                        'dep_number' => $chkoi[0]['dep_number'],
                                        'maj_number' => $chkoi[0]['maj_number'],
                                        'stu_name' => $chkoi[0]['stu_name'],
                                        'stu_sex' => '男',
                                        'stu_class' => $chkoi[0]['stu_class'].'班',
                                        'stu_dep' => $chkoi[0]['stu_dep'],
                                        'stu_maj' => $chkoi[0]['stu_maj'],
                                        'stu_room' => $chkoi[0]['stu_room'],
                                        'apl_status' => $chkoi[0]['apl_status']));
            }
            if((int)$chkoi[0]['stu_number'] < 100 && (int)$chkoi[0]['stu_number'] > 9){
            $chkoi = array('0' => array('stu_number' => '0'.$chkoi[0]['stu_number'],
                                        'openid' => $chkoi[0]['openid'],
                                        'id_card' => $chkoi[0]['id_card'],
                                        'adm_time' => $chkoi[0]['adm_time'],
                                        'dep_number' => $chkoi[0]['dep_number'],
                                        'maj_number' => $chkoi[0]['maj_number'],
                                        'stu_name' => $chkoi[0]['stu_name'],
                                        'stu_sex' => '男',
                                        'stu_class' => $chkoi[0]['stu_class'].'班',
                                        'stu_dep' => $chkoi[0]['stu_dep'],
                                        'stu_maj' => $chkoi[0]['stu_maj'],
                                        'stu_room' => $chkoi[0]['stu_room'],
                                        'apl_status' => $chkoi[0]['apl_status']));
            }
        }
        if ($chkoi[0]['stu_sex'] == "2") {
            if((int)$chkoi[0]['stu_number'] < 10){
            $chkoi = array('0' => array('stu_number' => '00'.$chkoi[0]['stu_number'],
                                        'openid' => $chkoi[0]['openid'],
                                        'id_card' => $chkoi[0]['id_card'],
                                        'adm_time' => $chkoi[0]['adm_time'],
                                        'dep_number' => $chkoi[0]['dep_number'],
                                        'maj_number' => $chkoi[0]['maj_number'],
                                        'stu_name' => $chkoi[0]['stu_name'],
                                        'stu_sex' => '女',
                                        'stu_class' => $chkoi[0]['stu_class'].'班',
                                        'stu_dep' => $chkoi[0]['stu_dep'],
                                        'stu_maj' => $chkoi[0]['stu_maj'],
                                        'stu_room' => $chkoi[0]['stu_room'],
                                        'apl_status' => $chkoi[0]['apl_status']));
            }
            if((int)$chkoi[0]['stu_number'] < 100 && (int)$chkoi[0]['stu_number'] > 9){
            $chkoi = array('0' => array('stu_number' => '0'.$chkoi[0]['stu_number'],
                                        'openid' => $chkoi[0]['openid'],
                                        'id_card' => $chkoi[0]['id_card'],
                                        'adm_time' => $chkoi[0]['adm_time'],
                                        'dep_number' => $chkoi[0]['dep_number'],
                                        'maj_number' => $chkoi[0]['maj_number'],
                                        'stu_name' => $chkoi[0]['stu_name'],
                                        'stu_sex' => '女',
                                        'stu_class' => $chkoi[0]['stu_class'].'班',
                                        'stu_dep' => $chkoi[0]['stu_dep'],
                                        'stu_maj' => $chkoi[0]['stu_maj'],
                                        'stu_room' => $chkoi[0]['stu_room'],
                                        'apl_status' => $chkoi[0]['apl_status']));
            }
        }
        $this->assign("info",$chkoi);
        $this->assign("selfhelp",$selfhelp);
        $this->display('StuAll');
    }else{
        $this->error('请先登录', 'ChkLoginOpenid', 5);
    }
}

//stu_login
public function stu_login()
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $openid=$_POST['openid'];
    
        if (substr($username,-6) == $password) {
            //验证登录
            $c=M('login');
            $chkic = $c->query("select * from gzh_login WHERE id_card='$username'");
            if ($chkic) {
                //将openid写入login表
                $m=M('login');
                $m->execute("UPDATE gzh_login SET openid='$openid' WHERE id_card='$username'");
                //将openid、id_card写入info表
                $n=M('info');
                $n->execute("INSERT INTO gzh_info (openid, id_card) VALUES ('$openid', '$username')");
                //将openid、id_card写入selfhelp表
                $l=M('selfhelp');
                $l->execute("INSERT INTO gzh_selfhelp (openid, id_card) VALUES ('$openid', '$username')");
                $this->success('登录成功', 'close', 5);
            }elseif (!$chkic) {
                //你不是本校学生
                $this->error('你不是本校学生', 'close', 5);
            }
        }else{
            $this->error('账号密码错误', 'close', 5);
        }
}
//stu_getinfo
public function stu_getinfo()
{
    $stu_name=$_POST['stu_name'];
    $stu_sex=$_POST['stu_sex'];
    $stu_dep=$_POST['stu_dep'];
    $stu_maj=$_POST['stu_maj'];
    $openid=$_POST['openid'];
    //
    if ($stu_dep == '软件系') {
        if ($stu_maj == '信息工程专业') {
            //实例化
            $n=M('info');
            //写入
            $n->execute("UPDATE gzh_info SET dep_number='40' WHERE openid = '$openid'");
            $n->execute("UPDATE gzh_info SET maj_number='128' WHERE openid = '$openid'");
            $n->execute("UPDATE gzh_info SET stu_name='$stu_name' WHERE openid = '$openid'");
            $n->execute("UPDATE gzh_info SET stu_sex='$stu_sex' WHERE openid = '$openid'");
            $n->execute("UPDATE gzh_info SET stu_dep='$stu_dep' WHERE openid = '$openid'");
            $n->execute("UPDATE gzh_info SET stu_maj='$stu_maj' WHERE openid = '$openid'");
            (int)$stu_number = $n->query("SELECT stu_number FROM gzh_info WHERE openid='$openid'");
            if ((int)$stu_number > 0 && (int)$stu_number < 51) {
                $n->execute("UPDATE gzh_info SET stu_class='1' WHERE openid = '$openid'");
            }elseif ((int)$stu_number > 50 && (int)$stu_number < 101) {
                $n->execute("UPDATE gzh_info SET stu_class='2' WHERE openid = '$openid'");
            }
            $this->success('提交成功，在“自助报道”菜单中的“打印报告单”中可查看详细的个人信息及资料审核状态', 'close', 60);
        }
    }
}
//stu_tuition
public function stu_tuition()
{
    $this->error('已缴费，请勿重复缴费', 'close', 5);
}
//stu_card
public function stu_card()
{
    $this->error('已开通，请勿重复申请二维码，如若遗失请挂失后重试', 'close', 5);
}
//stu_junfu
public function stu_junfu()
{
    $junfu_status=$_POST['junfu_status'];
    $junxie_size=$_POST['junxie_size'];
    $junfu_size=$_POST['junfu_size'];
    $openid=$_POST['openid'];
    //
    if ($junfu_status == '尚未领取') {
        $n=M('selfhelp');
        //写入
        $n->execute("UPDATE gzh_selfhelp SET junxie_size='$junxie_size' WHERE openid = '$openid'");
        $n->execute("UPDATE gzh_selfhelp SET junfu_size='$junfu_size' WHERE openid = '$openid'");
        $this->success('提交成功，重新打开此页面获取二维码到军服领取点（东门广场）出示二维码领取军服', 'close', 60);
    }
}
//stu_room
public function stu_room()
{
    $stu_room=$_POST['stu_room'];
    $openid=$_POST['openid'];
    //
    $n=M('info');
    $chkroom = $n->query("SELECT COUNT(stu_room) FROM gzh_info");
    if ((int)$chkroom[0]["count(stu_room)"] < 5) {
       //写入
        $n->execute("UPDATE gzh_info SET stu_room='$stu_room' WHERE openid = '$openid'");
        $this->success('提交成功，在“自助报道”菜单中的“打印报告单”中可查看详细的个人信息及资料审核状态', 'close', 10);
    }else{
        $this->error('宿舍已满请重新选择', 'http://2.xhbgzh.applinzi.com/xhbgzh/index.php/Home/Index/StuRoom?sturoom_data='.$chkoi[0]['stu_room'].','.$getopenid, 10);
    }   
}
//stu_all
public function stu_all()
{
    $openid=$_POST['openid'];
    //
    $n=M('info');
    $chkoi = $n->query("SELECT * FROM gzh_info WHERE openid = '$openid'");
    if ($chkoi) {
       //写入
        $n->execute("UPDATE gzh_info SET apl_status='false' WHERE openid = '$openid'");
        $this->success('提交成功，您可以重新在个人信息绑定处修改个人信息', 'close', 10);
    } 
}

}