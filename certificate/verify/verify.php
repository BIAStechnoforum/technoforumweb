<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/config.php';
$post = $_POST;
$json = array();
$json['post'] = $post;

if (!empty($post['action']) && $post['action']=="validateCertificate") {
    $certificateId = $post['certificateId'];
    $data = array();

    $sql = "SELECT certificate_id FROM certificates WHERE certificate_id = '$certificateId'";
    $res = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($res)) {
        array_push($data, $row['certificate_id']);
    }

    $json['$data'] = $data;

    if (in_array($certificateId, $data)) {
        $json['status'] = 'success';
    } else {
        $json['status'] = 'failed';
    }

    header('Content-Type: application/json');
    echo json_encode($json);
}

if (!empty($post['action']) && $post['action']=="getCertificate") {
    $certificateId = $post['certificateId'];

    $sql = "SELECT image FROM certificates WHERE certificate_id = '$certificateId'";
    $res = mysqli_query($link, $sql);

    $data = mysqli_fetch_array($res);

    $image = $data['image'];

    $json['status'] = 'success';
    $json['image'] = $image;

    header('Content-Type: application/json');
    echo json_encode($json);
}
