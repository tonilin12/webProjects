<?php 

      $polls = [
        'poll1' => [
            'id' => 'poll1',
            'question' => 'Szeretnéd-e, hogy legyen INGYEN Pöttyös automata a Lágymányoson?',
            'options' => ['igen', 'nem'],
            'isMultiple' => False,
            'createdAt' => '2022-12-04',
            'deadline' => '2022-12-12',
            'answers' => ['igen' => 2, 'nem' => 0],
            'voted' => ['userid1', 'userid2']
          ],
        'poll2' => [
            'id' => 'poll2',
            'question' => 'Miket tartalmazzon a Pöttyös automata?',
            'options' => ['Klasszikus Túró Rudi', 'Karamellás Guru', 'Tejszelet', 'Fitness Rudi'],
            'isMultiple' => True,
            'createdAt' => '2022-12-05',
            'deadline' => '2024-12-13',
            'answers' => ['Klasszikus Túró Rudi' => 3, 'Karamellás Guru' => 3, 'Tejszelet' => 3, 'Fitness Rudi' => 2],
            'voted' => ['userid1', 'userid2', 'userid3']
            ]
    ];
    $users = [
        'userid1' => [
            'id' => 'userid1',
            'username' => 'admin',
            'email' => 'email1@email.hu',
            'password' => 'admin',
            'isAdmin' => True,
        ],
        'userid2' => [
            'id' => 'userid2',
            'username' => 'user2',
            'email' => 'email2@email.hu',
            'password' => 'user2',
            'isAdmin' => False,
        ],
        'userid3' => [
            'id' => 'userid3',
            'username' => 'user3',
            'email' => 'email3@email.hu',
            'password' => 'user3',
            'isAdmin' => False,
        ],
        'admin' => [
            'id' => 'admin',
            'username' => 'admin',
            'email' => 'admin@email.hu',
            'password' => 'admin',
            'isAdmin' => False,
        ],
    ];
    $newjson=json_encode($users,JSON_PRETTY_PRINT);
    file_put_contents('users.json',$newjson);

?>