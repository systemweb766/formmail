<?php
  $mailto = "kyonddwell@gmail.com";
  $subject = "result to formmail";
  $contents = "変数１：{$_POST['var1']}\n
              変数２：{$_POST['var2']}\n";

  mail($mailto, $subject, $contents);
  echo '送信しました。';
 ?>
