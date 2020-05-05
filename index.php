<?php

require 'vendor/autoload.php';

use App\PhoneFilter;

$messages=[
    [
        'message_id'=>'1',
        'message_text'=>"555-555-555 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        'infected_flag'=>0
    ],
    [
        'message_id'=>'2',
        'message_text'=>"Lorem Ipsum is simply dummy text of the printing and 777-777-777 typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        'infected_flag'=>0
    ],
    [
        'message_id'=>'3',
        'message_text'=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
        'infected_flag'=>0
    ],
];

$filtered_messages=new PhoneFilter(new ArrayIterator($messages));

foreach($filtered_messages as $message){
    $message['infected_flag']=1;
    var_dump($message);
}
