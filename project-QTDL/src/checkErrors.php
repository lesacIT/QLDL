<?php

function checkErrors(array $Data){
    $errors=[];
    if(empty($Data['ndCauHoi'])){
        $errors['ndCauHoi']='Nội dung câu hỏi không được trống';
    }
    if(empty($Data['dapan'])){
        $errors['dapan']='Chưa check đáp án đúng';
    }
    if(empty($Data['ndTraLoi1'])){
        $errors['ndTraLoi1']='câu trả lời trống';
    }
    if(empty($Data['ndTraLoi2'])){
        $errors['ndTraLoi2']='câu trả lời trống';
    }
    if(empty($Data['ndTraLoi3'])){
        $errors['ndTraLoi3']='câu trả lời trống';
    }
    if(empty($Data['ndTraLoi4'])){
        $errors['ndTraLoi4']='câu trả lời trống';
    }
    return $errors;
}