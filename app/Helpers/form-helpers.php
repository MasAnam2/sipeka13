<?php
#FORM HELPER

function form_open($route, $action='')
{
  if($action=='')
    $action = 'insert';
  echo '<form onsubmit="save(this, event, \''.$action.'\')" action="'.$route.'" method="post">';
}

function has_error($errors, $field)
{
  if($errors->has($field)) return 'has-error';
}

function label($l, $f)
{
  if(is_null($l) or $l==''){
    $l = ucfirst($f);
    if(strpos($f, '_') !== false){
      $L = explode('_', $f);
      $l = '';
      foreach ($L as $ll) {
        $l .= ucfirst($ll).' ';
      }
    }
  }
  return $l;
}
function input_date($name, $placeholder=null, $value='', $optional='')
{
  echo 
  '<div class="form-group">
  <label for="'.$name.'">'.label($placeholder, $name).'</label>
  <input id="'.$name.'" type="text" '.get_date_mask().' class="form-control date-mask" placeholder="Insert '.label($placeholder, $name).'" name="'.$name.'" value="'.$value.'" '.$optional.'>
  <span class="help-block"><strong></strong></span>
</div>';
}

function input_datepicker($name, $placeholder=null, $value='', $optional='')
{
  echo 
  '<div class="form-group">
  <label for="'.$name.'">'.label($placeholder, $name).'</label>
  <input onfocus="resetError(this)" id="'.$name.'" type="text" class="form-control datepicker" placeholder="Insert '.label($placeholder, $name).'" name="'.$name.'" value="'.$value.'" '.$optional.'>
  <span class="help-block"><strong></strong></span>
</div>';
}

function input_text($name, $placeholder='', $value='', $additional='')
{
  $textname = '';
  if($name != ''){
    $textname = 'name="'.$name.'"';
  }
  echo '<div class="form-group">
  <label for="'.$name.'">'.label($placeholder, $name).'</label>
  <input onfocus="resetError(this)" '.$additional.' type="text" class="form-control" id="'.$name.'" '.$textname.' placeholder="Insert '.label($placeholder, $name).'" value="'.$value.'">
  <span class="help-block"><strong></strong></span>
</div>';
}

function input_money($name, $placeholder='', $value='', $additional='')
{
  $textname = '';
  if($name != ''){
    $textname = 'name="'.$name.'"';
  }
  echo '<div class="form-group">
  <label for="'.$name.'">'.label($placeholder, $name).'</label>
  <input onfocus="resetError(this)" '.$additional.' type="text" class="form-control numeric-only" id="'.$name.'" '.$textname.' placeholder="Insert '.label($placeholder, $name).'" value="'.$value.'">
  <span class="help-block"><strong></strong></span>
</div>';
}

function input_password()
{
  echo '<div class="form-group">
  <label for="password">Password</label>
  <input onfocus="resetError(this)" type="password" class="form-control" id="password" name="password" placeholder="Insert Password">
  <span class="help-block"><strong></strong></span>
</div>';
}

function input_password_confirmation()
{
  echo '<div class="form-group">
  <label for="password_confirmation">Password Confirmation</label>
  <input onfocus="resetError(this)" type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Insert Password Confirmation">
  <span class="help-block"><strong></strong></span>
</div>';
}

function input_file($name, $placeholder='', $additional='')
{
  echo '<div class="form-group">
  <label for="'.$name.'">'.label($placeholder, $name).'</label>
  <input onchange="resetError(this)" '.$additional.' type="file" class="form-control" id="'.$name.'" name="'.$name.'" placeholder="Insert '.label($placeholder, $name).'" />
  <span class="help-block"><strong></strong></span>
</div>
';
}

function input_time($name, $placeholder=null, $value='', $optional='')
{
  echo 
  '<div class="form-group">
  <label for="'.$name.'">'.label($placeholder, $name).'</label>
  <input id="'.$name.'" type="text" data-inputmask="\'alias\': \'hh:mm:ss\'" data-mask class="form-control date-mask" placeholder="Insert '.label($placeholder, $name).'" name="'.$name.'" value="'.$value.'" '.$optional.'>
  <span class="help-block"><strong></strong></span>
</div>';
}

function input_hidden($name, $value)
{
  echo '<input type="hidden" name="'.$name.'" value="'.$value.'">';
}

function textarea($name, $placeholder=null, $value='', $optional='')
{
  echo 
  '<div class="form-group">
  <label for="'.$name.'">'.label($placeholder, $name).'</label>
  <textarea onfocus="resetError(this)" id="'.$name.'" type="text" class="form-control" placeholder="Insert '.label($placeholder, $name).'" name="'.$name.'" '.$optional.'>'.$value.'</textarea>
  <span class="help-block"><strong></strong></span>
</div>';
}

function cb($v, $n, $p)
{
  return 
  '<div class="form-group">
  <label class="input-control checkbox">
    <input type="checkbox" name="'.$n.'" value="'.$v.'" class="minimal check-menu"> '.$p.'
  </label>
</div>';
}

function cb_only($name='', $value='', $additional='')
{
  echo get_cb_only($name, $value, $additional);
}

function get_cb_only($name='', $value='', $additional='')
{
  if($name != '')
    $name = 'name="'.$name.'"';
  if($value != '')
    $value = 'value="'.$value.'"';
  return '<input type="checkbox" '.$value.' '.$name.' class="minimal icheck" '.$additional.'>';
}

function input_multi_text($name, $placeholder='', $additional='')
{
  $label = label($placeholder, $name);
  echo '<div class="form-group"><label for="name">'.$label.'</label><select name="'.$name.'[]" id="'.$name.'" '.$additional.' multiple class="form-control select2" style="width: 100%;"></select><span class="help-block">  <strong></strong></span></div>';
}

function old_fl($v, $f)
{
  return '<input type="hidden" name="old_'.$f.'" value="'.$v.'">';
}

function get_date_mask()
{
  return 'data-inputmask="\'alias\': \'yyyy-mm-dd\'" data-mask';
}

function select($name, $placeholder, $data, $additional='', $selected=null)
{
  echo '<div class="form-group">
  <label for="'.$name.'">'.label($placeholder, $name).'</label>
  <select '.$additional.' id="'.$name.'" name="'.$name.'" class="form-control select2" style="width: 100%;">';
    foreach ($data as $key => $value) {
      if($selected==$key){
        echo '<option value="'.$key.'" selected>'.$value.'</option>';
      }else{
        echo '<option value="'.$key.'">'.$value.'</option>';
      }
    }  
    echo  '</select>
    <span class="help-block"><strong></strong></span>
  </div>';
}

function icheck($name, $placeholder='', $value, $additional='')
{
  echo '<div class="form-group"><label for="'.$name.'"><input '.$additional.' name="'.$name.'" type="checkbox" id="'.$name.'" class="icheck" value="'.$value.'"> '.label($placeholder, $name).'</label></div>';
}

function cb_del($id)
{
  return get_cb_only('id[]', $id, 'data-check="check-member"');
}

function input_radio($name, $placeholder='', $value, $additional = '')
{
  echo '<div class="form-group"><label for="'.$name.'"><input '.$additional.' name="'.$name.'" type="radio" id="'.$name.'" class="icheck" value="'.$value.'"> '.label($placeholder, $name).'</label></div>';
}