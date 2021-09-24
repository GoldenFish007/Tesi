<?php

Router::get('/tweet/home',['use'=>'TweetController@home']);      //OK         

Router::post('/tweet',['use'=>'TweetController@CreateTweet']);  //OK

Router::delete('/tweet/delete/{id}',['use'=>'TweetController@deleteTweet']);  //OK

Router::get('/tweet/get/all',['use'=>'TweetController@getAllTweets']);   //OK

Router::patch('/tweet/update/{id}',['use'=>'TweetController@updateTweet']); //OK

Router::get('/tweet/get/Comments/{id}',['use'=>'TweetController@getComments']); //OK


//Router::get('/',['use'=>'HomeController@home']);            
//Router::get('/tweet/get/{id}',['use'=>'TweetController@getTweet']);



Router::post('/comment/{id}',['use'=>'CommentController@CreateComment']);   //OK

Router::delete('/comment/delete/{id}',['use'=>'CommentController@deleteComment']);  //OK

Router::get('/comment/get/them/all',['use'=>'CommentController@getAllcomments']);   //OK

Router::patch('/comment/update/{id}',['use'=>'CommentController@updateComment']);   //OK


//Router::get('/comment/get/tweet/{id}',['use'=>'CommentController@getTweet_Of_This_comment']);
//Router::get('/comment/get/{id}',['use'=>'CommentController@getComment']);