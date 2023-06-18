<?php

use App\Models\Settings;

define("__IMAGE_DEFAULT__", asset('backend/images/default.png'));
define("__NO_IMAGE_DEFAULT__", asset('backend/images/placeholder.png'));
define("__BASE_URL__", url('frontend'));


function listMajors($data, $parent_id = 0, $str = ''){
    foreach ($data as $key => $value) {
        $id   = $value->id;
        $name = $value->name;

        if ($value->parent_id == $parent_id) {

            if ($str == '') {
                $strName = '<b>' . $str . ' ' .$name . '</b>';
            } else {
                $strName = $str . ' ' .$name;
            }

            echo    '<tr>';

            echo    '<td>'. $key + 1 .'</td>';

            echo    '<td>
                        <a class="text-default">' . $strName . '</a>
                    </td>';

            echo    '<td><span>' . count($value->childs) ?: '_' . '</span></td>';

            echo    '<td>' . date_format($value->created_at, 'd/m/Y') . '</td>';
            
            echo    '<td>
                        <a href="javascript:void(0);" title="Chỉnh sửa" class="btn btn-xs btn-info btn-edit" data-toggle="modal" data-target="#editColor"
                            data-href="' . route('majors.update', $id) . '" data-name="'.$value->name.'" data-parentId="'.$value->parent_id.'">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-xs btn-danger btn-destroy" data-href="' . route('majors.destroy', $id) . '"
                            data-toggle="modal" data-target="#confim" title="Xóa">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>';

            echo    '</tr>';

            listMajors($data, $id, $str . '⎯&nbsp');

        }
    }
    
}

function listCate($data, $parent_id = 0, $str = ''){
    foreach ($data as $key => $value) {

        $id   = $value->id;
        $name = $value->name;
        $popular='';
        if($value->active == 1){
            $active = '<span class="badge badge-success">Hiển thị</span>';
        }else{
            $active = '<span class="badge badge-danger">Không hiển thị</span>';
        }
        if($value->popular == 1){
            $popular = '<br><span class="badge badge-info">Nổi bật</span>';
        }
        if ($value->parent_id == $parent_id) {

            if ($str == '') {
                $strName = '<b>' . $str . ' ' .$name . '</b>';
            } else {
                $strName = $str . ' ' .$name;
            }
            

            echo    '<tr class="odd">';

            echo    '<td><input type="checkbox" name="chkItem[]" value="' . $id . '"></td>';

            echo    '<td>'. $key + 1 .'</td>';

            echo    '<td>

                        <a class="text-default">' . $strName . '</a></br>

                     

                    </td>';

            echo    '<td><span> ' . count($value->childs) ?: '_' . ' </span>

                        </td>';
            

            echo    '<td>' . date_format($value->created_at, 'd/m/Y') . '</td>';
            
            echo    '<td>
                        <a href="' . route('categories.edit', $id) . '" class="btn btn-xs btn-info btn-edit" title="Chỉnh sửa"> 
                        <i class="fas fa-edit"></i>
                        </a>

                    <a href="javascript:void(0);" class="btn btn-xs btn-danger btn-destroy" data-href="' . route('categories.destroy', $id) . '" data-toggle="modal" data-target="#confim" title="Xóa">

                       <i class="fas fa-trash"></i>

                    </a>

                    </td>';

            echo    '</tr>';

            listCate($data, $id, $str . '<i class="fal fa-minus"></i>');

        }

    }

}

function menuMulti($data, $parent_id = 0, $str = '', $select = 0)
{
    foreach ($data as $value) {
        $id   = $value->id;
        $name = $value->name;
        if ($value->parent_id == $parent_id) {
            if ($select != 0 && $id == $select) {
                echo '<option value=' . $id . ' selected> ' . $str . ' '.$name . ' </option>';
            } else {
                echo '<option value=' . $id . '> ' . $str . ' '.$name . ' </option>';
            }
            menuMulti($data, $id, $str . '⎯' , $select);
        }
    }
}

function getSettings($key = null, $field = null)
{
    if(!empty($key)){
        $data = Settings::where('type', $key)->first();
        if(!empty($data)){
            $data = json_decode($data->content);
            if(!empty($field)){
                return !empty($data->{ $field }) ? $data->{ $field } : $data;
            }
            return $data;
        }
        return 'Key does not exist';
    }
    return 'Error';
}