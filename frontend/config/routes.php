<?php

return [
    '/' => 'site/index',
    '<action:(index|callbackercall|subscribe|comment)>' => 'site/<action>',
    '<module:\w+>/<controller:[a-z-]+>/<action:[a-z-]+>/<id:\d+>' => '<module>/frontend/<controller>/<action>',
    '<controller:(^services|^blog|^solutions)>/<slug>' => '<controller>/index',
//                '<controller>/<action:[a-z-]+>/<page:\d+>' => '<controller>/<action>/index',
];
