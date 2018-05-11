<?php
namespace Home\Controller;
use Think\Controller;
class ChannelController extends Controller {
 /*渠道商*/
    public function channel_index(){
      $data = M('middle as m')
            ->field('m.id,middle_name,middle_man,middle_tel,middle_address,real_name')
            ->join('dhd_user as u on u.id = m.sales_id')
            ->where('middle_is=0')
            ->select();
             // print_r($data);die;
      foreach ($data as $k => $v) {
       
        $sql = M('middle as m')
            ->join('dhd_client as c on m.id = c.nuddke_id')
            ->join('dhd_contract as co on c.id = co.client_id')
            ->where('m.id='.$v['id'])
            ->count();
            // print_r($sql);die;
        if($sql=='0'){
          // 成单总量
          $data[$k]['cd'] = '0';
          // 新签量
          $data[$k]['xq'] = '0';
          // 再租户数
          $data[$k]['zz'] = '0';
          // 停租户数
          $data[$k]['tz'] = '0';
        }else{
          $tsql = M('middle as m')
              ->join('dhd_client as c on m.id = c.nuddke_id')
              ->join('dhd_contract as co on c.id = co.client_id')
              ->where('m.id='.$v['id'])
              ->select();
            // print_r($tsql);die;
          $a = 0; $b = 0; $c = 0; $d = 0;
          foreach($tsql as $kk => $vv){
              
            if($vv['account_audit']=='4'){
              // 成单总量
              $data[$k]['cd']= $a++;
              $data[$k]['tz']= $d;
            }elseif($vv['account_audit']=='6'){
              //停租
              $data[$k]['tz'] = $d++;
              $data[$k]['cd']= $a;
            }else{
              $data[$k]['cd']= $a;
              $data[$k]['tz']= $d;
            }

            if($vv['contractnature']=='1') {
              //新签量
              $data[$k]['xq'] =$b++;
              $data[$k]['zz'] = $c;
              // echo $data[$k]['xq'];die;
              // print_r($data);die;
            }elseif($vv['contractnature']=='3'){
              //再租
              $data[$k]['zz'] = $c++;
              $data[$k]['xq'] = $b;
            }else{
              $data[$k]['xq'] = $b;
              $data[$k]['zz'] = $c;
            }


          }
        }
        // print_r($data);die;
      }
      // foreach ($zl as $k => $v) {
      //   $data[$k]['zl'] = '0' ;
      //   if($v=='4'){
      //     $data[$k]['zl']= $data[$k]['zl']+1;
      //   }
      // }
       //print_r($data);die;
      $this->assign('volist',$data);
      $this->assign('data',$data);
      $this->display();
    }


    // 添加页面
   	public function channel_add()
   	{
   		$this->display();
   	}

    // 添加方法
   	public function channeladd_do()
   	{
   	  $data = I('post.');
      print_r($data);die;
      $data['sales_id'] = get_user_id();
      // var_dump($data);die;
      $add = M('middle')->data($data)->add();
      // var_dump($add);die;
      if($add){
        M('details')->where(array('id'=>$data['details_id']))->setField('det_advance',3);
        $this->success('新增成功', U('channel/channel_index'));
      }else{
        $this->error('新增失败',U('channel/channel_add'));
      }
   	}


    // 修改页面
    public function channel_save(){
      $id = I('get.id');
      $data = M('middle')->where(array('id'=>$id))->find();
      // print_r($data);die;
      $this->assign('data',$data);
      $this->display();
    }

    // 修改方法
    public function channelsave_do(){
        $data = I('post.');
        $where = array('id'=>$data['id']);
        // print_r($data);die;
        $save = M('middle')->where($where)->save($data);
        if($save){
            $this->success('修改成功', U('channel/channel_index'));
        }else{
            $this->error('修改失败',U('channel/channel_save?id='.$data['id']));
        }

    }


    // 删除
    public function channel_del(){
      $delid = I('get.id');
      $data['middle_is'] = '1';
      $del = M('middle')->where("id=$delid")->save($data);
      if($del){
        $this->success('删除成功', U('channel/channel_index'));
      }else{
        $this->error('删除失败',U('channel/channel_index'));
      }
    }
    /*查看预留*/
    public function channel_list(){
      $id=I('post.id');
      //print_r($id);die;
      $data=M('reserved')
        ->join('dhd_details on dhd_details.id= dhd_reserved.details_id')
        ->field('dhd_reserved.id,dhd_details.detailscoll')
        ->where(array('middle_id'=>$id,'dhd_details.det_advance'=>2))
        ->select();
      // print_r($data);die;  
      echo  json_encode($data);
    }



}