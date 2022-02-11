<?php
function security_question()
{
    $secArr = [
                "Please select a security question.",
                "What is your Favorite color?",
                "What is your Mothers maiden name?",
                "What is your middle name?",
                "What was your childhood nickname?",
                "What is the name of your childhood best friend",
                "In what city or town did your mother and father meet?",
                "What is your favorite sports team?",
                "What is your favorite movie?",
                "What is your favorite sport?",
                "What is your pets name?",
                "What is your favorite food?",
                "What was the make of your first car?",
                "What was the name of the hospital where you were born",
                "In what town were you born?",
                "What was the name of the high school you attended?",
                "What school did you attend for sixth grade?",
                "What was the last name of your third grade teacher?",
                "What was the last name of your eighth grade teacher?",
                "What was your first job?",
                "What is the first name of the person you first kissed?",
                "What is the last name of the teacher who gave you your first failing grade?",
                "What was the name of your favorite teacher in high school",
                "What is the name of the street where you grew up?",
                "What is the name of your favorite cousin?",
                "Who was your childhood hero?",
                "What is the name of the place your wedding reception was held?",
                "What is your favorite holiday?",
                "Where did you spend your honeymoon?",
                "Who was your date on prom night?",
                "What town was your father born in?",
                "What town was your mother born in?",
                "Where did you meet your spouse?",
                "Where/how did you meet your bestfriend?",
                "How old were you when you first flew on a plane?",
                "Where did you go the first time you flew on a plane?",
                "What is the first name of your best friend in high school?",
                "What was the name of your first pet?",
                "What was the first thing you learned to cook?",
                "What was the first film you saw in the theatre?",
                "What is the name of your favorite artist?",
                "What is your favorite song?",
                "Who is your favorite author?",
                "What is your favorite book?",
                "What was your best summer?",
                "Who was your best man at your wedding?",
                "Who was your maid of honor at your wedding?",
                "What is your dream job/career?",
                "What is your dream car?",
                "In what year did you graduate high school?",
                "In what year did you graduate college?",
                "What is your fathers middle name?",
                "What is your mothers middle name?"
  ];

    $return = '<select class="form-control text-center" id="SecQuestion" name="SecQuestion">';
    for ($i = 0;$i < count($secArr);$i++) {
        $return.='<option value="'.$i.'">'.$secArr[$i].'</option>';
    }
    $return.='</select>';

    return $return;
}
