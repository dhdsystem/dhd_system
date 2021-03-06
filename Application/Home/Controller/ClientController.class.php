<?php
namespace Home\Controller;
use Think\Controller;
class ClientController extends Controller {
   /*客户*/
    public function client_index(){
    	$data = M('client as client')
                ->field('client.id,client_name,client_address,legalperson,legaltel,taxstyle,client_money,real_name,username')
                ->join('dhd_user as user on client.sales_id = user.id')
                ->where('client_state=0')
                ->select();
        $list = M('class')
                ->field('id,class_name')
                ->where(array('class_is'=>0))
                ->select();
        foreach($list as $k => $v){
            // echo $v['id'];
            $baed[$v['id']] = M('class as c')
                    ->field('client.id,client_name,client_address,legalperson,legaltel,taxstyle,client_money,real_name,username')
                    ->join('dhd_material as m on c.id = m.class_id')
                    ->join('dhd_material_contract as mc on m.id = mc.m_id')
                    ->join('dhd_contract as con on mc.con_id = con.id')
                    ->join('dhd_client as client on con.client_id = client.id')
                    ->join('dhd_user as user on client.sales_id = user.id')
                    ->where('client_state=0 and c.id='.$v['id'])
                    ->select();
        }
        // print_r($baed);die;
        // print_r($list);die;
        $this->assign('list',$list);
        $this->assign('baed',$baed);
    	$this->assign('volist',$data);
       	$this->display();
    }

    // 客户添加页面
    public function client_add(){
        $mid=I('get.mid');
        if(!empty($mid)){
            $this->assign('mid',$mid);
            $this->display();
        }else{
            $mid=" ";
             $this->assign('mid',$mid);
             $this->display();
        }
        
       
    }

    // 客户添加ajax
    public function clientadd_ajax(){
        $middleman = I('post.middleman');
        $where['middle_name']=array('like',"%$middleman%");
        $data = M('middle')->where($where)->select();
        if($data){
            print_r( json_encode($data));
        }else{
            print_r( json_encode(''));
        }

    }

    // 客户添加方法
    public function clientadd_do(){
        $data = I('post.');
        // print_r($data);die;
    	// var_dump($data);die;
        $data['sales_id'] = get_user_id();
        // echo get_user_id();die;
        // print_r($data);die;
        $add = M('client')->data($data)->add();
        if(!empty($data['mid'])){
            M('reserved')->where(array('id'=>$data['mid']))->save(array('client_id'=>$add));
        }
        if($add){
            $this->success('新增成功', U('client/client_index'));
        }else{
            $this->error('新增失败',U('client/client_add'));
        }
    }

    // 客户删除
    public function client_del(){
    	$id = I('get.id');
    	// var_dump($id);die;
        $data['client_state'] = '1';
        $del = M('client')->where("id=$id")->save($data); 
        if($del){
            $this->success('删除成功', U('Client/client_index'));
        }else{
            $this->error('删除失败',U('Client/client_index'));
        }

    }

    // 客户修改页面
    public function client_save(){
        $id = I('get.id');
        $data = M('client as c')
                ->join('dhd_middle as m on c.nuddke_id = m.id')
                ->where('c.id='.$id)
                ->find();
        if(empty($data['nuddke_id'])){
            $data = M('client')->where("id=$id")->find();
            $data['customtype'] = '直接客户';
        }
        // print_r($data);die;
        $this->assign('list',$data);
        $this->display();
    }

    // 客户修改方法
    public function clientsave_do(){
        $data = I('post.');
        // print_r($data);die;
        $save = M('client')->where(array('id'=>$data['id']))->save($data);
        if($save){
            $this->success('修改成功', U('Client/client_index'));
        }else{
            $this->error('修改失败',U('Client/client_save?id='.$data['id']));
        }

        
    }

    /**
     * /
     * @return [type] [搜索分类下产品]
     */
    public function reserved_prod()
    {
        $class_id = I('post.class_id');
        $list = M('product')->where(array('class_id'=>$class_id,'pro_del'=>1))->select();
        returnajax($list);
    }
    /**
     * /
     * @return [type] [返回已预出地址号中第一个]
     */
    public function reserved_det()
    {
        $prod_id = I('post.prod_id');
        $list = M('details')->field('id,detailscoll')->where(array('det_advance'=>1,'pro_id'=>$prod_id,'det_del'=>0))->order('id')->find();
        // echo M('details')->GetLastSql();
        returnajax($list);
    }
    /**
     * /
     * @return [type] [description]
     */
    public function reserved_add()
    {
        // print_r(I('post.'));die;
        $data['client_id'] = I('post.client_id');
        $data['details_id'] = I('post.det_id');
        $data['res_state'] = 1;
        $data['add_time'] = time();

        $res = M('reserved')->add($data);
        if($res){
            $re = M('details')->where(array('id'=>$data['details_id']))->setField('det_advance',3);
            if($re){
                $this->success('预留成功', U('Client/client_index'));
            }else{
                $this->success('预留失败',U('Client/client_index'));
            }
            
        }else{
            $this->success('预留失败',U('Client/client_index'));
        }
    }
}