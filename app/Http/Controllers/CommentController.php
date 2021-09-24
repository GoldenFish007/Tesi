<?php

require_once(__DIR__ . "/../../Models/Comment.php");

class CommentController extends Controller
{

    public function CreateComment(Request $request,$id){
    
        $body = json_decode($request->content);

        if(isset($body->content) && !empty($body->content)){

            $id = Comment::create(["content"=> $body->content , "tweet_id" => $id]);
            $id = array($id);
        
            return Response::json( ["Message"=>"Comment is created successfully", "Comments"=> $id] , Response::HTTP_OK , 0);
        }
        else
            return Response::json( ["Empty"=>"Body of the comment is not provided"] , Response::HTTP_BAD_REQUEST );
    }


    public function deleteComment(Request $request , $id){

        if(!empty($id)){

            $inside = comment::first("id" , $id);

            if(!empty($inside)){

                if($inside->destroy( "id", "=" , $id))
                    
                    $inside = array($inside);
                    return Response::json(["Message"=> "Comment is deleted Successfully" , "Comments"=> $inside] , Response::HTTP_OK , 0);
            }
            else
                return Response::json( ["Empty"=> "Comment id provided does not exist in the database"]  , Response::HTTP_BAD_REQUEST );
        }
        else
            return Response::json( ["Empty"=> "Comment id not provided"]  , Response::HTTP_BAD_REQUEST );
    }

    
    public function getAllcomments(Request $request){         

        $inside = comment::all();

        if(!empty($inside)){

            return Response::json( ["Comments"=>$inside] , Response::HTTP_OK , 0);
        }
        else
            return Response::json( ["Empty"=> "There Are No Comments"]  , Response::HTTP_BAD_REQUEST);
    }


    public function updateComment(Request $request,$id){

        $body = json_decode($request->content);

        if (!empty($id)){

            $inside = Comment::first("id", $id);

            if (!empty($inside) && isset($body->content) && !empty($body->content) ){

                $inside->content = $body->content;
                $inside->save();
                $inside = array($inside);
                return Response::json(["Message"=> "The comment is updated successfully","Comments"=> $inside] , Response::HTTP_OK , 0 );
            }
            else
              return Response::json( ["Empty"=> "Comment id provided does not exist in the database OR the body of the tweet is not provided Correctly"]  , Response::HTTP_BAD_REQUEST );
        }
        else
        return Response::json( ["Empty"=> "Comment id not provided"]  , Response::HTTP_BAD_REQUEST );
       }

    // NOT USED
    public function getComment(Request $request,$id){

        if(!empty($id)){

            $inside = comment::first("id" , $id);

            if (!empty($inside))
                return Response::json($inside   , Response::HTTP_OK );
            else
                return Response::json( ["Message"=> "Comment id provided does not exist in the database"] , Response::HTTP_BAD_REQUEST );
        }
        else
            return Response::json( ["Message"=> "id not provided"]  , Response::HTTP_BAD_REQUEST );
    }

    // NOT USED
    public function getTweet_Of_This_comment(Request $request,$id){

        if (!empty($id)){

            $inside = Comment::first("id" , $id);

            if (!empty($inside)){

                $Tweet = $inside->tweet();

                if (!empty($Tweet))
                    return Response::json(["Message"=> "the id of the tweet for the chosen comment is = " .$inside->tweet_id  ,"content"=> $Tweet] , Response::HTTP_OK , 0);

            }
            else
                return Response::json( ["Message"=> "There is no such comment in your data base"]  , Response::HTTP_BAD_REQUEST );
        }
        else
            return Response::json( ["Message"=> "id not provided"]  , Response::HTTP_BAD_REQUEST );
    }

  
 }
