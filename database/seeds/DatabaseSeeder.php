<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Question;
use App\Answer;
use App\Attachment;
use App\Notification;
use App\User_Question_Answer;
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
        $user->email = 'user1@mail.com';
        $user->password = bcrypt(123456);
        $user->fullname = 'User1';
        $user->avatar = 'default_avatar.png';
        $user->about_me = 'None';
        $user->save();

        $user2 = new User();
        $user2->email='user2@mail.com';
        $user2->password=bcrypt(123456);
        $user2->fullname='User2';
        $user2->avatar = 'default_avatar.png';
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

        $question2 = new Question();
        $question2->title='Angular with socket.io & backend php';
        $question2->content="I am working on realtime app (chat) & using angular and my backend is php(codeigniter restapi) for database in mongodb I hear somewhere that socket.io is best library for socket (use for real time) , and i see socket.io is mostly use with node.js , so may i need basic knowledge of node or any other feasible way to work with socket.io , angular and php.";
        $question2->user_id=$user2->_id;
        $question2->category_id=$cat_backend->_id;
        $question2->save();

        $question3 = new Question();
        $question3->title='Generate fullstack application using yeoman fullstack';
        $question->content="I want to generate a fullstack application and I was thinking of using a yeoman generator. I tried using the latest version of yeoman fullstack generator and I generated the project but I don't understand very well the structure of the project. I noticed that this project doesn't use bower and I don't know how to manage dependecies from other components. Can you explain to me how this project works? If you cannot explain this to me, I would like a project with bower so can you tell me which is the latest version of angular fullstack that still uses bower?.";
        $question3->user_id=$user->_id;
        $question3->category_id=$cat_fullstack->_id;
        $question3->save();

        $question4 = new Question();
        $question4->title='What is the best way to detect a mobile device?';
        $question4->content="Is there a solid way to detect whether or not a user is using a mobile device in jQuery? Something similar to the CSS @media attribute? I would like to run a different script if the browser is on a handheld device. The jQuery $.browser function is not what I am looking for.";
        $question4->user_id=$user2->_id;
        $question4->category_id=$cat_mobile->_id;
        $question4->save();

        $answer = new Answer();
        $answer->content = "There's a shell client built in too which is handy.\njava -cp h2*.jar org.h2.tools.Shell";
        $answer->user_id = $user->_id;
        $answer->question_id = $question->_id;
        $answer->save();

        $answer2 = new Answer();
        $answer2->content = "You have 3 ways: \n*Use node.js server *\n\nIt depends how large is your API. But in my opinion for MongoDb and sockets node.js will be better than PHP.Why? MongoDB using JSON format and NodeJS is javascript server so it is better to handle JSON. Also NodeJS have non-blocking IO so it will be faster for socket than PHP. You can read more Here. NodeJS is very simple to learn.\n\n*Use PHP with sockets *\n\nYou don't need to start new node.js server if you have alredy PHP. You can use library similar to socket.io. Lets check: Elephant IO\n\n*Use PHP for API and Node for socket only *\n\nI think you don't need to use all data from API for socket. So you can create node server only for sockets calls and PHP server for API calls..";
        $answer2->user_id = $user2->_id;
        $answer2->question_id = $question2->_id;
        $answer2->save();

        $answer3 = new Answer();
        $answer3->content = "My objective was to have my site \"mobile friendly\". So I use CSS Media Queries do show/hide elements depending on the screen size.";
        $answer3->user_id = $user->_id;
        $answer3->question_id = $question3->_id;
        $answer3->save();

        $attachment = new Attachment();
        $attachment->name = "Myfile";
        $attachment->type = "zip";
        $attachment->path = "storage/app/Myfile.zip";
        $attachment->postable_id = $question->_id;
        $attachment->postable_type = "Question";
        $attachment->save();

  		$notification = new Notification();
        $notification->user_id = $user->_id;
        $notification->content = "User2 like your Question";
        $notification->postable_id = $question->_id;
        $notification->postable_type= "Question";
        $notification->save();

        $user_question_answer = new User_Question_Answer();
        $user_question_answer->user_id = $user->_id;
        $user_question_answer->post_id = $question->_id;
        $user_question_answer->action = "Like";
        $user_question_answer->post_type = "Question";
    }
}
