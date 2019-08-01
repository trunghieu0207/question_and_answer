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
        $user->email = 'antman@mail.com';
        $user->password = bcrypt(123456);
        $user->fullname = 'Antman';
        $user->avatar = 'antman_avatar.png';
        $user->about_me = 'We are antman team!';
        $user->read_notification = true;
        $user->save();

        $category_name = array('Frontend', 'Backend', 'Mobile', 'Fullstack', 'Other');
        $cat_id = 'none';
        foreach($category_name as $name){
            $category = new Category();
            $category->name = $name;
            $category->save();
            $cat_id = $category->_id;
        }

        $question = new Question();
        $question->title='If you had one day left to live, what would you do?';
        $question->content='# The world is going to die!
![](https://cdn.inquisitr.com/wp-content/uploads/2017/09/september-doomsday-endoftheworld.jpg)
### Imagine in the beautiful day, there are some news that the globle is too old so it is going to die tommorrow.
# What you will do?
### Tell me your crazy idea :D.';
        $question->attachment_path=null;
        $question->user_id=$user->_id;
        $question->category_id=$cat_id;
        $question->total_like=0;
        $question->total_dislike=0;
        $question->total_answer=0;
        $question->save();
    }
}
