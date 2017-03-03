<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json;charset=utf-8');
echo '{
    "messages" : [
        {
            "user" : "Coralie",
            "date" : "23/05/2017",
            "id" : "1",
            "content" : "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida mauris vel dapibus feugiat. Nullam quis semper orci, sit amet ullamcorper ex. Ut luctus efficitur justo id sodales. Vivamus mattis lacus a augue vulputate, eu pulvinar nibh laoreet. Phasellus venenatis, ex a gravida gravida, lectus mauris pulvinar lacus, in sodales est ipsum vitae leo. In vel ante vel sapien vulputate pharetra. Pellentesque laoreet non diam quis sodales. Praesent vel lectus mauris. Pellentesque vitae risus nec nulla malesuada varius. Donec orci nisi, euismod eget justo ac, lobortis vehicula nisi. In vitae interdum arcu."
        },
        {
            "user" : "Coralie",
            "date" : "23/05/2017",
            "id" : "2",
            "content" : "Aenean porttitor quis eros eu elementum. Vivamus aliquet et justo eu iaculis. Donec vitae leo ut risus venenatis vehicula at ornare erat. Aliquam pulvinar justo urna. Integer diam nibh, interdum id turpis sit amet, hendrerit rutrum purus. Etiam lacus lacus, posuere sed imperdiet id, malesuada quis sem. In auctor felis libero, eu porttitor est tincidunt et. Ut ullamcorper et justo ut accumsan. Nulla elementum, nunc quis blandit consectetur, erat dui aliquam massa, a elementum lectus tortor vitae tortor. Maecenas suscipit erat in pellentesque hendrerit. Curabitur leo turpis, molestie at vulputate in, interdum ut odio. Sed molestie condimentum velit et tempor. Fusce sed viverra leo. Praesent ornare odio vel lacus luctus, eu porta velit aliquet. Donec luctus, mi non fringilla suscipit, erat felis finibus risus, a convallis urna est ac nibh. Integer eget lacus augue."
        },
        {
            "user" : "Maureen",
            "date" : "23/05/2017",
            "id" : "3",
            "content" : "Nullam ultrices, eros vitae vulputate congue, arcu ex posuere lacus, ac viverra odio lectus scelerisque urna. Proin pellentesque mi ante, a cursus est eleifend vel. Sed bibendum, felis et blandit bibendum, urna nisl tempus enim, at maximus neque justo quis dolor. Fusce vel quam eu leo gravida tristique. Maecenas eget dapibus leo. Quisque iaculis diam vel risus euismod tincidunt. Sed rutrum lectus eleifend nibh malesuada venenatis. Vestibulum vitae augue tincidunt, consequat metus in, sagittis ex. Aliquam erat volutpat. Nam tempus leo id iaculis sagittis."
        },
        {
            "user" : "Coralie",
            "date" : "23/05/2017",
            "id" : "4",
            "content" : "Proin sit amet libero dolor. Morbi augue risus, placerat ut erat ac, commodo pellentesque dolor. Morbi dapibus ipsum nunc, rhoncus egestas tortor dictum nec. Vivamus pharetra sit amet odio quis hendrerit. Etiam venenatis eros nec aliquam ornare. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis leo quis justo porttitor bibendum. Nullam sodales sit amet mauris et euismod. Ut rutrum molestie lacus non rhoncus. Duis nec lacus tincidunt metus venenatis aliquam. Nunc id arcu eget elit gravida sollicitudin eu vitae ex."
        },
        {
            "user" : "Maureen",
            "date" : "23/05/2017",
            "id" : "5",
            "content" : "Fusce iaculis iaculis massa sed iaculis. Nullam lobortis maximus nisi vel auctor. Nunc vestibulum pretium urna id commodo. Donec aliquam consequat nisl, ut lobortis mi sodales vitae. Nam urna metus, pulvinar sit amet felis vel, lobortis consequat augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus fermentum convallis arcu, in efficitur dolor egestas porttitor. Nam consectetur sem odio, sit amet sodales erat pellentesque sit amet. Sed iaculis ipsum purus, eget volutpat felis venenatis ut. Donec in augue sit amet tellus aliquet convallis et at tellus. Duis accumsan velit blandit porttitor lobortis. Sed consectetur vehicula eros sed facilisis. Donec dapibus mollis placerat. Aenean tempor tellus nibh, vel eleifend ipsum finibus sit amet. Etiam fringilla, metus ut condimentum ultrices, metus urna ornare libero, sit amet porta enim ex eget lorem. Mauris a faucibus tortor."
        }
    ],
    "users" : [
        {
            "pseudo" : "Maureen"
        }
    ],
    "id" : "3"
}';
?>