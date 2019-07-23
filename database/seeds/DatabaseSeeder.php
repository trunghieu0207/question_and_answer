<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Question;
use App\Answer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email='long@mail.com';
        $user->password=bcrypt(123456);
        $user->fullname='lam thanh long';
        $user->about_me='None';
        $user->save();

        $user2 = new User();
        $user2->email='viet@mail.com';
        $user2->password=bcrypt(123456);
        $user2->fullname='pham hoang viet';
        $user2->about_me='None';
        $user2->save();

        $cat_fontend = new Category();
        $cat_fontend->name='Frontend';
        $cat_fontend->save();

        $cat_backend = new Category();
        $cat_backend->name='Backend';
        $cat_backend->save();

        $cat_fullstack = new Category();
        $cat_fullstack->name='Fullstack';
        $cat_fullstack->save();

        $cat_mobile = new Category();
        $cat_mobile->name='Mobile';
        $cat_mobile->save();

        $question = new Question();
        $question->title='Frontend tool to manage H2 database [closed]';
        $question->content="How to use H2 database's integrated managment frontend? For operations such as create table, alter table, add column, and so on.";
        $question->user_id=$user->_id;
        $question->category_id=$cat_fontend->_id;
        $question->save();

        $question = new Question();
        $question->title='Angular with socket.io & backend php';
        $question->content="I am working on realtime app (chat) & using angular and my backend is php(codeigniter restapi) for database in mongodb I hear somewhere that socket.io is best library for socket (use for real time) , and i see socket.io is mostly use with node.js , so may i need basic knowledge of node or any other feasible way to work with socket.io , angular and php.";
        $question->user_id=$user->_id;
        $question->category_id=$cat_backend->_id;
        $question->save();

        $question = new Question();
        $question->title='Generate fullstack application using yeoman fullstack';
        $question->content="I want to generate a fullstack application and I was thinking of using a yeoman generator. I tried using the latest version of yeoman fullstack generator and I generated the project but I don't understand very well the structure of the project. I noticed that this project doesn't use bower and I don't know how to manage dependecies from other components. Can you explain to me how this project works? If you cannot explain this to me, I would like a project with bower so can you tell me which is the latest version of angular fullstack that still uses bower?.";
        $question->user_id=$user->_id;
        $question->category_id=$cat_fullstack->_id;
        $question->save();

        $question = new Question();
        $question->title='What is the best way to detect a mobile device?';
        $question->content="Is there a solid way to detect whether or not a user is using a mobile device in jQuery? Something similar to the CSS @media attribute? I would like to run a different script if the browser is on a handheld device. The jQuery $.browser function is not what I am looking for.";
        $question->user_id=$user->_id;
        $question->category_id=$cat_mobile->_id;
        $question->save();
    }
}