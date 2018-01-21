<?php

  //各種変数初期化
  $mailto = "kyonddwell@gmail.com";
  $err = "";
  //未入力チェック
  if($err == "")
  {
    //プロフィール
    if($_POST["hurigana"]== ""){$err.="ふりがなが入力されていません\n";}
    if($_POST["name"]== ""){$err.="名前が入力されていません\n";}
    if($_POST["sex"]== ""){$err.="性別が入力されていません\n";}
    if($_POST["age"]== ""){$err.="年齢が入力されていません\n";}
    if($_POST["zip1"]== ""){$err.="郵便番号（前半）が入力されていません\n";}
    if($_POST["zip2"]== ""){$err.="郵便番号（後半）が入力されていません\n";}
    if($_POST["pref_id"]== ""){$err.="住所(都道府県)が入力されていません\n";}
    if($_POST["address"]== ""){$err.="住所が入力されていません\n";}
    if($_POST["mail"]== ""){$err.="メールが入力されていません\n";}
    //アンケート結果
    if($_POST["q1"]==""){$err.="Q1が入力されていません\n";}
    if($_POST["q2"]==""){$err.="Q2が入力されていません\n";}
    $q3 = $_POST["q31"] . $_POST["q32"] . $_POST["q33"] . $_POST["q34"] . $_POST["q35"];
    if($q3==""){$err.="Q3が入力されていません\n";}
  }
  //入力内容チェック
  if($err == "")
  {
    //年齢のチェック
    // if(!ereg("^[0-9\-]{2}$", $_POST["age"])){$err.="年齢が数値ではありません\n";}
    settype($_POST["age"], "integer");
    if($_POST["age"] < 10 || $_POST["age"] > 90)
    {
      $err.="年齢が適切な値ではありません\n";
    }
    //郵便番号のチェック
    // if(!ereg("^[0-9\-]{3}$", $_POST["zip1"]))
    // {
    //   $err.="郵便番号(前半)が数値ではありません\n";
    // }
    // if(!ereg("^[0-9\-]{4}$", $_POST["zip2"]))
    // {
    //   $err.="郵便番号(後半)が数値ではありません\n";
    // }
    //電話番号のチェック
    if($_POST["tel"]!="")
    {
      // if(!ereg("^[0-9\-]{10}$", $_POST["tel"]))
      // {
      //   $err.="電話番号が適切ではありません\n";
      // }
    }
    //メールアドレスのチェック
    $cp = "^[_a-z0-9\-]+(\.[_a-z0-9\-]+)*@[a-z0-9\-]+(\.[a-z0-9\-]+)*$";
    // if(!ereg($cp, $_POST["mail"])){$err.="e-mailが適切ではありません\n";}
  }


  if($err!="")
  {
    //エラー表示
    echo "<div style=\"color:red;\">エラーがあります。</div>";
    echo "<pre style=\"color:red;\">{$err}</pre>";
    exit();
  }
  else
  {
    //エラーがなかった場合

    //日付、サーバー情報などを取得
    $dstr = date("Y/m/d(D) H:i:s");//日付
    $addr = $_SERVER["REMOTE_ADDR"];//アドレス
    $proxy = $_SERVER["HTTP_FORWARDED"];//proxy
    $agent = $_SERVER["HTTP_USER_AGENT"];//agent
    //改行コードを変換
    $_POST["q4"] = stripslashes($_POST["q4"]);
    $_POST["q4"] = str_replace("\r\n", "", $_POST["q4"]);
    //結果をまとめる
    $header = "{$dstr},{$addr},{$proxy},{$agent},";
    $profile = sprintf("%s,%s,%s,%s,%s,%s,%s,%s,%s",
      $_POST["hurigana"],
      $_POST["name"],
      $_POST["sex"],
      $_POST["age"],
      $_POST["zip1"],
      $_POST["zip2"],
      $_POST["pref_id"],
      $_POST["address"],
      $_POST["mail"]
    );
    $response = sprintf("%s,%s,%s,%s,%s,%s,%s,%s",
      $_POST["q1"],
      $_POST["q2"],
      $_POST["q31"],
      $_POST["q32"],
      $_POST["q33"],
      $_POST["q34"],
      $_POST["q35"],
      $_POST["q4"]
    );

    //メール送信
    $result = $header . $profile . $response;
    $subject =  "アンケート結果";
    $subject = mb_convert_encoding($subject, "EUC_JP", "auto");
    $rsult = mb_convert_encoding($subject, "EUC_JP", "auto");
     
    //ハードディスクに保存

    //完了メッセージへリダイレクト
  }
 ?>
