<?php

namespace App\Http\Controllers\admin;

use App\Model\Midd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        return view('admin/index');
    }
    public function addbanner(){
        return view('admin/addbanner');
    }
    public function showbanner(){
        $data=DB::table('banner')->paginate(3);
        return view('admin/banner',['data'=>$data]);
    }
    public function banneradd(Request $request){
        $data=$request->all();
        $arr=[];
        $arr['name']=$data['name'];
        $arr['url']=$data['url'];
        $arr['hidden']=$data['hidden'];
        $arr['sorts']=$data['sorts'];
        $arr['createtime']=time();
        $res=DB::table('banner')->insert($arr);
        $returndata=[];
        if($res){
            $returndata['success']=true;
            $returndata['url']='/banner';
            $returndata['msg']='';
            echo json_encode($returndata);
        }else{
            $returndata['success']=false;
            $returndata['url']='';
            $returndata['msg']='系统故障';
            echo json_encode($returndata);
        }
    }
    public function updatebanner(Request $request){
        $id=$request->id;
        $data=DB::table('banner')->where(['id'=>$id])->first();
        return view('admin/updatebanner',['data'=>$data]);
    }
    public function update(Request $request){
        $data=$request->all();
        $arr=[];
        $arr['name']=$data['name'];
        $arr['url']=$data['url'];
        $arr['hidden']=$data['hidden'];
        $arr['sorts']=$data['sorts'];
        $arr['createtime']=time();
        $res=DB::table('banner')->where(['id'=>$data['id']])->update($arr);
        $returndata=[];
        if($res){
            $returndata['success']=true;
            $returndata['url']='/banner';
            $returndata['msg']='';
            echo json_encode($returndata);
        }else{
            $returndata['success']=false;
            $returndata['url']='';
            $returndata['msg']='请重试';
            echo json_encode($returndata);
        }
    }
    public function delete(Request $request){
        $id=$request->Id;
        $res=DB::table('banner')->where('id',$id)->delete();
        $returndata=[];
        if($res){
            $returndata['success']=true;
            $returndata['url']='/banner';
            $returndata['msg']='';
            echo json_encode($returndata);
        }else{
            $returndata['success']=false;
            $returndata['url']='';
            $returndata['msg']='请重试';
            echo json_encode($returndata);
        }
    }
    public function changeValue(Request $request){
        $data=$request->all();
        $value=$data['value'];
        $filed=$data['filed'];
        $id=$data['id'];
        $returndata=[];
        $res=DB::table('banner')->where(['id'=>$id])->update([$filed=>$value]);
        if($res){
            $returndata['code']=1;
            $returndata['msg']='';
            echo json_encode($returndata);
        }else{
            $returndata['code']=2;
            $returndata['msg']='请重试';
            echo json_encode($returndata);
        }
    }
    //文件上传
    public function upload(){
        return view('admin/upload');
    }
    public function uploadadd(Request $request){
        $fileinfo=$_FILES['Filedata'];
        $tmp_name=$fileinfo['tmp_name'];//上传文件的临时名
        $ext=explode(".",$fileinfo['name'])[1];//文件扩展名
        $filename=md5(uniqid()).'.'.$ext;//文件名
        $filepath="./uploads".Date('/Y/m/d/',time());//上传路径
        if(!is_dir($filepath)){
            mkdir($filepath,0777,true);
        }
        $newpath=$filepath.$filename;
        move_uploaded_file($tmp_name,$newpath);
        $newpath=ltrim($newpath,'.');
        echo $newpath;
    }



    //分类管理
    public  function sortadd(Request $request){
        return view("admin/sortadd");
    }
    public function classifyadd(Request $request){
        $arr=$request->all();
        $sort=$arr['sort'];
        $hidden=$arr['hidden'];



        //数据入库
        $sort_model=new Midd();

        $sort_model->sort=$sort;

        $sort_model->hidden=$hidden;

        $sort_model->time=time();

        //保存用户信息给出错误提示
        if($sort_model->save()){
            return $this->ajaxData(000001,'成功');
        }else{
            return $this->ajaxData(000003,'失败');
        }
    }

    public function reveal(Request $request){
        $Sort_model=new Midd();
        $arr=$Sort_model->where(['is_del'=>1])->paginate(2);

        return view("admin/reveal",['data'=>$arr]);
    }
    public  function  deldo(Request $request){
        $arr=$request->all();
        $id=$arr['id'];
        $sort_model=new Midd();
        $sutoff=  $sort_model->where(['id'=>$id])->update(["is_del"=>2]);
        if($sutoff){
            return $this->ajaxData(000005,'成功');
        }else{
            return $this->ajaxData(000004,'失败');
        }
    }

    public function alter(Request $request){

        $arr=$request->all();
        $id=$arr['sort_id'];
        $sort_model=new Midd();
        $sortInfo=$sort_model->find($id);

        return view("admin/alter",['sortInfo'=>$sortInfo]);
    }
    public function updata(Request $request){
        $arr=$request->all();
        $id=$arr['id'];
        $checkedx=$arr['checkedx'];
        $sort=$arr['sort'];
        $sort_model=new Midd();
        $res=  $sort_model->where('id',$id)->update(['hidden'=>$checkedx,'sort'=>$sort]);
        if($res){
            return $this->ajaxData(0005,'成功');
        }else{
            return $this->ajaxData(0004,'失败');
        }
    }

    public function ajaxData($status=1,$msg='fali',$data=[]){
        return[
            'code' => $status,
            'massage' => $msg,
            'result' => $data
        ];
    }
}
