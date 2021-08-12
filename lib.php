<?php

/**
 * @package local_qrbasedimage
 * @author Pearl Miglani <miglanipearl@gmail.com> and Shreyans Jain <shreyansja1n@outlook.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


function local_qrbasedimage_before_footer(){

    global $PAGE;
    $page = end(explode('/',$PAGE->url->__toString()));
    if (explode('?',$page)[0]=='attempt.php'){
        require_once(__DIR__ . '/../../mod/quiz/locallib.php');
        require_once(__DIR__.'/../../config.php');
        global $DB;
        $url_components = parse_url($page);
        parse_str($url_components['query'], $params);
        $attemptobj=quiz_create_attempt_handling_errors($params['attempt'], $params['amp;cmid']);
        $questionid= $DB->get_record('question_attempts', ['questionusageid'=>$attemptobj->get_attempt()->uniqueid, 'slot'=>1],'questionid');
        $PAGE->requires->js("/local/qrbasedimage/jquery-3.6.0.min.js");
        $slot = $attemptobj->get_attempt()->currentpage + 1;
        $uniqueid = $attemptobj->get_attempt()->uniqueid;
        echo "<script src='https://code.jquery.com/jquery-3.6.0.js'></script>";
        require_once('encry.php');
        include('url.php');
        $st = $params['attempt'].'-'.$slot.'-'.$questionid->questionid.'-'.$uniqueid;
        $encryption = openssl_encrypt($st, $ciphering,$encryption_key, $options, $encryption_iv);
        echo '
        <script>
        function onc(){
                var aid ="'.$encryption.'";
                var url ="'.$url.'";
                $("#qim").remove();
                $.post(url+"/local/qrbasedimage/qrprint.php",{as: aid} ,function(returnedData){ $("#QRCode").append("<div id=qim>"+returnedData+"</div>");});
    
        }
        </script>';
        echo "<script>
        function showimage(){
            var aid='$encryption';
            var url='$url';
            $('#img').remove();
            $.post(url+'/local/qrbasedimage/showimages.php',{aid:aid}, function(returnedData){ $('#images').append('<div id=img>'+returnedData+'</div>'); });
        }
        </script>";


        $PAGE->requires->js_init_code("$(window).ready( function() { $('#page-content').append( '<button class=".'"btn btn-success"'." onclick=onc() >Show QR Code</button>' ); } );");
        $PAGE->requires->js_init_code("$(window).ready( function() { $('#page-content' ).append( '<button class=".'"btn btn-primary"'." onclick=showimage() >Show Images</button>' ); } );");
        $PAGE->requires->js_init_code("$(window).ready( function() { $('#page-content').append( '<div id=QRCode> </div>' ); } );");
        $PAGE->requires->js_init_code("$(window).ready( function() { $('#page-content').append( '<div id=images> </div>' ); } );"); 

 

    }

    elseif (explode('?',$page)[0]=='review.php' || explode('?',$page)[0]=='reviewquestion.php'){
        require_once(__DIR__.'/../../config.php');
        include('url.php');    
        global $DB;
        $url_components = parse_url($page);
        parse_str($url_components['query'], $params);
        $attemptid = $params['attempt'];
        $images = $DB->get_records('images', ['attemptid'=>$attemptid],'','*');
        echo "<script src='https://code.jquery.com/jquery-3.6.0.js'></script>";
        foreach ($images as $img){
            echo "<script>
            $(document).ready( function(){
                $('#question-{$img->uniqueid}-{$img->slot}').append(' <a ". 'target="_blank" rel="noopener noreferrer" ' ."href=$url/{$img->image}> Image {$img->image} </a> <br> ');
            } );
        </script>";
        }
    }

    elseif (explode('?',$page)[0]=='report.php'){

        require_once(__DIR__.'/../../config.php');
        include('url.php');    
        global $DB;
        $url_components = parse_url($_SERVER['REQUEST_URI']);
        parse_str($url_components['query'], $params);
        $quesid = $params['qid'];
        $slot = $params['slot'];
        $images = $DB->get_records('images', ['quesid'=>$quesid, 'slot'=>$slot],'','*');
        echo "<script src='https://code.jquery.com/jquery-3.6.0.js'></script>";
        foreach ($images as $img){
            echo "<script>
            $(document).ready( function(){
                $('#question-{$img->uniqueid}-{$img->slot}').append(' <a ". 'target="_blank" rel="noopener noreferrer" ' ."href=$url/{$img->image}> Image {$img->image} </a> <br> ');
            } );
            </script>";
            }

    }
    
}
