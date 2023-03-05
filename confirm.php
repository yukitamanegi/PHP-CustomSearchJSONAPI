<?php

//------------------------------------
// 定数設定
//------------------------------------
//APIキー
$apiKey = "AIzaSyC6kQQpx0Qn66oYL7lz-qufksbZcGvCymg";

//検索エンジンID
$searchEngineId = "76b8ff487c0104855";

// 検索用URL
$baseUrl = "https://www.googleapis.com/customsearch/v1?";

//取得開始位置
$startNum = 1;

//--------------------------
// 検索キーワード取得
//--------------------------
//$query = $_POST['q'];
//$query = $_GET['q'];
$query = $_POST['fullname'];

//------------------------------------
// リクエストパラメータ生成
//------------------------------------
$paramAry = array(
                'q' => $query,
                'key' => $apiKey,
                'cx' => $searchEngineId,
                'alt' => 'json',
                'start' => $startNum
        );
$param = http_build_query($paramAry);

//------------------------------------
// 実行＆結果取得
//------------------------------------
$reqUrl = $baseUrl . $param;
$retJson = file_get_contents($reqUrl, true);
$ret = json_decode($retJson, true);

//------------------------------------
// 結果表示
//------------------------------------

//画面表示
//var_dump($ret);

//JSON形式でファイル出力
file_put_contents(dirname(__FILE__) . "/data/ret_" . $startNum . "_" . date('Ymd_His') . ".txt", $retJson);

//項目を画面表示
$num = $startNum;
foreach($ret['items'] as $value){
    echo "順位:" . $num . "<br>\n";
    echo "タイトル:" . $value['title'] . "<br>\n";
    echo "URL:" . $value['link'] . "<br>\n";
    echo "-------------------------------------------------------------------------<br>\n";

    $num++;
}
?>