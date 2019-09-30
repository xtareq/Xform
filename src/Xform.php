<?php 

namespace Xtareq\Xform;


 class Xform
 {


  /**
  *@author Tareq Hossain
  *@copyright MIT
  *@link <xtrinsic96@gmail.com>
  *@return $mixed
  */

   public static function open($action,$arr=null,$entype=false)
   {
       if(is_array($action)):
      $data =  '<form action="'.route($action[0],$action[1]).'" method="post"';
      else:
      $data =  '<form action="'.route($action).'" method="post"';
    endif;

      foreach($arr as $key=>$value):
          $data .= ''.$key.' = "'.$value.'"';
      endforeach;
      if($entype)
          $data .= 'enctype="multipart/form-data"';
      $data .= ">";

      $data .= csrf_field();

      echo $data;

   }


   public static function input($type,$arr=null,$value=null)
   {
     $data = "";

     if(!in_array('label',array_keys($arr)))
     $arr['label'] = ucfirst($arr['name']);
     $data .= '<div class="form-group">';
       if($type != 'submit')
         $data .= '<label for="'.$arr['name'].'">'.$arr['label'].':</label>';

      if($type=='textarea'):
          $data .= '<textarea name="'.$arr['name'].'" class="form-control" id="'.$arr['name'].'" placeholder="'.$arr['label'].'">'.$value.'</textarea>';
      elseif($type=='select'):
          $data .= '<select name="'.$arr['name'].'" class="form-control" id="'.$arr['name'].'" >';
          $data .= '<option >--select--</option>';
          if ($value instanceof \Illuminate\Database\Eloquent\Collection) {

            if(in_array('selected', array_keys($arr))){
              foreach($value as $val){
                if($val->id == $arr['selected']){
                    $data .= '<option value="'.$val->id.'" selected>'.$val->name.'</option>';
                }else{
                  $data .= '<option value="'.$val->id.'">'.$val->name.'</option>';
                }

              }
            }else{
              foreach($value as $val){
                $data .= '<option value="'.$val->id.'">'.$val->name.'</option>';
              }
            }

          }else{
            foreach($value as $key=>$val){
              $data .= '<option value="'.$key.'">'.$val.'</option>';
            }
          }
          $data .= '</select>';
      elseif($type == 'submit'):
          $data .= '<input type="'.$type.'" name="'.$arr['name'].'" class="'.$arr['class'].'" id="'.$arr['name'].'" value="'.$value.'" >';
      else:
          $data .= '<input type="'.$type.'" name="'.$arr['name'].'" class="form-control" id="'.$arr['name'].'"  value="'.$value.'" placeholder="'.$arr['label'].'">';
      endif;
      $data .= " </div>";
      echo $data;
   }


   public static function close()
   {
      echo "</form>";
   }


   public static function withGrid($grid, $data)
   {
   		echo "<div class='".$grid."'>";
   		echo $data;
   		echo "</div>";
   }


 }
