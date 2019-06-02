<?php



$word = $argv[1];
$lines = 0;

$handle = @fopen("bbe.txt", "r");
if ($handle) {
    while (!feof($handle)) {
        $line = fgets($handle, 4096);
        $local = local_word($line, $word);
        $lines++;
        if( !empty($local) ){
            echo "$lines,".implode(' ',$local)."\n";
        }
    }
    fclose($handle);
}

function local_word($line, $word){
    $local = array();
    $local_length = 1;
    $word_length = strlen($word);

    for($i = 0; ( $char = $line{$i} ) !== ''; $i++ ){
        // 单词最后一个字符必定不是符号，且必有一个符号结尾，此计为一个新词
        if( !is_symbel( $line{ $i-1 } ) && is_symbel($char) ){
            $local_length++;
        }

        if( $char === $word[0] && // 如果第一个字符相同
            is_symbel( $line{ $i-1 } ) && // 且为单词开始
            is_symbel( $line{ $i+$word_length }) // 单词结尾应该为符号
        ){
            // 进入验证单词模式，一个一个字符比对
            for($j = 1; ($w_char = $word{$j}) !== ''; $j++ ){
                // 遇到单词字符不匹配
                if( $w_char != $line{ $i+$j } ){
                    $i += $j;
                    break;
                }
                // 如果单词比对完全正确
                if( $j == ($word_length-1) ){
                    //echo "$line_length, $word_length\n";
                    $local[] = $local_length;
                }
            }
        }
    }
    return $local;
}
//false  true
function is_symbel($char){
    $asc = ord($char);
    return !( (48 <= $asc && $asc <= 57) ||
        (65 <= $asc && $asc <= 90) ||
        (97 <= $asc && $asc <= 122) );
}
